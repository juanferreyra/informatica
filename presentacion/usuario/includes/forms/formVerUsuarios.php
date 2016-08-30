<?php
$entidad = $_POST['entidad'];
?>
<header class="codrops-header">
	<h2 align="center" >Ver usuarios</h2>
</header>
<div id="dialogVerUsuarios">
	<div align="center">
            <table id="jqusuarios"></table>
            <div id="jqusuariosfoot"></div>
        </div>
</div>

<script type="text/javascript">

	function validarEditarPermisosUsuario()
	{		
		var acceso = document.getElementsByName('accesos[]');
		var hasChecked = false;
		
                for (var i=0; i< acceso.length; i++)
		{
			if (acceso[i].checked)
			{
				hasChecked = true;
				break;
			}
		}
               
		return hasChecked;
	}

    $("#jqusuarios").jqGrid(
    {

        url:'includes/ajaxFunctions/mostrarUsuarios.php', 
        postData: {'entidad' : "<?php echo $entidad; ?>" },
        mtype: "POST",
        datatype: "json",
        colNames:['Nombre', 'Detalle'], 
        colModel:[ 
            {name:'Nombre', index:'nombre', align:"left",fixed:true},
            {name:'Detalle', index:'detalle', align:"left",fixed:true},
        ], 
        viewrecords: true,
        altRows: true,
        caption: "Usuarios",
        rowNum: 20,
        rowList:[10,20,30,50],
        pager: '#jqusuariosfoot', 
        //editurl :'includes/ajaxFunctions/eliminarUsuario.php',
        width: '100%',
        height: '100%'
    });

    $("#editarPermisos").click(function(event) {
        event.preventDefault();
        sel = jQuery("#jqusuarios").jqGrid('getGridParam', 'selrow');
        if (sel !== null)
        {
            $("#dialog:ui-dialog").dialog( "destroy" );
            $("#dialogEditarPermisosUsuario").css('visibility',"visible");
            $("#dialogEditarPermisosUsuario").load(
                "includes/forms/formEditarPermisosDeUsuario.php",
                { idusuario:sel ,entidad:'<?php echo $entidad; ?>'},
                function() {
                    $("#dialogEditarPermisosUsuario").dialog({
                        title: "Permisos de usuario",
                        modal: true,
                        width: 1000,
                        buttons:
                        {
                            Guardar: function() 
                            {
                                var self = this;
                                
                                if(validarEditarPermisosUsuario())
                                {
                                    $.ajax({
                                        data: $('#editarPermisosUsuarioform').serialize(),
                                        type: "POST",
                                        dataType: "json",
                                        url: "includes/ajaxFunctions/editarPermisosUsuario.php",
                                        success: function(data)
                                        {
                                                alert(data.message);
                                                $(self).dialog("close");
                                        }
                                    });
                                }
                                else
                                {
                                        alert("Debe ingresar al menos una pantalla de acceso");
                                }
                            },
                            Cerrar: function() {
                                $(this).dialog("close");
                            }
                        }
                    });
                }
            );
        }
        else
        {
            alert("Primero debes seleccionar un usuario de la lista!");
        }
    });
    
</script>

<div align="center">
    <button class='button-secondary' id="editarPermisos">Editar permisos</button>
</div>

<div id="dialogEditarPermisosUsuario"  style="visibility: hidden;">
