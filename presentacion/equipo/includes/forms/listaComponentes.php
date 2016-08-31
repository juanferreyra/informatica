<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'equipoDatabaseLinker.class.php';
include_once datos.'componenteDatabaseLinker.class.php';
include_once negocio.'equipo.class.php';

$idequipo = $_REQUEST['equipo'];

$dbEquipo = new EquipoDatabaseLinker();
$equipo = $dbEquipo->getEquipo($idequipo);

$dbComponente = new ComponenteDatabaseLinker();
$componentes = $dbComponente->getComponentes();
?>
<script type="text/javascript">

$(document).ready(function(){

    $("#jqVerComponentesEnEquipo").jqGrid({
        url:'includes/ajaxFunctions/verComponentesEnEquipo.php?idequipo='+<?=$idequipo?>, 
        mtype: "POST",
        datatype: "json",
        colNames:['Nro','Detalle','Tipo Componente',''],
        colModel:[ 
            {name:'id', index:'id',width:'80%',align:"left",fixed:true,editable:false},
            {name:'detalle', index:'detalle',width:'250%',align:"center",fixed:true,editable:false},
            {name:'tipo', index:'tipo',width:'100%',align:"left",fixed:true,search: false, editable:false},
            {name:'myac', width: '50%', fixed: true, sortable: false, resize: false, formatter: 'actions', search: false,
                formatoptions: 
                {
                    keys: true,
                    delbutton: true,
                    editbutton: false,
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
        editurl :'includes/ajaxFunctions/modificarComponenteEnEquipo.php?idequipo='+<?=$idequipo?>,
        width: 500,
        height: 100
    });

    $('#jqVerComponentesEnEquipo').jqGrid('navGrid', '#jqCompFooter', {
        edit:false,
        add:false,
        del:false,
        trash:false,
        search:false
    });

    $('#agregarComponente').click(function(event){
        event.preventDefault();
        $.ajax({
            data: $("#formAgrComponente").serialize(),
            type: "POST",
            dataType: "json",
            url: "includes/ajaxFunctions/agregarComponenteDeEquipo.php?idequipo="+<?=$idequipo?>,
            success: function(data)
            {
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
                if(data.result)
                {
                    $('#jqVerComponentesEnEquipo').trigger("reloadGrid");
                }
            }
        });
    });

    $('#guardarEquipoFooter').click(function(){
        //NOTIFICACION
        // create the notification
        var notification = new NotificationFx({
            message : '<div class="ns-thumb"><img src="../includes/plug-in/notificacion/img/'+icono+'"/></div><div class="ns-content"><p><a href="#">'+iconoDetalle+'&nbsp;</a>Equipo agregado a la tabla</p></div>',
            layout : 'other',
            ttl : 6000,
            effect : 'thumbslider',
            type : 'notice'
        });
        // show the notification
        notification.show();
        //NOTIFICACION
        $('#jgVerEquipos').trigger("reloadGrid");
        $('#somedialog-close').click();
    });

});
</script>
<!--Titulo-->
<h2>
    <strong>Agregar Equipo</strong>
</h2>
<!-- /Titulo-->
<hr>
    <label>Nro:</label><?=$equipo->getId()?><br>
    <label>MAC Address Equipo:</label><?=$equipo->getDetalle()?><br>
    <label>Sector:</label><?=$equipo->getSector()->getDetalle()." ".$equipo->getSector()->getHospital()?><br>
<hr>
<h2>
    <strong>Agregar Componentes</strong>
</h2>
<!-- /Titulo-->
<hr>
<form id="formAgrComponente">
    <label>Componente:</label>
    <select id="idcomponente" name="idcomponente">
        <?php
        for ($i=0; $i < count($componentes); $i++) { 
            echo "<option value=".$componentes[$i]->getId()." >".$componentes[$i]->getDetalle()."</option>";
        }
        ?>
    </select>
    <input type="submit" name="agregarComponente" id="agregarComponente" value="Agregar Componente" class="button-secondary" /><br/>
</form>
<div align="center">
    <table id="jqVerComponentesEnEquipo"></table>
    <div id="jqCompFooter"></div>
</div>
<hr>
<input type="submit" name="guardarEquipoFooter" id="guardarEquipoFooter" class="button-secondary" value="Guardar"/>