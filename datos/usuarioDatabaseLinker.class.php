<?php
include_once conexion.'conectionData.php';
include_once conexion.'dataBaseConnector.php';
include_once negocio.'usuario.class.php';

class UsuarioDatabaseLinker
{
	var $dbusuario;
	
	function UsuarioDatabaseLinker()
	{
		$this->dbusuario = new dataBaseConnector(HOSTLocal,0,DB,USRDBAdmin,PASSDBAdmin);
	}

	function confirmarRegistroUsuario($data)
	{
		$response = new stdClass();

		if ($this->usuarioExiste($data['detalle'], $data['entidad'])) 
		{
			$response->message = "El usuario ya existe!";
			$response->ret = false;
			return $response;
		}
		else
		{
			if($data['contrasena']!= $data['contra2'])
			{
				$response->message = "La contraseña no coincide";
				$response->ret = false;
				return $response;
			}
			try 
			{
				$idusuario = $this->agregarUsuario($data['detalle'], $data['nombre'], $data['contrasena'], $data['entidad']);
			} 
			catch (Exception $e) 
			{
				$response->message = "Ocurrio un error al crear el usuario";
				$response->ret = false;
				return $response;
			}

			try //savepoint en registrarEgreso
			{
				$cargo = $this->registrarTodosPermisosUsuario($idusuario,$data['accesos']);
			} 
			catch (Exception $e) 
			{
				$response->message = "Se produjo un error al registrar los permisos";
				$response->ret = false;
				return $response;
			}
			
			if(!$cargo)
			{
				$this->eliminarConfirmacionRegistro();
				$response->message = "El usuario no se a creado correctamente";
				$response->ret = false;
				return $response;

			}
			else
			{
			    $this->finalizarRegistroUsuario();
			    $response->message = "El usuario se a creado correctamente";
			    $response->ret = true;
			    return $response;
			}
		}
	}

	/*Registro de usuario*/

	function agregarUsuario($detalle, $nombre, $contrasena, $entidad)
	{
		try
		{
			$this->dbusuario->conectar();
		}
		catch (Exception $e)
		{
			throw new Exception("No se pudo insertar el dato en la tabla", 201230);
		}
		
		$query="SELECT 
					IFNULL(MAX(idusuario),0)+1 AS proximo
				FROM 
				  	usuario;";
		
		try
		{
			$this->dbusuario->ejecutarQuery($query);
		}
		catch (Exception $e)
		{
			throw new Exception("No se pudo obtener el proximo nro para el ingreso de usuario", 201230);
		}

		$result = $this->dbusuario->fetchRow();

		$nroIdUsuario = $result['proximo'];

		$contrasenamd5 = md5($contrasena);

		$query = "INSERT INTO usuario (idusuario, detalle, nombre, contrasena, fecha, entidad) VALUES (".$nroIdUsuario.",'".strtolower($detalle)."','".strtoupper($nombre)."', '".$contrasenamd5."', now(), '".$entidad."');";

		try
		{
			$this->dbusuario->ejecutarAccion($query);
		}
		catch (Exception $e)
		{
			throw new Exception("No se pudo ejecutar la accion del insert", 201230);
		}		

		$this->dbusuario->desconectar();

		return $nroIdUsuario;
	}

	function usuarioExiste($usuario, $entidad)
	{
		$query="SELECT detalle FROM usuario WHERE entidad = '".$entidad."' AND detalle = '".strtolower($usuario)."' AND habilitado = 1;";

		$arr = array ();
	
		try
			{
				$this->dbusuario->conectar();
				$this->dbusuario->ejecutarQuery($query);
			}
		catch (Exception $e)
			{
				throw new Exception("Error al conectar con la base de datos", 17052013);
			}

		$result = $this->dbusuario->fetchRow($query);
		
		if($result['detalle']==$usuario)
		{
			return true; //usuario existe
		}
		else
		{
			return false; //usuario no existe
		}
	}

	function registrarTodosPermisosUsuario($idusuario, $permisos)
	{
		$completado = true;

		$query="SET AUTOCOMMIT=0;";
		$query2= "SAVEPOINT punto;";

		try
			{
				$this->dbusuario->conectar();
				$this->dbusuario->ejecutarAccion($query);
				$this->dbusuario->ejecutarAccion($query2);
			}
		catch (Exception $e)
			{
				throw new Exception("Error al conectar con la base de datos", 17052013);
			}

		for($i=0; $i<count($permisos); $i++)
		{
			try 
			{
				$this->registrarPermiso($idusuario, $permisos[$i]);
			}
			catch (Exception $e)
			{
				$completado = false;
				break;
			}
		}


		return $completado;
	}

	function registrarPermiso($idusuario, $perfil)
	{	
		$query="INSERT INTO usuario_permiso (idusuario, idpermiso) VALUES (".$idusuario.", '".$perfil."');";

		try
			{
				$this->dbusuario->conectar();
				$this->dbusuario->ejecutarAccion($query);
			}
		catch (Exception $e)
			{
				throw new Exception("Error al conectar con la base de datos", 17052013);
				$this->dbusuario->desconectar();
				return false;
			}

		return true;
	}

	function finalizarRegistroUsuario()
	{
		$query = "COMMIT;";

		try
			{
				$this->dbusuario->conectar();
				$this->dbusuario->ejecutarAccion($query);
			}
		catch (Exception $e)
			{
				throw new Exception("Error al conectar con la base de datos", 17052013);
			}

		$this->dbusuario->desconectar();
	}

	function eliminarConfirmacionRegistro()
	{
		$rollback = "ROLLBACK TO SAVEPOINT punto;"; 

		try 
		{
			$this->dbusuario->conectar();
			$this->dbusuario->ejecutarAccion($rollback);	
		} 
		catch (Exception $e) 
		{
			throw new Exception("Error al conectar con la base de datos", 17052013);
		}
			
		$this->dbusuario->desconectar();
	}

	/*Fin Registro de usuario*/

	function eliminarUsuario($data)
	{
		$response = new stdClass();
		
		if(!$this->usuarioExiste($data['usuario'],$data['entidad']))
		{
			$response->message = "El usuario que desea eliminar no existe!";
			$response->ret = false;
			return $response;
		}

		$query="UPDATE usuario SET habilitado = 0 WHERE entidad = '".$data['entidad']."' AND detalle = '".strtolower($data['usuario'])."' and habilitado = 1;";

		try
			{
				$this->dbusuario->conectar();
				$this->dbusuario->ejecutarAccion($query);
			}
		catch (Exception $e)
		{
			throw new Exception("Error al conectar con la base de datos", 17052013);
			$response->message = "Error al eliminar el usuario";
			$response->ret = false;
			return $response;
		}
		$response->message = "El usuario se a eliminado correctamente";
		$response->ret=true;
		return $response;
	}

    function confirmarPermisosUsuario($data)
	{
		$response = new stdClass();
        $idusuario = $data['idusuario'];
        $permisos = $data['accesos'];
        
        try
        {
            // CONECTARSE A LA DB
            $this->dbusuario->conectar();
            
            // CREAR PUNTO DE RECUPERACION
            $this->dbusuario->ejecutarAccion('SET AUTOCOMMIT = 0;');
            $this->dbusuario->ejecutarAccion('SAVEPOINT punto;');
            
            // BORRAR TODOS LOS PERMISOS
            $query = "DELETE FROM usuario_permiso WHERE idusuario = " . $idusuario;
            $this->dbusuario->ejecutarAccion($query);
            
            // AGREGAR LOS NUEVOS PERMISOS
            for($i = 0; $i < count($permisos); $i++)
            {
                $query = "INSERT INTO usuario_permiso (idusuario, idpermiso) VALUES (".$idusuario.", '".$permisos[$i]."');";
                $this->dbusuario->ejecutarAccion($query);
			}
                
	        // COMMIT
	        $this->dbusuario->ejecutarAccion("COMMIT;");
	        
	        // SETEAR MENSAJE DE EXITO
	        $response->message = "Los permisos han sido guardados";
	        $response->ret = true;
		}
        catch (Exception $e)
        {
            // ROLLBACK
            try
            {
                $this->dbusuario->ejecutarAccion("ROLLBACK TO SAVEPOINT punto;");
            }
            catch (Exception $e)
            {
            }
            
            // SETEAR MENSAJE DE ERROR
            $response->message = "Error al intentar guardar los permisos";
            $response->ret = false;
        }

        // DESCONECTARSE DE LA DB
        $this->dbusuario->desconectar();
        
        // ENVIAR REPSUESTA
        return $response;
	}

    public function getUsuarios($entidad, $page, $rows)
	{
		$offset = ($page - 1) * $rows;

		$query="SELECT 
					idusuario, 
					detalle, 
					nombre
                FROM 
                	usuario
                WHERE
                	entidad = '".$entidad."' AND
                	habilitado = '1'
                LIMIT ".$rows." OFFSET ".$offset."
                ";

        $this->dbusuario->ejecutarQuery($query);

		$ret = array();

		for ($i = 0; $i < $this->dbusuario->querySize; $i++)
		{
			$usuario = $this->dbusuario->fetchRow($query);
			$ret[] = $usuario;
		}

		return $ret;
	}
	
    private function getCantidadUsuarios($entidad)
    {
        $query="SELECT 
            		COUNT(*) as cantidad
            	FROM 
            		usuario
            	WHERE
            		entidad = '".$entidad."' AND
            		habilitado = '1'";
        
        $this->dbusuario->ejecutarQuery($query);
        $result = $this->dbusuario->fetchRow($query);
        $ret = $result['cantidad'];

        return $ret;
    }
        
    function getUsuariosJson($entidad, $page, $rows)
    {
        $response = new stdClass();
        $this->dbusuario->conectar();

        $usuariosarray = $this->getUsuarios($entidad, $page, $rows);

        $response->page = $page;
        $response->total = ceil($this->getCantidadUsuarios($entidad) / $rows);
        $response->records = count($usuariosarray); 

        $this->dbusuario->desconectar();

        for ($i=0; $i < count($usuariosarray) ; $i++) 
        { 
            $usuario = $usuariosarray[$i];
            //id de fila
            $response->rows[$i]['id'] = $usuario['idusuario']; 
            //datos de la fila en otro array
            $row = array();
            $row[] = $usuario['nombre'];
            $row[] = $usuario['detalle'];
            $row[] = '';
            //agrego datos a la fila con clave cell
            $response->rows[$i]['cell'] = $row;
        }

        $response->userdata['Nombre']= 'Nombre';
        $response->userdata['Detalle']= 'Detalle';
        $response->userdata['myac'] = '';

        return json_encode($response);
    }

    function cambiarContrasenaUsuario($usuariodetalle, $data)
    {
		$response = new stdClass();
                
	    if ($data['contrasena'] == "")
	    {
	        // SETEAR MENSAJE DE CONTRASEÑA VACIA
	        $response->message = "La contraseña debe tener al menos una letra o número";
	        $response->ret = false;
	        
	        // SALIR
	        return $response;
	    }
	    
	    if ($data['contrasena'] != $data['repetir'])
	    {
	        // SETEAR MENSAJE DE CONTRASEÑAS NO COINCIDEN
	        $response->message = "Las contraseñas no coinciden";
	        $response->ret = false;
	        
	        // SALIR
	        return $response;
	    }
	    
	    $contrasenaActualMd5 = md5($data['vieja']);
	    $contrasenaNuevaMd5 = md5($data['contrasena']);

	    try
	    {
            // CONECTARSE A LA DB
            $this->dbusuario->conectar();
            
            // TRAER LA CONTRASEÑA DEL USUARIO
            $query = "SELECT contrasena FROM usuario WHERE detalle = '".strtolower($usuariodetalle)."' AND entidad ='".$data['entidad']."'";
            $this->dbusuario->ejecutarQuery($query);
            $resultado = $this->dbusuario->fetchRow();
            $contrasenaMd5 = $resultado['contrasena'];
            
            if ($contrasenaMd5 == $contrasenaActualMd5)
            {
                // CAMBIAR CONTRASEÑA
                $query = "UPDATE usuario SET contrasena = '".$contrasenaNuevaMd5."' WHERE detalle = '".strtolower($usuariodetalle)."' AND entidad ='".$data['entidad']."'";
                $this->dbusuario->ejecutarAccion($query);

                // SETEAR MENSAJE DE EXITO
                $response->message = "La contraseña ha sido cambiada";
                $response->ret = true;
            }
            else
            {
                // SETEAR MENSAJE DE CONTRASEÑA INVALIDA
                $response->message = "La contraseña ingresada no coincide con la del usuario";
                $response->ret = false;
            }
		}
        catch (Exception $e)
        {
                // SETEAR MENSAJE DE ERROR
                $response->message = "Error al intentar cambiar la contraseña";
                $response->ret = false;
        }

        // DESCONECTARSE DE LA DB
        //$this->dbusuario->desconectar();
        
        // ENVIAR REPSUESTA
        return $response;
	}

	function cambiarNombreUsuario($usuariodetalle, $data)
    {
		$response = new stdClass();
        $nombre = strtoupper($data['nombre']);

        try
        {
            // CONECTARSE A LA DB
            $this->dbusuario->conectar();
            
            // CAMBIAR NOMBRE
            $query = "UPDATE usuario SET nombre = '".$nombre."' WHERE detalle = '".strtolower($usuariodetalle)."' AND entidad = '".$data['entidad']."'";
            $this->dbusuario->ejecutarAccion($query);
            
            // SETEAR MENSAJE DE EXITO
            $response->message = "El nombre ha sido cambiado";
            $response->nombre = $nombre;
            $response->ret = true;
		}
        catch (Exception $e)
        {
            // SETEAR MENSAJE DE ERROR
            $response->message = "Error al intentar cambiar el nombre";
            $response->ret = false;
        }

        // DESCONECTARSE DE LA DB
        //$this->dbusuario->desconectar();
        
        // ENVIAR REPSUESTA
        return $response;
	}

	function getUsuario($apodo, $entidad)
	{
		$query="SELECT 
					*
				FROM
					usuario
				WHERE
					entidad = '".$entidad."' AND
					detalle = '".strtolower($apodo)."';";
		try
			{
				$this->dbusuario->conectar();
				$this->dbusuario->ejecutarQuery($query);
			}
			catch (Exception $e)
			{
				throw new Exception("Error al conectar con la base de datos", 17052013);
			}

		$result = $this->dbusuario->fetchRow($query);

		$usuario = new Usuario();
		$usuario->setId($result['idusuario']);
		$usuario->setApodo($result['detalle']);
		$usuario->setNombre($result['nombre']);
		$usuario->setContrasena($result['contrasena']);
		$usuario->setPermisos($this->permisosDeUsuario($result['idusuario']));
        $usuario->setLogo($result['logo']);
        $usuario->setLogoDetalle($result['logo_detalle']);
        
		return $usuario;
	}

	function traerPermisosDelUsuario($idusuario, $entidad)
    {
        $query = "SELECT 
        				p.idpermiso, 
        				p.detalle, 
        				up.idusuario IS NOT NULL as tiene
                	FROM 
                		permiso p LEFT JOIN 
                		usuario_permiso up ON up.idpermiso = p.idpermiso AND up.idusuario = ".$idusuario ."
                	WHERE
                		p.entidad = '".$entidad."' OR p.entidad = 'TODOS';";

		try
	    {
	            $this->dbusuario->conectar();
	            $this->dbusuario->ejecutarQuery($query);
	    }
		catch (Exception $e)
	    {
	            throw new Exception("Error al conectar con la base de datos", 17052013);
	    }

		$arr = array();

		for($i = 0 ; $i < $this->dbusuario->querySize; $i++)
		{
			$result = $this->dbusuario->fetchRow($query);
	                    
			$arrdos = array(
	                            'idpermiso' => $result['idpermiso'],
	                            'detalle'   => $result['detalle'],
	                            'tiene'     => $result['tiene']
	                    );
			
	                    $arr[] = $arrdos;
		}

		$this->dbusuario->desconectar();
		return $arr;
    }

	function acceso($usuario, $contrasenaIngresada, $entidad)
	{
		
		if(!$this->usuarioExiste(strtolower($usuario),$entidad))
		{
			return false; //usuario no existe
		}
		else
		{

			$query="SELECT 
						contrasena 
					FROM 
						usuario 
					WHERE 
						entidad = '".$entidad."' AND 
						detalle = '".strtolower($usuario)."' AND 
						habilitado = 1;";

			$arr = array ();
		
			try
			{
				$this->dbusuario->conectar();
				$this->dbusuario->ejecutarQuery($query);
			}
			catch (Exception $e)
			{
				throw new Exception("Error al conectar con la base de datos", 17052013);
			}

			$result = $this->dbusuario->fetchRow($query);
			$contrasenaIngresadamd5 = md5(strtolower($contrasenaIngresada));

			if($contrasenaIngresadamd5 == $result['contrasena'])
			{
				
				$_SESSION['usuario'] =  serialize($this->getUsuario(strtolower($usuario), $entidad));
				$_SESSION['entidad'] = $entidad;
				return true; //usuario existe y contraseña coincide
			}
			else
			{
				return false; //usuario existe y contraseña no coincide
			}
		}
	}

	/*Con esta actualizacion quedarina inutilizadas estas funciones por que se saca todo del objeto usuario en session*/

	function permisosDeUsuario($idusuario)
    {
        $query = "SELECT 
        				idpermiso
                	FROM
                		usuario_permiso
                	WHERE
                		idusuario = ".$idusuario .";";

		try
	    {
	            $this->dbusuario->conectar();
	            $this->dbusuario->ejecutarQuery($query);
	    }
		catch (Exception $e)
	    {
	            throw new Exception("Error al conectar con la base de datos", 17052013);
	    }

		$arr = array();

		for($i = 0 ; $i < $this->dbusuario->querySize; $i++)
		{
			$result = $this->dbusuario->fetchRow($query);
			
			$arr[] = $result['idpermiso'];
		}

		$this->dbusuario->desconectar();
		return $arr;
    }

	function getNombreUsuario($id_user)
	{
		$query = "	SELECT 
						nombre 
					FROM 
						usuario 
					WHERE 
						detalle='".getUsuario($id_user)."';";

		try 
		{
			$this->dbusuario->conectar();
			$this->dbusuario->ejecutarQuery($query);
		}
		catch (Exception $e) 
		{
			throw new Exception("Error al realizar consulta de accesos de usuario", 17052013);
			return false;
		}

		$result = $this->dbusuario->fetchRow($query);

		$this->dbusuario->desconectar();

		return $result['nombre'];
	}

	function traerPermisos($entidad)
	{
		$query="SELECT 
					idpermiso, 
					detalle 
				FROM 
					permiso
				WHERE
					entidad = '".$entidad."' OR entidad = 'TODOS';";

		try
		{
			$this->dbusuario->conectar();
			$this->dbusuario->ejecutarQuery($query);
		}
		catch (Exception $e)
		{
			throw new Exception("Error al conectar con la base de datos", 17052013);
		}

		$arr = array();

		for($i = 0 ; $i < $this->dbusuario->querySize; $i++)
		{
			$result = $this->dbusuario->fetchRow($query);
			$arrdos = array('idpermiso' => $result['idpermiso'],'detalle' => $result['detalle']);
			$arr[] = $arrdos;
		}

		$this->dbusuario->desconectar();
		return $arr;
	}

	

	function controlAcceso($usuario, $area)
	{
		try 
		{
			$permisos = $this->permisosDeUsuario($usuario);
		} 
		catch (Exception $e) 
		{
			throw new Exception("Error al consultar los permisos del usuario", 17052013);
			return false;
		}

		for ($i=0; $i < count($permisos); $i++)
		{
			if ($permisos[$i]==$area) 
			{
				return true;
			}
		}

		return false;
	}

    function buscarUsuario($usuario)
    {
        $query="SELECT
                    idusuario,detalle,nombre
                FROM
                    usuario
                WHERE
                    detalle like '%".$usuario."%' AND habilitado=true;";
        try
        {
            $this->dbusuario->conectar();
            $this->dbusuario->ejecutarQuery($query);
        }
        catch (Exception $e)
        {
            throw new Exception("Error al conectar con la base de datos", 17052013);
        }

        $arr = array();

        for($i = 0 ; $i < $this->dbusuario->querySize; $i++)
        {
            $result = $this->dbusuario->fetchRow($query);
            $arrdos = array('idusuario' => $result['idusuario'],'detalle' => $result['detalle'],'nombre' => $result['nombre']);
            $arr[] = $arrdos;
        }

        $this->dbusuario->desconectar();
        
        return $arr;
    }

    function getUsuariosRegistrados($entidad)
    {
        $query="SELECT 
                    idusuario, 
                    detalle, 
                    nombre
                FROM 
                    usuario
                WHERE
                    entidad = '".$entidad."' AND
                    habilitado = true;";
        try
        {
            $this->dbusuario->conectar();
            $this->dbusuario->ejecutarQuery($query);
        }
        catch (Exception $e)
        {
            throw new Exception("Error al conectar con la base de datos", 17052013);
        }

        $ret = array();

        for ($i = 0; $i < $this->dbusuario->querySize; $i++)
        {
            $usuario = $this->dbusuario->fetchRow($query);
            $ret[] = $usuario;
        }

        return $ret; 
    }
}
?>