<?php

//nombre y directorio total del proyecto
$name = 'sistemaTurnos';
$dirRoot = __DIR__.'/';

//directorios locales del proyecto
define($name, $dirRoot);
define('datos', sistemaTurnos.'datos/');
define('dat_formulario', datos.'forms_dblinker/');

define('negocio', sistemaTurnos.'negocio/');
define('neg_formulario',negocio.'forms_class/');

define('presentacion', sistemaTurnos.'presentacion/');
#negocio
define('conexion', datos.'conexion/');

#presentacion
define('pres_equipo', presentacion.'equipo/');
define('pres_usuario', presentacion.'usuario/');
define('pres_includes', presentacion.'includes/');
?>