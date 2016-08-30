<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'componenteDatabaseLinker.class.php';

$db = new ComponenteDatabaseLinker();

$data = $_POST;

if($data['oper'] == 'del')
{
    $ret = $db->eliminarComponente2($data);
}
else
{
    $ret = $db->modificarComponente($data);    
}    
echo json_encode($ret);
?>