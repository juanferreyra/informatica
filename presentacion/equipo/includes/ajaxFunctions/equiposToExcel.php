<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'equipoDatabaseLinker.class.php';

$dbEquipo = new EquipoDatabaseLinker();

$dbEquipo->equiposToExcel();

?>