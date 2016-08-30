<?php
/*Agregado para que valide los usuarios*/
include_once '../../namespacesAdress.php';
include_once negocio.'usuario.class.php';
session_start();
$usuario = $_SESSION['usuario'];
$data = unserialize($usuario);
/*fin de agregado para que valide los usuarios*/
$entidad = $_SESSION['entidad'];

if(!isset($_SESSION['usuario']))
{
    //echo "WHOOPSS, No se encontro ningun usuario registrado";
    header("Location: ../../index.php?logout=1");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Usuario</title>
        <link media="screen" type="text/css" rel="stylesheet" href="../includes/css/demo.css" >
        <link media="screen" type="text/css" rel="stylesheet" href="../includes/css/barra.css">
        <link media="screen" type="text/css" rel="stylesheet" href="../includes/css/iconos.css">

        <link media="screen" type="text/css" rel="stylesheet" href="../includes/plug-in/jquery-ui-1.11.4/jquery-ui.css" />
        <link media="screen" type="text/css" rel="stylesheet" href="../includes/plug-in/jqGrid_5.0.2/css/ui.jqgrid.css" />

        <script type="text/javascript" src="../includes/plug-in/jquery-core-1.11.3/jquery-core.min.js" ></script>
        <script type="text/javascript" src="../includes/plug-in/jquery-ui-1.11.4/jquery-ui.js" ></script>
        <script type="text/javascript" src="../includes/plug-in/jqGrid_5.0.2/js/i18n/grid.locale-es.js" ></script>
        <script type="text/javascript" src="../includes/plug-in/jqGrid_5.0.2/js/jquery.jqGrid.min.js" ></script>
        <script type="text/javascript" src="includes/js/usuarios.js"></script>
    </head>
    <body style="background-image: url(includes/images/pattern.png);">
        <!-- barra -->
        <div id="barra" >
            <!-- navegar -->
            <div id="barraImage" >
                <span style="font-size: 2em;" class="icon icon-about"></span>
            </div>
            <div id="navegar">
                &nbsp;&nbsp;&nbsp;<a href="../menu/">Sistema SITU</a>&nbsp;&gt;&nbsp;<a href="">Usuarios</a>
            </div>
            <!-- /navegar-->
            <!-- usuario -->
            <div id="usuario">
                <a href="#"><span class="icon icon-boy"> </span>Usuario | <?=$data->getNombre()?></a>
            </div>
            <!-- /usuario-->
        </div>
        <!-- /barra -->
        <div class="container">
            <table align="center">
                <tr>
                    <td>
                        <h2>Usuarios</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="content" align="center">
                            <?php
                            if ($data->tienePermiso('CREAR_USUARIO')){ echo "<input id='btnAgregarUsuario' class='button-secondary'  type='button' value='Nuevo usuario' /><br>";}
                            if ($data->tienePermiso('ELIMINAR_USUARIO')){ echo "<input id='btnEliminarUsuario' class='button-secondary'  type='button' value='Baja de usuario' /><br>";}
                            if ($data->tienePermiso('VER_USUARIOS')){ echo "<input id='btnVerUsuarios' class='button-secondary'  type='button' value='Ver usuarios' /><br>";}
                            echo "<input id='btnVerMiUsuario' class='button-secondary'  type='button' value='Mi Usuario' /><br>";
                            ?>
                        </div>
                    </td>
                </tr>
            </table>
            <div id="page" >

            </div>
            <input type="hidden" id='entidad' value="<?php echo $entidad; ?>" >
            <div id="dialogAgregarUsuario" style="visibility:hidden;"> </div>
            <div id="dialogEliminarUsuario" style="visibility:hidden;"> </div>
            <div id="dialogForm" style="visibility:hidden;"> </div>
    </body>
</html>
