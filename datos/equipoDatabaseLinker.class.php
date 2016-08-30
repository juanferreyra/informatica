<?php
include_once conexion.'conectionData.php';
include_once conexion.'dataBaseConnector.php';
include_once datos.'sectorDatabaseLinker.class.php';
include_once datos.'componenteDatabaseLinker.class.php';
include_once negocio.'usuario.class.php';
include_once negocio.'equipo.class.php';
include_once negocio.'tipoComponente.class.php';
include_once negocio.'sector.class.php';
include_once negocio.'componente.class.php';

class EquipoDatabaseLinker
{
    var $dbinformatica;
    var $dbSector;
    var $dbComponente;

    public function equipoDatabaseLinker()
    {
        $this->dbinformatica = new dataBaseConnector(HOSTLocal,0,DB,USRDBAdmin,PASSDBAdmin);
        $this->dbSector = new SectorDatabaseLinker();
        $this->dbComponente = new ComponenteDatabaseLinker();
    }

    public function crearEquipo($arrayEquipo, $usuario)
    {
        $response = new stdClass();
        $query="INSERT INTO 
                equipo
                    (`detalle`,
                        `idsector`,
                        `idusuario`,
                        `fecha_creacion`,
                        `habilitado`)
                VALUES
                    (
                        '".$arrayEquipo['detalle']."',
                        ".$arrayEquipo['idsector'].",
                        ".$usuario.",
                        now(),
                        true
                    );";

        try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarAccion($query);    
            $response->message = "Equipo Agregado";
            $response->result = true;
        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            $response->message = "Ocurrio un error al crear el equipo";
            $response->result = false;
        }

        $response->idequipo = $this->dbinformatica->ultimoIdInsertado();

        $this->dbinformatica->desconectar();

        return $response;
    }

    public function getEquipo($id)
    {
        $query="SELECT
                    e.id,
                    e.detalle,
                    e.idsector
                FROM
                    equipo e
                WHERE
                    e.id=".$id." AND
                    e.habilitado=true;";
        try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarQuery($query);
        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            throw new Exception("Error Processing Request", 1);
        }
        $result = $this->dbinformatica->fetchRow($query);

        $sector  = $this->dbSector->getSector($result['idsector']);

        $equipo = new Equipo();
        $equipo->setId($result['id']);
        $equipo->setDetalle($result['detalle']);
        $equipo->setSector($sector);

        $componentesEqupo = $this->dbComponente->getComponentesEnEquipo($result['id']);

        for ($l=0; $l < count($componentesEqupo); $l++) { 
            $equipo->agregarComponente($componentesEqupo[$l]);
        }

        $this->dbinformatica->desconectar();

        return $equipo;
    }

    private function getComponentesEnEquipo($page, $rows, $filters, $id)
    {
        $where = "";
        if(count($filters)>0)
        {
            for($i=0; $i < count($filters['rules']); $i++ )
            {
                $where.=$filters['groupOp']." ";
                $where.=" ".$filters['rules'][$i]['field']." like '".$filters['rules'][$i]['data']."%'";
            }
        }

        $offset = ($page - 1) * $rows;

        $query="SELECT
                    ec.id,
                    ec.idcomponente as idcomponente,
                    e.detalle as componente,
                    ct.detalle as tipo_componente
                FROM
                    equipo_componente ec LEFT JOIN
                    componente e ON(ec.idcomponente=e.id) LEFT JOIN
                    componente_tipo ct ON(e.idcomponente_tipo=ct.id)
                WHERE
                    ec.idequipo=$id  AND
                    ec.habilitado=true ".$where."
                LIMIT $rows OFFSET $offset;";

        try {
            $this->dbinformatica->ejecutarQuery($query);    
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
        
        $Componentes = array();

        for ($i = 0; $i < $this->dbinformatica->querySize; $i++)
        {
            $result = $this->dbinformatica->fetchRow($query);

            $Componentes[] = $result;
        }

        $this->dbinformatica->desconectar();

        return $Componentes;
    }

    private function getCantidadComponentesEnEquipo($filters = null, $id)
    {
        $query="SELECT
                    count(*) as cantidad
                FROM
                    equipo_componente ec LEFT JOIN
                    componente e ON(ec.idcomponente=e.id) LEFT JOIN
                    componente_tipo ct ON(e.idcomponente_tipo=ct.id)
                WHERE
                    ec.idequipo=$id  AND
                    ec.habilitado=true;";
        
        $this->dbinformatica->ejecutarQuery($query);

        $result = $this->dbinformatica->fetchRow($query);

        $ret = $result['cantidad'];

        return $ret;
    }


    function getComponentesEnEquipoJson($page, $rows, $filters, $id)
    {
        $response = new stdClass();

        $this->dbinformatica->conectar();

        $response->page = $page;
        $response->total = ceil($this->getCantidadComponentesEnEquipo($filters, $id) / $rows);
        $response->records = $this->getCantidadComponentesEnEquipo($filters, $id);

        $subarray = $this->getComponentesEnEquipo($page, $rows, $filters, $id);

        $this->dbinformatica->desconectar();

        for ($i=0; $i < count($subarray) ; $i++) 
        {
            $componente = $subarray[$i];
            //id de fila
            $response->rows[$i]['id'] = $componente['id'];
            $row = array();
            $row['id'] = $componente['idcomponente'];
            $row['detalle'] = $componente['componente'];
            $row['tipo'] = $componente['tipo_componente'];
            $row['myac'] = '';
            //agrego datos a la fila con clave cell
            $response->rows[$i]['cell'] = $row;
        }

        $response->userdata['id']= 'id';
        $response->userdata['detalle']= 'detalle';
        $response->userdata['tipo_componente']= 'tipo_componente';
        $response->userdata['myac'] = '';

        return json_encode($response);
    }

    function insertarComponenteDeEquipo($idequipo, $idcomponente, $idusuario)
    {
        $response = new stdClass();
        $query="INSERT INTO
                    equipo_componente (
                        `idequipo`,
                        `idcomponente`,
                        `idusuario`,
                        `habilitado`,
                        `fecha_creacion`)
                VALUES (
                        $idequipo,
                        $idcomponente,
                        $idusuario,
                        true,
                        now()
                        );";

        try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarAccion($query);    
            $response->message = "Componente agregado al equipo";
            $response->result = true;
        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            $response->message = "Ocurrio un error al relacionar el componente con el equipo";
            $response->result = false;
        }

        $this->dbinformatica->desconectar();

        return $response;
    }

    function quitarComponenteDeEquipo($idrelacion, $idusuario)
    {
        $response = new stdClass();
        $query="UPDATE
                    equipo_componente
                SET
                    habilitado=false,
                    idusuario=$idusuario
                WHERE
                    id=$idrelacion;";

        try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarAccion($query);    
            $response->message = "Componente quitado del equipo";
            $response->result = true;
        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            $response->message = "Ocurrio un error al quitar el componente con el equipo";
            $response->result = false;
        }

        $this->dbinformatica->desconectar();

        return $response;
    }

    function getEquipos()
    {
        $query="SELECT
                    id,
                    detalle,
                    idsector,
                    fecha_creacion
                FROM
                    equipo
                WHERE
                    habilitado=true;";

        try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarQuery($query);
        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            throw new Exception("Error Processing Request", 1);
        }


        $equipos = array();

        for ($i = 0; $i < $this->dbinformatica->querySize; $i++)
        {
            $result = $this->dbinformatica->fetchRow($query);

            $sector  = $this->dbSector->getSector($result['idsector']);

            $equipo = new Equipo();
            $equipo->setId($result['id']);
            $equipo->setDetalle($result['detalle']);
            $equipo->setSector($sector);

            $componentesEqupo = $this->dbComponente->getComponentesEnEquipo($result['id']);

            for ($l=0; $l < count($componentesEqupo); $l++) { 
                $equipo->agregarComponente($componentesEqupo[$l]);
            }

            $equipos[] = $equipo;
        }

        $this->dbinformatica->desconectar();

        return $equipo;
    }

    function getEquipos2($page, $rows, $filters)
    {
        $where = "";

        if(count($filters)>0)
        {
            for($i=0; $i < count($filters['rules']); $i++ )
            {
                $where.=$filters['groupOp']." ";
                $where.=" ".$filters['rules'][$i]['field']." like '".$filters['rules'][$i]['data']."%'";
            }
        }

        $offset = ($page - 1) * $rows;

        $query="SELECT
                    e.id,
                    e.detalle,
                    e.idsector,
                    e.fecha_creacion
                FROM
                    equipo e LEFT JOIN
                    sector s ON(e.idsector=s.id) LEFT JOIN 
                    hospital h ON(s.idhospital=h.id)
                WHERE
                    e.habilitado=true ".$where."
                LIMIT $rows OFFSET $offset;";

        try
        {
            $this->dbinformatica->ejecutarQuery($query);
        }
        catch (Exception $e)
        {
            throw new Exception("Error Processing Request", 1);
        }

        $equipos = array();

        for ($i = 0; $i < $this->dbinformatica->querySize; $i++)
        {
            $result = $this->dbinformatica->fetchRow($query);

            $sector  = $this->dbSector->getSector($result['idsector']);

            $equipo = new Equipo();
            $equipo->setId($result['id']);
            $equipo->setDetalle($result['detalle']);
            $equipo->setSector($sector);

            $componentesEqupo = $this->dbComponente->getComponentesEnEquipo($result['id']);

            for ($l=0; $l < count($componentesEqupo); $l++) { 
                $equipo->agregarComponente($componentesEqupo[$l]);
            }

            $equipos[] = $equipo;
        }

        $this->dbinformatica->desconectar();

        return $equipos;
    }

    function getCantidadEquipos($filters = null)
    {
        $where = "";
        
        if(count($filters)>0)
        {
            for($i=0; $i < count($filters['rules']); $i++ )
            {
                $where.=$filters['groupOp']." ";
                $where.=" ".$filters['rules'][$i]['field']." like '".$filters['rules'][$i]['data']."%'";
            }
        }

        $query="SELECT
                    count(*) as cantidad
                FROM
                    equipo e LEFT JOIN
                    sector s ON(e.idsector=s.id) LEFT JOIN 
                    hospital h ON(s.idhospital=h.id)
                WHERE
                    e.habilitado=true ".$where.";";
        
        $this->dbinformatica->ejecutarQuery($query);

        $result = $this->dbinformatica->fetchRow($query);

        $ret = $result['cantidad'];

        return $ret;
    }

    function getEquiposJson($page, $rows, $filters)
    {
        $response = new stdClass();

        $this->dbinformatica->conectar();

        $response->page = $page;
        $response->total = ceil($this->getCantidadEquipos($filters) / $rows);
        $response->records = $this->getCantidadEquipos($filters);

        $subarray = $this->getEquipos2($page, $rows, $filters);

        $this->dbinformatica->desconectar();

        for ($i=0; $i < count($subarray) ; $i++) 
        {
            $equipo = $subarray[$i];

            $compEquipo = $equipo->getComponentes();

            //creo la lista de componentes
            $textComp = "";

            for ($x=0; $x < count($compEquipo); $x++) { 
                $textComp.=$compEquipo[$x]->getTipoComponente()->getDetalle()." ".$compEquipo[$x]->getDetalle();
                if($x==count($compEquipo)-1){
                    $textComp.=".";
                } else {
                    $textComp.=", ";
                }
            }

            $detalle = $equipo->getDetalle();

            if($detalle==""){
                $detalle = "#N/A#";
            }

            //id de fila
            $response->rows[$i]['id'] = $equipo->getId(); 
            $row = array();
            $row['id'] = $equipo->getId();
            $row['detalle'] = $detalle;
            $row['tipo_detalle'] = $equipo->getSector()->getDetalle();
            $row['tipo_hospital'] = $equipo->getSector()->getHospital();
            $row['componentes'] = $textComp;
            $row['myac'] = '';
            //agrego datos a la fila con clave cell
            $response->rows[$i]['cell'] = $row;
        }

        $response->userdata['id']= 'id';
        $response->userdata['detalle']= 'detalle';
        $response->userdata['tipo_detalle']= 'tipo_detalle';
        $response->userdata['tipo_hospital']= 'tipo_hospital';
        $response->userdata['componentes']= 'componentes';
        $response->userdata['myac'] = '';

        return json_encode($response);
    }


}