$(document).ready(function(){

    $("#btnAgregarUsuario").click(function(event)
    {
    	event.preventDefault();
    	var enti = $('#entidad').val();
      $("#dialogAgregarUsuario").load("includes/forms/formIngresarUsuario.php",{entidad:enti});
      $( "#dialog:ui-dialog" ).dialog( "destroy" );
      $( "#dialogAgregarUsuario" ).css('visibility',"visible");
      $( "#dialogAgregarUsuario" ).dialog({
  			title:"Agregar Usuario",
  			resizable: false
  		});       
    });

    $("#btnEliminarUsuario").click(function(event)
    {
    	event.preventDefault();
    	var enti = $('#entidad').val();
  		$("#dialogEliminarUsuario").load("includes/forms/formQuitarUsuario.php",{entidad:enti});
  		$( "#dialog:ui-dialog" ).dialog( "destroy");
  		$( "#dialogEliminarUsuario" ).css('visibility',"visible");
  		$( "#dialogEliminarUsuario" ).dialog({
  			title:"Eliminar Usuario",
  			resizable: false
  		});
    });

    $("#btnVerUsuarios").click(function(event){
    	event.preventDefault();
    	var enti = $('#entidad').val();
   		$("#page").load("includes/forms/formVerUsuarios.php",{entidad:enti});       
  	});

  	$("#btnVerMiUsuario").click(function(event){
    	event.preventDefault();
    	var enti = $('#entidad').val();
   		$("#page").load("includes/forms/formMiUsuario.php",{entidad:enti});
  	});

    var enti = $('#entidad').val();
    $("#page").load("includes/forms/formMiUsuario.php",{entidad:enti});

});