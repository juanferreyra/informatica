<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'sectorDatabaseLinker.class.php';

$db = new SectorDatabaseLinker();

$data = $_POST;

if($data['oper'] == 'del')
{
    $ret = $db->eliminarSector2($data);
}
else
{
    $ret = $db->modificarSector($data);    
}    
echo json_encode($ret);
?>