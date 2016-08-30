<?php
  $entidad = $_POST['entidad'];
?>
<script type="text/javascript">

	function validar()
	{
		if(document.forms["eliminarUsuarioform"]["usuario"].value=="" )
		{
			alert("Debe Ingresar el Usuario");
			return false;
		}
		
		return true;
	}

	$("#eliminarUser").click(function(event){
 		event.preventDefault();
 		if(validar())
 		{
      $.ajax({
        	data: $('#eliminarUsuarioform').serialize(),
        	type: "POST",
        	dataType: "json",
        	url: "includes/ajaxFunctions/eliminarUsuario.php",
       	success: function(data)
        	{
      		alert(data.message);
      		if(data.ret)
      		{
      			$('#eliminarUsuarioform').get(0).reset();	
      		}
        	}
      });
    }
}); 

</script>

<form id="eliminarUsuarioform">

	<a>Nombre de usuario: </a><input class="input" name="usuario" placeholder="Usuario"></br>

  <input type="hidden" name="entidad" value=<?php echo $entidad; ?> >

	<input class='button-secondary' type="submit" id="eliminarUser" value="Destruir" >

</form>