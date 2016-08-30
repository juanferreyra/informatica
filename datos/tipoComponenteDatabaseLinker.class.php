<?php
include_once conexion.'conectionData.php';
include_once conexion.'dataBaseConnector.php';
include_once negocio.'usuario.class.php';
include_once negocio.'tipoComponente.class.php';

class TipoComponenteDatabaseLinker
{
    var $dbinformatica;
    
    public function TipoComponenteDatabaseLinker()
    {
        $this->dbinformatica = new dataBaseConnector(HOSTLocal,0,DB,USRDBAdmin,PASSDBAdmin);
    }

    public function getTiposComponentes()
    {
        $query="SELECT
                    id,
                    detalle
                FROM
                    componente_tipo
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

        $Tipocomponentes = array();

        for ($i = 0; $i < $this->dbinformatica->querySize; $i++)
        {
            $result = $this->dbinformatica->fetchRow($query);

            $Tipocomponente = new TipoComponente();
            $Tipocomponente->setId($result['id']);
            $Tipocomponente->setDetalle($result['detalle']);
            $Tipocomponentes[] = $Tipocomponente;
        }

        $this->dbinformatica->desconectar();
        
        return $Tipocomponentes;
    }

    public function getTipoComponente($id)
    {
        $query="SELECT
                    id,
                    detalle
                FROM
                    componente_tipo
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

        $Tipocomponente = new TipoComponente();
        $Tipocomponente->setId($result['id']);
        $Tipocomponente->setDetalle($result['detalle']);

        $this->dbinformatica->desconectar();
        
        return $Tipocomponente;
    }

}