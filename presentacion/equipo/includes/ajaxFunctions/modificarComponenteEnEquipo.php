<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'equipoDatabaseLinker.class.php';
include_once negocio.'usuario.class.php';

session_start();

if(!isset($_SESSION['usuario']))
{
    echo "Session Expirada. Por favor Actualice la pagina!";
    die();
}

$usuario = $_SESSION['usuario'];

$usuarioUnset = unserialize($usuario);

$db = new EquipoDatabaseLinker();

$data = $_REQUEST;

if($data['oper'] == 'del')
{
    $ret = $db->quitarComponenteDeEquipo($data['id'], $usuarioUnset->getId());
}

echo json_encode($ret);
?>