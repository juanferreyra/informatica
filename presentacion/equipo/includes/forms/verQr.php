<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'equipoDatabaseLinker.class.php';

$valor = $_REQUEST['equipo'];

$dbEquipo = new EquipoDatabaseLinker();

$equipo = $dbEquipo->getEquipo($valor);

$textQr = "Nro: ".$equipo->getId()."\n".$equipo->getDetalle()."\n".$equipo->getSector()->getDetalle()." ".$equipo->getSector()->getHospital();

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Códigos QR</title>
<script type="text/javascript" src="../includes/plug-in/qr/qrcode.js"></script>
<script type="text/javascript" src="../includes/plug-in/jqPrint/jquery.jqprint-0.3.js" ></script>
<script type="text/javascript">
$(document).ready(function(){
    var text = $('#msg').val().
        replace(/^[\s\u3000]+|[\s\u3000]+$/g, '');
    document.getElementById('qr').innerHTML = create_qrcode(text);

    $("#imprimirQr").click(function(event){
        event.preventDefault();
        $('#qr').jqprint();
    });    
});
</script>
</head>
<body>
<div data-role="content" align="center">
<form>
<input type="hidden" name="msg" id="msg" value="<?=$textQr?>">
</form>
<?php
echo $textQr;
?>
<hr>
<div id="qr"></div>
<hr>
<button class='button-secondary' id="imprimirQr">Imprimir</button>
</div>
</body>
</html>
