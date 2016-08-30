
<?php
/*Agregado para que tenga el usuario*/
include_once '../../namespacesAdress.php';
include_once negocio.'usuario.class.php';
include_once negocio.'tipoComponente.class.php';
include_once datos.'tipoComponenteDatabaseLinker.class.php';

session_start();

if(!isset($_SESSION['usuario']))
{
    //echo "WHOOPSS, No se encontro ningun usuario registrado";
    header("Location: ../index.php?logout=1");
}

$usuario = $_SESSION['usuario'];

$data = unserialize($usuario);
/*fin de agregado usuario*/

$dbTipos = new TipoComponenteDatabaseLinker();
$tipos = $dbTipos->getTiposComponentes();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Componentes</title>
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
        <?php
            $text = "value='";

            for ($i=0; $i < count($tipos); $i++) {
                $text.=$tipos[$i]->getId().":".$tipos[$i]->getDetalle();
                if($i!=count($tipos)-1){
                    $text.=";";
                }
            }

            $text.="'";
        ?>

        var icono = <?php echo "'".$data->getLogo()."'"; ?>;
        var iconoDetalle = <?php echo "'".$data->getLogoDetalle()."'"; ?>;
        var tiposLista = <?php echo $text; ?>;
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
            &nbsp;&nbsp;&nbsp;<a href="../menu/">Sistema Informatica</a>&nbsp;&gt;&nbsp;<a href="#">Componentes</a>
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
            <p align="center">Componentes</p>

            <table id="jqVerComponentes"></table>

            <div id="jqCompFooter"></div>
            <input type="submit" class="button-secondary" value="Nuevo Componente" id="nuevoComponente">
        </div>
        <div id="dialogComp" style="display: none;">
        </div>
    </div>

    <div name="loader" style="display:none;">Ingresando...</div>
    <!--NOTIFICACION -->
    <script src="../includes/plug-in/notificacion/js/classie.js"></script>
    <script src="../includes/plug-in/notificacion/js/notificationFx.js"></script>
    <!--/NOTIFICACION -->
</body>
</html>