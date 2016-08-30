<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'equipoDatabaseLinker.class.php';

$db = new EquipoDatabaseLinker();

$arr= array();

$idequipo = $_REQUEST['idequipo'];

if($_POST["_search"] == "true")
{
    $arr = json_decode($_POST['filters'], true);
}

$ret = $db->getComponentesEnEquipoJson($_REQUEST['page'], $_REQUEST['rows'], $arr, $idequipo);
    
echo $ret;
?>