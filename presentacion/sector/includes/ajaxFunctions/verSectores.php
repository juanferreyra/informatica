<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'sectorDatabaseLinker.class.php';

$db = new SectorDatabaseLinker();

$arr= array();

if($_POST["_search"] == "true")
{
    $arr = json_decode($_POST['filters'], true);
}

$ret = $db->getSectoresJson($_REQUEST['page'], $_REQUEST['rows'], $arr);
    
echo $ret;
?>