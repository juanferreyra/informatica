<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'equipoDatabaseLinker.class.php';

$dbEquipo = new  EquipoDatabaseLinker();

$mac = $_REQUEST['macAdres'];

$existe = $dbEquipo->existeMacRegistrada($mac);

$std = new StdClass();

if($existe) {
    $std->result = true;
    $std->message = "Ya existe un equipo con la misma MAC Adreess!";
} else {
    $std->result = false;
}

echo json_encode($std);
?>