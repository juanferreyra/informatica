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
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Menu</title>
		<meta name="keywords" content="horizontal, slide out, menu, navigation, responsive, javascript, images, grid" />
		<meta name="author" content="Juan Ferreyra" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link media="screen" type="text/css" rel="stylesheet" href="../includes/css/barra.css">
		<link media="screen" type="text/css" rel="stylesheet" href="../includes/css/iconos.css">
		<link media="screen" type="text/css" rel="stylesheet" href="../includes/plug-in/jquery-ui-1.11.4/jquery-ui.css" />
	    <link media="screen" type="text/css" rel="stylesheet" href="../includes/plug-in/jquery-ui-1.11.4/jquery-ui.theme.css" />
	    <script type="text/javascript" src="../includes/plug-in/qr/qrcode.js"></script>
	    <script type="text/javascript" src="../includes/plug-in/jquery-core-1.11.3/jquery-core.min.js" ></script>
	    <script type="text/javascript" src="../includes/plug-in/jquery-ui-1.11.4/jquery-ui.js" ></script>
		<script src="js/modernizr.custom.js"></script>
		<!--NOTIFICACION -->
	    <link rel="stylesheet" type="text/css" href="../includes/plug-in/notificacion/css/ns-default.css" />
	    <link rel="stylesheet" type="text/css" href="../includes/plug-in/notificacion/css/ns-style-other.css" />
	    <script src="../includes/plug-in/notificacion/js/modernizr.custom.js"></script>
	    <!--/NOTIFICACION -->
		<script type="text/javascript">
			var icono = <?php echo "'".$data->getLogo()."'"; ?>;
	        var iconoDetalle = <?php echo "'".$data->getLogoDetalle()."'"; ?>;

			$(document).ready(function(){
				//NOTIFICACION
		        // create the notification
		        var notification = new NotificationFx({
		            message : '<div class="ns-thumb"><img src="../includes/plug-in/notificacion/img/'+icono+'"/></div><div class="ns-content"><p><a href="#">'+iconoDetalle+'&nbsp;</a>Hola Hermoso!</p></div>',
		            layout : 'other',
		            ttl : 6000,
		            effect : 'thumbslider',
		            type : 'notice'
		        });
		        // show the notification
		        notification.show();
		        //NOTIFICACION
	        });
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
	        	&nbsp;&nbsp;&nbsp;<a href="#">Sistema Informatica</a>
	        </div>
	        <!-- /navegar-->
	        <!-- usuario -->
            <div id="usuario">
                <a href="../usuario/"><span class="icon icon-boy"> </span>Usuario | <?=$data->getNombre()?></a> |
                <a href="../index.php?logout=1"><span class="icon icon-exit"> </span>Terminar sesión</a>
            </div>
            <!-- /usuario-->
		</div>
		<!-- /barra -->
		<div class="container">
			<header class="clearfix">
			</header>	
			<div class="main">
				<nav class="cbp-hsmenu-wrapper" id="cbp-hsmenu-wrapper">
					<div class="cbp-hsinner">
						<ul class="cbp-hsmenu">
							<li>
								<a href="#">Equipos</a>
								<ul class="cbp-hssubmenu">
									<?php
									if ($data->tienePermiso('VER_EQUIPOS')){
										echo "<li><a href='../equipo/index.php'><span>Equipo</span></a></li>";
									}
									if ($data->tienePermiso('VER_COMPONENTES')){
										echo "<li><a href='../componente/index.php'><span>Componente</span></a></li>";
									}
									if ($data->tienePermiso('VER_SECTORES')){
										echo "<li><a href='../sector/index.php'><span>Sector</span></a></li>";
									}
									?>
								</ul>
							</li>
							<li>
								<a href="#">Stock</a>
								<ul class="cbp-hssubmenu">
									<?php
									if ($data->tienePermiso('VER_EQUIPOS')){
										echo "<li><a href='http://192.168.253.102:8084/'><span>Sistema de stock</span></a></li>";
									}
									?>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</div>

			<div class="imagenLogo">

			</div>
		</div>
		<script src="js/cbpHorizontalSlideOutMenu.min.js"></script>
		<script>
			var menu = new cbpHorizontalSlideOutMenu( document.getElementById( 'cbp-hsmenu-wrapper' ) );
		</script>
		<!--NOTIFICACION -->
	    <script src="../includes/plug-in/notificacion/js/classie.js"></script>
	    <script src="../includes/plug-in/notificacion/js/notificationFx.js"></script>
	    <!--/NOTIFICACION -->
	</body>
</html>
