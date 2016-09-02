<?php
/*Agregado para que tenga el usuario*/
include_once '../../namespacesAdress.php';
include_once negocio.'usuario.class.php';
include_once datos.'usuarioDatabaseLinker.class.php';
include_once datos.'sectorDatabaseLinker.class.php';

session_start();

if(!isset($_SESSION['usuario']))
{
    //echo "WHOOPSS, No se encontro ningun usuario registrado";
    header("Location: ../index.php?logout=1");
}

$usuario = $_SESSION['usuario'];

$data = unserialize($usuario);
/*fin de agregado usuario*/

$db = new UsuarioDatabaseLinker();

$dbSector = new SectorDatabaseLinker();

$sectores = $dbSector->getSectores();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Equipos</title>
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
    <link rel="stylesheet" type="text/css" href="../includes/plug-in/dialogo/dialog.css" />
    <script type="text/javascript" src="../includes/plug-in/dialogo/dialogModernizrCustom.js" ></script>
    <script type="text/javascript" src="../includes/plug-in/jquery-core-1.11.3/jquery-core.min.js" ></script>
    <script type="text/javascript" src="../includes/plug-in/jquery-ui-1.11.4/jquery-ui.js" ></script>
    <script type="text/javascript" src="../includes/plug-in/jqGrid_5.0.2/js/i18n/grid.locale-es.js" ></script>
    <script type="text/javascript" src="../includes/plug-in/jqGrid_5.0.2/js/jquery.jqGrid.min.js" ></script>
    <script type="text/javascript" src="includes/js/index.js"></script>
    <script type="text/javascript">
        <?php
            $text = "value='";

            for ($i=0; $i < count($sectores); $i++) {
                $text.=$sectores[$i]->getId().":".$sectores[$i]->getDetalle()." ".$sectores[$i]->getHospital();
                if($i!=count($sectores)-1){
                    $text.=";";
                }
            }

            $text.="'";
        ?>

        var icono = <?php echo "'".$data->getLogo()."'"; ?>;
        var iconoDetalle = <?php echo "'".$data->getLogoDetalle()."'"; ?>;
        var sectoresLista = <?php echo $text; ?>;
    </script>
</head>
<body>
    <!-- barra -->
    <div id="barra" >
        <!-- navegar -->
        <div id="barraImage" >
            <span style="font-size: 2em;" class="icon icon-about"></span>
        </div>
        <div id="navegar">
            &nbsp;&nbsp;&nbsp;<a href="../menu/">Sistema Informatica</a>&nbsp;&gt;&nbsp;<a href="#">Equipos</a>
        </div>
        <!-- /navegar-->
        <!-- usuario -->
        <div id="usuario">
            <a href="../usuario/"><span class="icon icon-boy"> </span>Usuario | <?=$data->getNombre()?></a>
        </div>
        <!-- /usuario-->
    </div>
    <!-- /barra -->
    <div id="container">
       <div id="demo" align="center">
            <p align="center">Lista de equipos</p>
            <table id="jgVerEquipos"></table>
            <div id="jqEquiposfoot"></div>
            <input class="button-secondary" type="submit" value="Nuevo Equipo" id="nuevoEquipo" data-dialog="somedialog">
            <input type="submit"  data-dialogo="somedialog2" id="qrBtn" style='display:none;'>
        </div>
    </div>


    <!--dialogo 1 -->
    <div id="somedialog" class="dialog">
      <div class="dialog__overlay">
      </div>
      <div class="dialog__content">
        <button id="somedialog-close" class="action" data-dialog-close>X</button>
        <div id="dialog_subcontent">

        </div>
      </div>
    </div>
    <!--dialogo 2 -->
    <div id="somedialog2" class="dialog">
        <div class="dialog__overlay">
        </div>
        <div class="dialog__content">
            <button id="somedialog2-close" class="action" data-dialog-close>X</button>
            <div id="dialog_subcontent2">

            </div>
        </div>
    </div>

    <div name="loader" style="display:none;">Cargando...</div>
    <script type="text/javascript" src="../includes/plug-in/dialogo/dialogFx.js" ></script>
    <script type="text/javascript" src="../includes/plug-in/dialogo/dialogClassie.js" ></script>
    <!--NOTIFICACION -->
    <script src="../includes/plug-in/notificacion/js/classie.js"></script>
    <script src="../includes/plug-in/notificacion/js/notificationFx.js"></script>
    <!--/NOTIFICACION -->
    <script>
        (function() {

            var dlgtrigger = document.querySelector( '[data-dialog]' ),

              somedialog = document.getElementById( dlgtrigger.getAttribute( 'data-dialog' ) ),

              dlg = new DialogFx( somedialog );

            dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg),$("#dialog_subcontent").load("includes/forms/formularioEquipo.php"));

            var dlgtrigger = document.querySelector( '[data-dialogo]' ),

                somedialog2 = document.getElementById( dlgtrigger.getAttribute( 'data-dialogo' ) ),

                dlg2 = new DialogFx( somedialog2 );

            dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg2) );

        })();
    </script>
</body>
</html>