<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'usuarioDatabaseLinker.class.php';

$obj = new UsuarioDatabaseLinker();

$registro = $obj->eliminarUsuario($_POST);

echo json_encode($registro);

?>