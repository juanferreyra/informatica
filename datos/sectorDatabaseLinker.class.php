<?php
include_once conexion.'conectionData.php';
include_once conexion.'dataBaseConnector.php';
include_once negocio.'usuario.class.php';
include_once negocio.'sector.class.php';
include_once 'utils.php';

class sectorDatabaseLinker
{
    var $dbinformatica;
    
    function sectorDatabaseLinker()
    {
        $this->dbinformatica = new dataBaseConnector(HOSTLocal,0,DB,USRDBAdmin,PASSDBAdmin);
    }

    function getSectores()
    {
        $query="SELECT
                    sector.id,
                    sector.detalle,
                    hospital.detalle_corto as hospital
                FROM
                    sector LEFT JOIN 
                    hospital ON(sector.idhospital=hospital.id)
                WHERE
                    sector.habilitado=true;";

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

        $Sectors = array();

        for ($i = 0; $i < $this->dbinformatica->querySize; $i++)
        {
            $result = $this->dbinformatica->fetchRow($query);

            $Sector = new Sector();
            $Sector->setId($result['id']);
            $Sector->setDetalle($result['detalle']);
            $Sector->setHospital($result['hospital']);
            $Sectors[] = $Sector;
        }

        $this->dbinformatica->desconectar();

        return $Sectors;
    }

    function getSector($id)
    {
        $query="SELECT
                    sector.id,
                    sector.detalle,
                    hospital.detalle_corto as hospital
                FROM
                    sector LEFT JOIN 
                    hospital ON(sector.idhospital=hospital.id)
                WHERE
                    sector.habilitado=true AND
                    sector.id=$id;";

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

        $Sector = new Sector();
        $Sector->setId($result['id']);
        $Sector->setDetalle($result['detalle']);
        $Sector->setHospital($result['hospital']);

        $this->dbinformatica->desconectar();

        return $Sector;
    }


    private function getSectores2($page, $rows, $filters)
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
                    sector.id,
                    sector.detalle,
                    hospital.detalle_corto as hospital
                FROM
                    sector LEFT JOIN 
                    hospital ON(sector.idhospital=hospital.id)
                WHERE
                    sector.habilitado=true ".$where."
                LIMIT $rows OFFSET $offset;";

        try {
            $this->dbinformatica->ejecutarQuery($query);    
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
        
        $Sectores = array();

        for ($i = 0; $i < $this->dbinformatica->querySize; $i++)
        {
            $result = $this->dbinformatica->fetchRow($query);

            $Sector = new Sector();
            $Sector->setId($result['id']);
            $Sector->setDetalle($result['detalle']);
            $Sector->setHospital($result['hospital']);
            $Sectores[] = $Sector;
        }

        $this->dbinformatica->desconectar();

        return $Sectores;
    }

    private function getCantidadComponentes($filters = null)
    {
        $query="SELECT
                    count(*) as cantidad
                FROM
                    sector
                WHERE
                    habilitado=true;";
        
        $this->dbinformatica->ejecutarQuery($query);

        $result = $this->dbinformatica->fetchRow($query);

        $ret = $result['cantidad'];

        return $ret;
    }


    function getSectoresJson($page, $rows, $filters)
    {
        $response = new stdClass();

        $this->dbinformatica->conectar();

        $response->page = $page;
        $response->total = ceil($this->getCantidadComponentes($filters) / $rows);
        $response->records = $this->getCantidadComponentes($filters);

        $subarray = $this->getSectores2($page, $rows, $filters);

        $this->dbinformatica->desconectar();

        for ($i=0; $i < count($subarray) ; $i++) 
        {
            $sector = $subarray[$i];
            //id de fila
            $response->rows[$i]['id'] = $sector->id; 
            $row = array();
            $row['id'] = $sector->getId();
            $row['detalle'] = $sector->getDetalle();
            $row['hospital'] = $sector->getHospital();
            $row['myac'] = '';
            //agrego datos a la fila con clave cell
            $response->rows[$i]['cell'] = $row;
        }

        $response->userdata['id']= 'id';
        $response->userdata['detalle']= 'detalle';
        $response->userdata['hospital']= 'hospital';
        $response->userdata['myac'] = '';

        return json_encode($response);
    }

    public function crearSector($arraySector, $usuario)
    {
        $response = new stdClass();
        $query="INSERT INTO 
                    sector (
                        `detalle`,
                        `idhospital`,
                        `habilitado`,
                        `idusuario`,
                        `fecha_creacion`
                ) VALUES (
                        '".$arraySector['detalle']."',
                        '".$arraySector['idhospital']."',
                        1,
                        '".$usuario."',
                        now()
                    );";



        try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarAccion($query);    
            $response->message = "Sector Agregado";
            $response->ret = true;
        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            $response->message = "Ocurrio un error al crear el Sector. Avisale a Juanchi. Si dale... Corree!";
            $response->ret = false;
        }
        $this->dbinformatica->desconectar();

        return $response;
    }

    public function eliminarSector($id)
    {
        $query="UPDATE
                    sector
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

    public function eliminarSector2($data)
    {
        $response = new stdClass();
        
        $query="UPDATE
                    sector
                SET
                    habilitado = false
                WHERE
                    id = ".$data['id'].";";

         try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarAccion($query);
            $response->message = "Sector eliminado";
            $response->ret = true;
        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            $response->message = "Hubo un error eliminando el sector.";
            $response->ret = false;
        }

        $this->dbinformatica->desconectar();

        return $response;
    }

    public function modificarSector($data)
    {
        $response = new stdClass();

        $query="UPDATE
                    sector
                SET
                    detalle='".$data['detalle']."',
                    idhospital=".Utils::phpIntToSQL($data['hospital'])."
                WHERE
                    id=".Utils::phpIntToSQL($data['id']).";";
        try
        {
            $this->dbinformatica->conectar();
            $this->dbinformatica->ejecutarAccion($query);
            $response->message = "Sector modificado";
            $response->ret = true;

        }
        catch (Exception $e)
        {
            $this->dbinformatica->desconectar();
            $response->message = "Ocurrio un error al crear el Sector. Avisale a Juanchi. Si dale... Corree!";
            $response->ret = false;
        }
        $this->dbinformatica->desconectar();

        return $response;
    }

}