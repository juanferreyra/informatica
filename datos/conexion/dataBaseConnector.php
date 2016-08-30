<?php

class TipoMotor 
{
	const MYSQL = 1;
	const SQLSERVER = 2;
}//EndClass

class dataBaseConnector
{
	var $host;
	var $link;
	var $base;
	var $usuario;
	var $contrasenia;
	var $motor;
	var $query;
	var $result;
	var $currentRow;
	var $querySize;

	function dataBaseConnector($host, $link, $base, $usuario, $contrasenia, $motor = TipoMotor::MYSQL)
	{
		//TODO: hay que cambiar el host esto se hace asi para testear en la virtual
		$this->host =$host;
		$this->link =$link;
		$this->base =$base;
		$this->usuario =$usuario;
		$this->contrasenia =$contrasenia;
		$this->motor = $motor;
	}

	function conectar()
	{
		//TODO: supongo que esta es la forma de tratar estas cosas
		//podria pedir un llamador como par�metro para saber que funcion lo origino
		if($this->motor == TipoMotor::MYSQL)
		{
			try {
				$this->link = mysql_connect($this->host, $this->usuario , $this->contrasenia); 	
				//echo mysql_error($this->link);
				
				//Este setBase deberia ser un atributo?
				$setbase = mysql_select_db($this->base,$this->link);
                                
                                $this->ejecutarAccion("SET NAMES 'UTF8'");
			}
			catch (Exception $e)
			{
				throw new Exception($e->getMessage(), $e->getCode());
			}
		}
		elseif ($this->motor==TipoMotor::SQLSERVER) 
		{
			try {
				
				$this->link = mssql_connect($this->host, $this->usuario , $this->contrasenia); 	
				//echo mysql_error($this->link);
				
				//Este setBase deberia ser un atributo?
				$setbase = mssql_select_db($this->base,$this->link);
				
			}
			catch (Exception $e)
			{
				throw new Exception($e->getMessage(), $e->getCode());
			}
		
		}
		return $this->link;
	}
	
	function desconectar()
	{
		if($this->motor == TipoMotor::MYSQL)
		{
			@mysql_close ($this->link);
		}
		elseif($this->motor == TipoMotor::SQLSERVER)
		{
			@mssql_close($this->link);
		}
	}


	function ejecutarQuery($query)
	{//TODO: estos query se pueden guardar en un atributo de la clase y entregar el iterador como respuesta 
		if($this->motor == TipoMotor::MYSQL)
		{
			try {
				
				$this->result = mysql_query($query, $this->link);
				if(!$this->result )
				{
					$this->querySize = 0;
				}
				else 
				{
					$this->querySize = mysql_num_rows($this->result);
				}
				//$this->currentRow = mysql_fetch_assoc($this->result);
			} catch (Exception $e) {
				throw new Exception($e->getMessage(), $e->getCode());
			}
			
			if (mysql_errno($this->link)){
				throw new Exception(mysql_error($this->link), mysql_errno($this->link));
			}
		}
		elseif($this->motor == TipoMotor::SQLSERVER)
		{
			try {
				
				$this->result = mssql_query($query, $this->link);
				if(!$this->result )
				{
					$this->querySize = 0;
				}
				else 
				{
					$this->querySize = mssql_num_rows($this->result);
				}
				//$this->currentRow = mysql_fetch_assoc($this->result);
			} catch (Exception $e) {
				throw new Exception($e->getMessage(), $e->getCode());
			}
		}
		$this->query= $query;
		
	}

	function ejecutarAccion($query)
	{ //Esto es para consultas del tipo insert, update y delete
		if($this->motor == TipoMotor::MYSQL)
		{
			try {
				$this->result = mysql_query($query, $this->link);
				if(!$this->result )
				{
					$this->querySize = 0;
				}
				else 
				{
					$this->querySize = mysql_affected_rows();
				}
			} catch (Exception $e) {
				throw new Exception($e->getMessage(), $e->getCode());
			}
			$this->query= $query;
			
			if (mysql_errno($this->link)){
				throw new Exception(mysql_error($this->link), mysql_errno($this->link));
			}
		}
		elseif ($this->motor == TipoMotor::SQLSERVER)
		{
			try {
				$this->result = mssql_query($query, $this->link);
				if(!$this->result )
				{
					$this->querySize = 0;
				}
				else 
				{
					$this->querySize = mssql_rows_affected($this->link);
				}
			} catch (Exception $e) {
				throw new Exception($e->getMessage(), $e->getCode());
			}
			$this->query= $query;
			
			/*if (mssql_($this->link)){
				throw new Exception(mysql_error($this->link), mysql_errno($this->link));
			}*/
		}
		return $this->result;		
	}

    function iniciarTransaccion()
    {
        $result = true;
        if($this->motor == TipoMotor::MYSQL)
        {
                $result = mysql_query('START TRANSACTION', $this->link);
        }
        elseif ($this->motor==TipoMotor::SQLSERVER) 
        {
                $result = mssql_query('BEGIN TRANSACTION', $this->link);
        }
        if ($result === FALSE) {
                throw new Exception('Error iniciando transacción.');
        }
    }
    
    function commitTransaccion()
    {
        $result = TRUE;
        if($this->motor == TipoMotor::MYSQL)
        {
                $result = mysql_query('COMMIT', $this->link);
        }
        elseif ($this->motor==TipoMotor::SQLSERVER) 
        {
                $result = mssql_query('COMMIT', $this->link);
        }
        if ($result === FALSE) {
                throw new Exception('Error haciendo commit de transacción.');
        }
    }
    
    function rollbackTransaccion()
    {
        $result = TRUE;
        if($this->motor == TipoMotor::MYSQL)
        {
                $result = mysql_query('ROLLBACK', $this->link);
        }
        elseif ($this->motor==TipoMotor::SQLSERVER) 
        {
                $result = mssql_query('ROLLBACK', $this->link);
        }
        if ($result === FALSE) {
                throw new Exception('Error haciendo commit de transacción.');
        }
    }
        
    function ultimoIdInsertado() {
        $result = TRUE;
        if($this->motor == TipoMotor::MYSQL)
        {
                $result = mysql_insert_id($this->link);
        }
        elseif ($this->motor==TipoMotor::SQLSERVER) 
        {
                throw new Exception('Por el momento no soportamos obtener el último id insertado para SQL Server, pero se puede agregar haciendo un query de la función SCOPE_IDENTITY.');
        }
        if ($result === FALSE) {
                throw new Exception('Error obteniendo el último id insertado.');
        }

        return $result;
    }
        
    function setResult(&$res)
	{
		$res = $this->result ;
	}
	
	function setQuerySize(&$quer)
	{
		$quer = $this->querySize;
		
	}
	
	function setQuery(&$quer)
	{
		$quer = $this->query;
		
	}
	
	function getResult()
	{
		return $this->result ;
	}
	
	function getQuerySize()
	{
		return $this->querySize;
		
	}

	function querySize()
	{
		if(isset($this->result))
		{
			return  $this->querySize;
		}
		else
		{
			return 0;
			//EL code de que sirve?, como asigno uno bueno?
			throw new Exception("No se puede contar los resultados sin ejecutar un query", '010101');
		}
	}

	function  fetchRow()
	{
		if($this->motor == TipoMotor::MYSQL)
		{	
			$this->currentRow = mysql_fetch_assoc($this->result);
			//return $this->currentRow;
		}
		elseif($this->motor == TipoMotor::SQLSERVER)
		{
			$this->currentRow = mssql_fetch_assoc($this->result);
			
		}
		return $this->currentRow;
	}	

}
?>