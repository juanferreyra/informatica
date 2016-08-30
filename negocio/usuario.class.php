<?php

class Usuario
{
	var $id;
	var $apodo;
	var $nombre;
	var $contrasena;
	var $permisos;
	var $logo;
	var $logo_detalle;

	public function Usuario()
	{

	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setApodo($apodo)
	{
		$this->apodo = $apodo;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function setContrasena($contraseña)
	{
		$this->contraseña = $contraseña;
	}

	public function setPermisos($arrayPermisos)
	{
		$this->permisos = $arrayPermisos;
	}

	public function setLogo($logo)
	{
		$this->logo = $logo;
	}

	public function setLogoDetalle($logo_detalle)
	{
		$this->logo_detalle = $logo_detalle;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getApodo()
	{
		return $this->apodo;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getContrasena()
	{
		return $this->contraseña;
	}

	public function getPermisos()
	{
		return $this->permisos;
	}

	public function tienePermiso($area)
	{
		for ($i=0; $i < count($this->permisos); $i++) 
		{ 
			if($this->permisos[$i]==$area)
			{
				return true;
			}
		}

		return false;
	}

	public function getLogo()
	{
		return $this->logo;
	}

	public function getLogoDetalle()
	{
		return $this->logo_detalle;
	}

}

?>