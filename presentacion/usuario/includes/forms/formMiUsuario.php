<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'usuarioDatabaseLinker.class.php';

session_start();
$usuario = $_SESSION['usuario'];
$data = unserialize($usuario);
$entidad = $_POST['entidad'];
?>
<header>
	<h2 align="center" >Mi Cuenta</h2>
</header>

<div align="center">
    <table>
        <tr>
            <td>
                <img src="includes/images/user.jpg"></img>
            </td>
            <td>
                <form id="nombreForm">
                    <p>
                        <label for="nombre">Nombre Completo</label>
                        <input type="hidden" value="<?=$entidad?>" name="entidad" />
                        <input type="text" value="<?=$data->getNombre();?>" name="nombre" />
                    </p>

                    <button class='button-secondary' id="btnCambiarNombre">Cambiar nombre</button>
                </form>
                
                <form id="contrasenaForm">
                    <p>
                        <label for="vieja">Contrase&ntilde;a actual</label>
                        <input type="password" value="" name="vieja" />
                    </p>
                    
                    <p>
                        <label for="contrasena">Nueva contrase&ntilde;a</label>
                        <input type="password" value="" name="contrasena" />
                    </p>

                    <p>
                        <label for="repetir">Repetir nueva contrase&ntilde;a</label>
                        <input type="password" value="" name="repetir" />
                    </p>
                        <input type="hidden" value="<?=$entidad?>" name="entidad" />

                    <button class='button-secondary' id="btnCambiarContrasena">Cambiar contrase&ntilde;a</button>
                </form>
            </td>
        </tr>
    </table>
</div>


<script>
    
    $('#btnCambiarContrasena').click(function() {
            
        if(document.forms["contrasenaForm"]["vieja"].value == "")
        {
            alert("Debe ingresar su contraseña actual");
            return false;
        }
        
        if(document.forms["contrasenaForm"]["contrasena"].value == "")
        {
            alert("La contraseña debe tener al menos una letra o número");
            return false;
        }
        
        if(document.forms["contrasenaForm"]["repetir"].value == "")
        {
            alert("Debe reingresar la contraseña");
            return false;
        }
        
        if(document.forms["contrasenaForm"]["repetir"].value != document.forms["contrasenaForm"]["contrasena"].value)
        {
            alert("Las contraseñas no coinciden");
            return false;
        }
        
        $.ajax({
          	data: $('#contrasenaForm').serialize(),
          	type: "POST",
          	dataType: "json",
          	url: "includes/ajaxFunctions/cambiarContrasena.php",
         	success: function(data)
          	{
                alert(data.message);
          	},
            error: function (xhr)
            {
                alert(xhr.responseText);
            }
        });
        
        return false;
    });
    
    $('#btnCambiarNombre').click(function() 
    {
        if(document.forms["nombreForm"]["nombre"].value == "")
        {
            alert("Debe Ingresar el nombre completo");
            return false;
        }
        
        $.ajax({
          	data: $('#nombreForm').serialize(),
          	type: "POST",
          	dataType: "json",
          	url: "includes/ajaxFunctions/cambiarNombreUsuario.php",
         	success: function(data)
          	{
                alert(data.message);
                document.forms["nombreForm"]["nombre"].value = data.nombre;
                
          	}
        });
        
        return false;
    });
</script>