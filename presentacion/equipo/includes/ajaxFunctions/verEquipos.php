<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'equipoDatabaseLinker.class.php';

$db = new EquipoDatabaseLinker();

$arr= array();

if($_POST["_search"] == "true")
{
    $arr = json_decode($_POST['filters'], true);
}

$ret = $db->getEquiposJson($_REQUEST['page'], $_REQUEST['rows'], $arr);
    
echo $ret;

?>