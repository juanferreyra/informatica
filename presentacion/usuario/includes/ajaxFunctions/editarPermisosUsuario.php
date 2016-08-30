<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'usuarioDatabaseLinker.class.php';

$obj = new UsuarioDatabaseLinker();

$registro = $obj->confirmarPermisosUsuario($_POST);

echo json_encode($registro);

?>