<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'usuarioDatabaseLinker.class.php';

$obj = new UsuarioDatabaseLinker();

$ret = $obj->getUsuariosJson($_POST['entidad'], $_REQUEST['page'], $_REQUEST['rows']);
	
echo $ret;

?>