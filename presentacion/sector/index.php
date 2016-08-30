
<?php
/*Agregado para que tenga el usuario*/
include_once '../../namespacesAdress.php';
include_once negocio.'usuario.class.php';
session_start();

if(!isset($_SESSION['usuario']))
{
    //echo "WHOOPSS, No se encontro ningun usuario registrado";
    header("Location: ../index.php?logout=1");
}

$usuario = $_SESSION['usuario'];

$data = unserialize($usuario);
/*fin de agregado usuario*/

?>
<!DOCTYPE html>
<html>
<head>
    <title>Sectores</title>
    <link media="screen" type='text/css' rel='stylesheet' href='../includes/css/demo.css' >
    <link media="screen" type="text/css" rel="stylesheet" href="../includes/css/barra.css">
    <link media="screen" type="text/css" rel="stylesheet" href="../includes/css/iconos.css">
    <link media="screen" type="text/css" rel="stylesheet" href="../includes/plug-in/jquery-ui-1.11.4/jquery-ui.css" />
    <link media="screen" type="text/css" rel="stylesheet" href="../includes/plug-in/jquery-ui-1.11.4/jquery-ui.theme.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../includes/plug-in/jqGrid_5.0.2/css/ui.jqgrid.css" />
    <!--NOTIFICACION -->
    <link rel="stylesheet" type="text/css" href="../includes/plug-in/notificacion/css/ns-default.css" />
    <link rel="stylesheet" type="text/css" href="../includes/plug-in/notificacion/css/ns-style-other.css" />
    <script src="../includes/plug-in/notificacion/js/modernizr.custom.js"></script>
    <!--/NOTIFICACION -->
    <script type="text/javascript" src="../includes/plug-in/jquery-core-1.11.3/jquery-core.min.js" ></script>
    <script type="text/javascript" src="../includes/plug-in/jquery-ui-1.11.4/jquery-ui.js" ></script>
    <script type="text/javascript" src="../includes/plug-in/jqGrid_5.0.2/js/i18n/grid.locale-es.js" ></script>
    <script type="text/javascript" src="../includes/plug-in/jqGrid_5.0.2/js/jquery.jqGrid.min.js" ></script>
    <script type="text/javascript">
        var icono = <?php echo "'".$data->getLogo()."'"; ?>;
        var iconoDetalle = <?php echo "'".$data->getLogoDetalle()."'"; ?>;
        var hospitalesLista =  value='1:TRAUMA;2:ROBOTICA;3:CORMILLOT;4:MATERNO;5:PEDIATRICO';
    </script>
    <script type="text/javascript" src="includes/js/index.js"></script>
</head>
<body>
    <!-- barra -->
    <div id="barra" >
        <!-- navegar -->
        <div id="barraImage" >
            <span style="font-size: 2em;" class="icon icon-about"></span>
        </div>
        <div id="navegar">
            &nbsp;&nbsp;&nbsp;<a href="../menu/">Sistema Informatica</a>&nbsp;&gt;&nbsp;<a href="#">Sectores</a>
        </div>
        <!-- /navegar-->
        <!-- usuario -->
        <div id="usuario">
            <a href="../usuario/"><span class="icon icon-boy"> </span>Usuario | <?=$data->getNombre()?></a>
        </div>
        <!-- /usuario-->
    </div>
    <!-- /barra -->
    <div id="container" align="center">
       <div id="demo">
            <p align="center">Sectores</p>

            <table id="jqVerSector"></table>

            <div id="jqSectFooter"></div>
            <input type="submit" class="button-secondary" value="Nuevo Sector" id="nuevoSector">
        </div>
        <div id="dialogSect" style="display: none;">
        </div>
    </div>

    <div name="loader" style="display:none;">Ingresando...</div>
    <!--NOTIFICACION -->
    <script src="../includes/plug-in/notificacion/js/classie.js"></script>
    <script src="../includes/plug-in/notificacion/js/notificationFx.js"></script>
    <!--/NOTIFICACION -->
</body>
</html>