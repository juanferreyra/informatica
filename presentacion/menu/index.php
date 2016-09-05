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
// Completamos el vector con frases
$vector = array(
1 => "Nunca me decepcionas.",
2 => "Me encanta que me mimen y tú sabes mimarme todo el tiempo.",
3 => "La sabiduría es la hija de la experiencia.",
4 => " Jamás conocí a un hombre tan ambicioso y determinado como tú.",
5 => "Anoche estabas bien sexy con esa camisa.",
6 => "Si estuvieras aquí no tendría frío, ¿qué dices?",
7 => "Quiero desabrocharte esa camisa que llevas puesta.",
8 => "Mi cama está fría, ¿quieres hacer algo al respecto?",
9 => "Quisiera que pudieras ver lo que llevo puesto ahora",
10 => "Esta noche mis labios no dejaran ni un espacio de tu cuerpo en paz.",
11 => "Cuando todo sube, lo único que baja es la ropa interior.",
12 => "No puedo esperar a hacerte las cosas que estoy pensando.",
13 => "Te quiero ahora, pero adentro mio",
14 => "Que ganas de desabrochar algo, y recorrer con mis manos todo tu...",
15 => "Mis amigos están celosos de mí por tener un relación tan perfecta contigo.",
16 => "Vaya, te ves tan sexy. Todas las mujeres te están viendo.",
17 => "Tú eres el tipo de hombre que toda mujer sueña tener.",
18 => "Cuando estoy confundida sobre algo, me pregunto lo que habrías hecho en mi lugar.",
19 => "Sólo la idea de estar contigo en la cama me produce un cosquilleo.",
20 => "Te ves tan bien que haces que todas las mujeres de la sala me tengan envidia.",
21 => "Tu olor me excita. ¿Puedo llevarme tu camisa para dormir con ella cuando te vayas de viaje?",
22 => "Nunca me decepcionas.",
23 => "Me encanta que me mimen y tú sabes mimarme todo el tiempo.",
24 => "Eres tan inteligente ¿Cómo haces para siempre tener las respuestas a mis preguntas?",
25 => "Eres un hombre muy interesante. Sabes mucho sobre todo.",
26 => "Eres tan tierno y dulce que me haces sentir como a una gatita mimada.",
27 => "Mujeres solteras buscan sexo en tu zona. Ojito que soy yo sola nomas.",
);

// Obtenemos un número aleatorio
$numero = rand(1,26);

// Imprimimos la frase
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
	        var texto = <?php echo "'".$vector[$numero]."'"; ?>;

			$(document).ready(function(){
				//NOTIFICACION
		        // create the notification
		        var notification = new NotificationFx({
		            message : '<div class="ns-thumb"><img src="../includes/plug-in/notificacion/img/'+icono+'"/></div><div class="ns-content"><p><a href="#">'+iconoDetalle+'&nbsp;</a>'+texto+'</p></div>',
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
										echo "<li><a href='http://192.168.253.102:8084/soporteInformaticaTrauma/'><span>Sistema de stock</span></a></li>";
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
