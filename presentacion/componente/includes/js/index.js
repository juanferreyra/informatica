function mostrarDialogo(paginaVista, paginaFuncion)
{
    $("#dialog:ui-dialog").dialog("destroy");
    $("#dialog-message").css('visibility',"visible");
    $("#dialogComp").load("includes/forms/" + paginaVista,function() {
        $("#dialogComp" ).dialog({
            modal: true,
            width: $("#divPrincipal").width()+100,
            title: $("#divPrincipal").attr('title'),
            buttons: {
                "Aceptar": function(){
                    frmOk = validar();
                    if(frmOk) {
                        $.ajax({
                            data: $("#formComponente").serialize(),
                            type: "POST",
                            dataType: "json",
                            url: "includes/ajaxFunctions/"+paginaFuncion,
                            success: function(data) {
                                if(data.ret) {
                                    $('#formComponente').get(0).reset();
                                    $('#jqVerComponentes').trigger("reloadGrid");
                                    //relodeo la tabla
                                }
                                //NOTIFICACION
                                // create the notification
                                var notification = new NotificationFx({
                                    message : '<div class="ns-thumb"><img src="../includes/plug-in/notificacion/img/'+icono+'"/></div><div class="ns-content"><p><a href="#">'+iconoDetalle+'&nbsp;</a>'+data.message+'</p></div>',
                                    layout : 'other',
                                    ttl : 6000,
                                    effect : 'thumbslider',
                                    type : 'notice'
                                });
                                // show the notification
                                notification.show();
                                //NOTIFICACION
                            }
                        });
                        $(this).dialog("close");
                    }
                },
                "Cerrar":function() {
                    $(this).dialog("close");
                }
            }
        });
    });
}

$(document).ready(function() {

    $("#jqVerComponentes").jqGrid({ 
        url:'includes/ajaxFunctions/verComponentes.php', 
        mtype: "POST",
        datatype: "json",
        colNames:['Nro','Detalle','Tipo Componente',''],
        colModel:[ 
            {name:'id', index:'id',width:'80%',align:"left",fixed:true,editable:false},
            {name:'detalle', index:'detalle',width:'250%',align:"center",fixed:true,editable:true},
            {name:'tipo', index:'tipo',width:'100%',align:"left",fixed:true,search: false, editable:true, edittype:"select",
                editoptions:{
                    value: tiposLista
                }
            },
            {name: 'myac', width: '50%', fixed: true, sortable: false, resize: false, formatter: 'actions', search: false,
                formatoptions: 
                {
                    keys: true,
                    delbutton: true,
                    editbutton: true,
                    onError: function(_, xhr) {
                        alert(xhr.responseText);
                    }
                }
            }
        ],
        rowNum:true,
        viewrecords: true,
        altRows : true,
        caption:"Componentes",
        rowNum:20, 
        rowList:[10,20,30,50],
        pager: '#jqCompFooter',
        sortname: 'id',
        sortorder: "desc",
        editurl :'includes/ajaxFunctions/modificarComponente.php',
        width: '100%',
        height: '100%'
    });

    $('#jqVerComponentes').jqGrid('navGrid', '#jqCompFooter', {
        edit:false,
        add:false,
        del:false,
        trash:false,
        search:false
    });

    jQuery("#jqVerComponentes").jqGrid('filterToolbar', {
        stringResult: true, 
        searchOnEnter: false, 
        defaultSearch : "cn"
    }); 

    $("#nuevoComponente").click(function(event){
        event.preventDefault(event);
        mostrarDialogo("nuevoComponente.php", "cargarComponente.php");
    });
});