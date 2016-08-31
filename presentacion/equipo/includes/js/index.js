function validar()
{
    if($('#idsector').val()=='')
    {
        //NOTIFICACION
        // create the notification
        var notification = new NotificationFx({
            message : '<div class="ns-thumb"><img src="../includes/plug-in/notificacion/img/'+icono+'"/></div><div class="ns-content"><p><a href="#">'+iconoDetalle+'&nbsp;</a>Tenes que seleccionar algun sector si o si!.</p></div>',
            layout : 'other',
            ttl : 6000,
            effect : 'thumbslider',
            type : 'notice'
        });
        // show the notification
        notification.show();
        //NOTIFICACION
        return false;
    }
    else
    {
        if($('#detalle').val()=='')
        {
            //NOTIFICACION
            // create the notification
            var notification = new NotificationFx({
                message : '<div class="ns-thumb"><img src="../includes/plug-in/notificacion/img/'+icono+'"/></div><div class="ns-content"><p><a href="#">'+iconoDetalle+'&nbsp;</a>Tenes que completar la MAC Address!.</p></div>',
                layout : 'other',
                ttl : 6000,
                effect : 'thumbslider',
                type : 'notice'
            });
            // show the notification
            notification.show();
            //NOTIFICACION
            return false;
        }
        else
        {

            if(isValidMac($('#detalle').val()))
            {
               return true
            }
            else
            {
                //NOTIFICACION
                // create the notification
                var notification = new NotificationFx({
                    message : '<div class="ns-thumb"><img src="../includes/plug-in/notificacion/img/'+icono+'"/></div><div class="ns-content"><p><a href="#">'+iconoDetalle+'&nbsp;</a>La MAC Address debe tener formato 02:42:a0:52:7b:90, algo asi!.</p></div>',
                    layout : 'other',
                    ttl : 6000,
                    effect : 'thumbslider',
                    type : 'notice'
                });
                // show the notification
                notification.show();
                //NOTIFICACION
                return false;
            }
        }
    }
}

function isValidMac(mac) {
  var a = mac.split(':');
  if (a.length !== 6) {
    return false;
  }
  for (var i=0; i<6; i++) {
    var s = "0x"+a[i];
    if (s>>0 === 0 || s.length != 4) {
      return false;
    }
  }
  return true;
}

checkValidMAC = function (value, colname) {
    if (isValidMac(value)) {
        return [true];
    } else {
        return [false, "La mac es invalida. Debe tener la pinta 02:42:a0:52:7b:90"];
    }
}

function verEquipo(id)
{
    $("#dialog_subcontent").load("includes/forms/listaComponentes.php",{equipo:id});
    $("#nuevoEquipo").click();
}

function verQR(id)
{
    $("#dialog_subcontent2").load("includes/forms/verQr.php",{equipo:id});
    $("#qrBtn").click();
}

$(document).ready(function(){

     $('#nuevoEquipo').click(function(){
        $("#dialog_subcontent").load("includes/forms/formularioEquipo.php")
    });

    $("#jgVerEquipos").jqGrid({
        url:'includes/ajaxFunctions/verEquipos.php',
        mtype: "POST",
        datatype: "json",
        colNames:['Nro','Detalle','Sector','Hospital','Componentes','',''],
        colModel:[ 
            {name:'id', index:'p.id',width:'30%',align:"left",fixed:true,editable:false },
            {name:'detalle', index:'e.detalle',width:'100%',align:"left",fixed:true,editable:true , editrules: { custom: true, custom_func: checkValidMAC }},
            {name:'tipo_detalle', index:'s.detalle',width:'100%',align:"left",fixed:true, editable:true, edittype:"select",
                editoptions:{
                    value: sectoresLista
                }
            },
            {name:'tipo_hospital', index:'h.detalle_corto',width:'100%',align:"left",fixed:true, editable:false },
            {name:'componentes', index:'p.componentes',width:'200%',align:"left",fixed:true, editable:false },
            {name:'act',index:'act', width:'100%', sortable:false,align:"center",search:false, fixed:true,editable:false},
            {name: 'myac', width: '40%', fixed: true, sortable: false, resize: false, formatter: 'actions', search: false,
                formatoptions:{
                    keys: true,
                    delbutton: true,
                    editbutton: true,
                    onError: function(_, xhr) {
                        alert(xhr.responseText);
                    }
                }
            }
        ],
        rowNum: true,
        viewrecords: true,
        altRows: true,
        caption: "Equipos",
        rowNum: 20, 
        rowList: [10,20,30,50],
        pager: '#jqEquiposfoot',
        sortname: 'id',
        sortorder: "desc",
        editurl :'includes/ajaxFunctions/modificarEquipo.php',
        width: '100%',
        height: '100%',
        gridComplete: function()
        { 
            var ids = jQuery("#jgVerEquipos").jqGrid('getDataIDs');
            for(var i=0;i < ids.length;i++)
            {
                var cl = ids[i];
                be = "<input class='button-secondary' type='button' value='Editar' onclick=\"javascript:verEquipo('"+cl+"');\" />";
                be +="<input class='button-secondary' type='button' value='QR' onclick=\"javascript:verQR('"+cl+"');\" />";
                jQuery("#jgVerEquipos").jqGrid('setRowData',ids[i],{act:be});
            }
        }
    });

    $('#jgVerEquipos').jqGrid('navGrid', '#jqEquiposfoot', {
        edit:false,
        add:false,
        del:false,
        trash:false,
        search:false
    });

    $("#jgVerEquipos").jqGrid('filterToolbar', {
        stringResult: true,
        searchOnEnter: false,
        defaultSearch : "cn"
    });
});