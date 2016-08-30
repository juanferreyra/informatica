<?php
include_once '../../../../namespacesAdress.php';
include_once datos.'sectorDatabaseLinker.class.php';

$dbSector = new SectorDatabaseLinker();

$sectores = $dbSector->getSectores();
?>
<!--Titulo-->
<script type="text/javascript">
$(document).ready(function(){

    $('#guadarEquipoHeader').click(function(event){
        event.preventDefault();
        if(validar()){
            $.ajax({
                data: $("#formEquipo").serialize(),
                type: "POST",
                dataType: "json",
                url: "includes/ajaxFunctions/cargarEquipo.php",
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
                        $("#dialog_subcontent").load("includes/forms/listaComponentes.php",{equipo:data.idequipo});
                    }
                }
            });
        }
    });
});
</script>
<h2>
    <strong>Agregar Equipo</strong>
</h2>
<!-- /Titulo-->
<hr>
<form method="post" name="formEquipo" id="formEquipo" >
    <input type="text" name="detalle" id="detalle" placeholder="Nombre del equipo" /><br/><br/>
    <select name="idsector" id="idsector">
        <option value="">Seleccione un sector</option>
        <?php
        for ($i=0; $i < count($sectores); $i++) { 
            echo "<option value=".$sectores[$i]->getId().">".$sectores[$i]->getDetalle()." | ".$sectores[$i]->getHospital()."</option>";
        }
        ?>
    </select><br>
</form>
<input type="submit" name="guadarEquipoHeader" id="guadarEquipoHeader" class="button-secondary" value="Guardar"/>
<hr>