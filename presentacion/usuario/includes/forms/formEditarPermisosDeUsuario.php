<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'usuarioDatabaseLinker.class.php';

$obj = new UsuarioDatabaseLinker();

$acceso = $obj->traerPermisosDelUsuario($_REQUEST['idusuario'],$_POST['entidad']);

?>

<div class="post" id="wrapper">
	
	<div id="page">

		<form id="editarPermisosUsuarioform">
                    
            <input type="hidden" name="idusuario" value="<?=$_REQUEST['idusuario']?>" />

			<a>Este Usuario puede tener acceso a ...</a></br>

			<?php
			for ($i = 0; $i < count($acceso); $i++) 
            { 
                $idpermiso = $acceso[$i]['idpermiso'];
                $checked = $acceso[$i]['tiene'] ? "checked='checked'" : "";
                $detalle = $acceso[$i]['detalle'];
                
                echo "<input type='checkbox' name='accesos[]' value='".$idpermiso."' ".$checked." />";
                echo $detalle;
                echo '</br>';
			}
			?>

		</form>

	</div>

</div>