<?php
include_once conexion.'conectionData.php';
include_once conexion.'dataBaseConnector.php';
include_once negocio.'usuario.class.php';
include_once negocio.'componente.class.php';
include_once 'utils.php';
include_once 'tipoComponenteDatabaseLinker.class.php';

class ComponenteDatabaseLinker
{
    var $dbinformatica;
    var $tipoComponenteLinker;
    
    function ComponenteDatabaseLinker()
    {
        $this->dbinformatica = new dataBaseConnector(HOSTLocal,0,DB,USRDBAdmin,PASSDBAdmin);
        $this->tipoComponenteLinker = new TipoComponenteDatabaseLinker();
    }

    function getComponentes()
    {
        $query="SELECT
                    id,
                    idcomponente_tipo,
                    detalle
                FROM
                    componente
                WHERE
                    habilitado=true
                ORDER BY detalle ASC;";

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

        $Componentes = array();

        for ($i = 0; $i < $this->dbinformatica->querySize; $i++)
        {
            $result = $this->dbinformatica->fetchRow($query);

            $tipoComp = $this->tipoComponenteLinker->getTipoComponente($result['idcomponente_tipo']);

            $Componente = new Componente();
            $Componente->setId($result['id']);
            $Componente->setDetalle($result['detalle']);
            $Componente->setTipoComponente($tipoComp);
            $Componentes[] = $Componente;
        }

        $this->dbinformatica->desconectar();

        return $Componentes;
    }

    function getComponente($id)
    {
        $query="SELECT
                id,
                idcomponente_tipo,
                detalle
            FROM
                componente
            WHERE
                id=$id;";

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

        $Componente = new Componente();
        $Componente->setId($result['id']);
        $Componente->setDetalle($result['detalle']);
        $Componente->setTipoComponente($this->tipoComponenteLinker->getTipoComponente($result['idcomponente_tipo']));

        $this->dbinformatica->desconectar();

        return $Componente;
    }


    private function getComponentes2($page, $rows, $filters)
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
                    id,
                    idcomponente_tipo,
                    detalle
                FROM
                    componente
                WHERE
                    habilitado=true ".$where."
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

            $tipoComp = $this->tipoComponenteLinker->getTipoComponente($result['idcomponente_tipo']);

            $Componente = new Componente();
            $Componente->setId($result['id']);
            $Componente->setDetalle($result['detalle']);
            $Componente->setTipoComponente($tipoComp);
            $Componentes[] = $Componente;
        }

        $this->dbinformatica->desconectar();

        return $Componentes;
    }

    private function getCantidadComponentes($filters = null)
    {
        $query="SELECT
                    count(*) as cantidad
                FROM
                    componente
                WHERE
                    habilitado=true;";
        
        $this->dbinformatica->ejecutarQuery($query);

        $result = $this->dbinformatica->fetchRow($query);

        $ret = $result['cantidad'];

        return $ret;
    }


    function getComponentesJson($page, $rows, $filters)
    {
        $response = new stdClass();

        $this->dbinformatica->conectar();

        $response->page = $page;
        $response->total = ceil($this->getCantidadComponentes($filters) / $rows);
        $response->records = $this->getCantidadComponentes($filters);

        $subarray = $this->getComponentes2($page, $rows, $filters);

        $this->dbinformatica->desconectar();

        for ($i=0; $i < count($subarray) ; $i++) 
        {
            $componente = $subarray[$i];
            //id de fila
            $response->rows[$i]['id'] = $componente->id; 
            $row = array();
            $row['id'] = $componente->id;
            $row['detalle'] = $componente->detalle;
            $row['tipo'] = $componente->tipo_componente->getDetalle();
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

    public function crearComponente($arrayComponente, $usuario)
    {
        $response = new stdClass();
        $query="INSERT INTO 
                    componente (
                        `detalle`,
                        `idcomponente_tipo`,
                        `habilitado`,
                        `idusuario`,
                        `fecha_creacion`
                ) VALUES (
                        '".$arrayComponente['detalle']."',
                        '".$arrayComponente['idtipo_componente']."',
                        1,
                        '".$usuario."',
                        now()
                    );";



        try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarAccion($query);    
            $response->message = "Componente Agregado";
            $response->ret = true;
        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            $response->message = "Ocurrio un error al crear el componente. Avisale a Juanchi. Si dale. Corree!";
            $response->ret = false;
        }
        $this->dbinformatica->desconectar();

        return $response;
    }

    public function eliminarComponente($id)
    {
        $query="UPDATE
                    componente
                SET
                    `habilitado`= false
                WHERE
                    `id` = $id;";
        try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarAccion($query);    
        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            return false;
        }
        $this->dbinformatica->desconectar();

        return true;
    }

    public function eliminarComponente2($data)
    {
        $response = new stdClass();
        
        $query="UPDATE
                    componente
                SET
                    habilitado = false
                WHERE
                    id = ".$data['id'].";";

         try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarAccion($query);
            $response->message = "Compnente eliminado";
            $response->ret = true;
        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            $response->message = "Hubo un error eliminando el componente.";
            $response->ret = false;
        }

        $this->dbinformatica->desconectar();

        return $response;
    }

    public function modificarComponente($data)
    {
        $response = new stdClass();

        $query="UPDATE
                    componente
                SET
                    detalle='".$data['detalle']."',
                    idcomponente_tipo=".Utils::phpIntToSQL($data['tipo'])."
                WHERE
                    id=".Utils::phpIntToSQL($data['id']).";";
        try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarAccion($query);
            $response->message = "Componente modificado";
            $response->ret = true;

        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            $response->message = "Hubo un error modificando el componente.";
            $response->ret = false;
        }
        $this->dbinformatica->desconectar();

        return $response;
    }

    public function getComponentesEnEquipo($id)
    {
        $query="SELECT
                    e.id,
                    e.detalle,
                    e.idcomponente_tipo
                FROM
                    equipo_componente ec LEFT JOIN
                    componente e ON(ec.idcomponente=e.id)
                WHERE
                    ec.idequipo=$id  AND
                    ec.habilitado=true;";
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

        $Componentes = array();

        for ($i = 0; $i < $this->dbinformatica->querySize; $i++)
        {
            $result = $this->dbinformatica->fetchRow($query);

            $tipoComp = $this->tipoComponenteLinker->getTipoComponente($result['idcomponente_tipo']);

            $Componente = new Componente();
            $Componente->setId($result['id']);
            $Componente->setDetalle($result['detalle']);
            $Componente->setTipoComponente($tipoComp);
            $Componentes[] = $Componente;
        }

        $this->dbinformatica->desconectar();

        return $Componentes;
    }

}