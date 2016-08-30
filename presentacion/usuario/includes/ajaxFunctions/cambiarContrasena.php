<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'usuarioDatabaseLinker.class.php';
include_once negocio.'usuario.class.php';
session_start();
$usuario = $_SESSION['usuario'];
$data = unserialize($usuario);

$obj = new UsuarioDatabaseLinker();

$registro = $obj->cambiarContrasenaUsuario($data->getApodo(), $_POST);

echo json_encode($registro);

?>