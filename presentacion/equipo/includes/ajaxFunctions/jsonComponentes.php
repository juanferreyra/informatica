<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'componenteDatabaseLinker.class.php';

$dbComponente = new ComponenteDatabaseLinker();

$variable = $_REQUEST;

if(!isset($_REQUEST['Det']))
{
    $nombre = "";
}
else
{
    $nombre = $_REQUEST['Det'];
}

$componentes = $dbComponente->getCompFiltrada($nombre);

echo json_encode($componentes);