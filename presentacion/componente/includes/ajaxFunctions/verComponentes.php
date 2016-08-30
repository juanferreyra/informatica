<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'componenteDatabaseLinker.class.php';

$db = new ComponenteDatabaseLinker();

$arr= array();

if($_POST["_search"] == "true")
{
    $arr = json_decode($_POST['filters'], true);
}

$ret = $db->getComponentesJson($_REQUEST['page'], $_REQUEST['rows'], $arr);
    
echo $ret;
?>