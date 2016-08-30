<?php
include_once '../namespacesAdress.php';
include_once datos.'usuarioDatabaseLinker.class.php';

$obj = new UsuarioDatabaseLinker();

session_start();

$nomUsuario=$_POST['usuario'];

$contraUsuario=$_POST['contra'];

$entidad=$_POST['entidad'];

$acceso = $obj->acceso($nomUsuario,$contraUsuario,$entidad);

$data->result = true;

$direccion = $_SERVER['SERVER_NAME'];

if($acceso!=false)
{
	header ("Location: menu/");
}
else 
{
	$data->result = false;

	$data->message = "Ingreso incorrecto";

	header ("Location: index.php?error=1");
}
?>