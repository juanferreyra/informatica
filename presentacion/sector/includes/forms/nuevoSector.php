<?php
/*Agregado para que tenga el usuario*/
include_once '../../../../namespacesAdress.php';
include_once datos.'tipoComponenteDatabaseLinker.class.php';
include_once negocio.'usuario.class.php';

$dbComp = new TipoComponenteDatabaseLinker();

$componentes = $dbComp->getTiposComponentes();

session_start();

if(!isset($_SESSION['usuario']))
{
    echo "Debe Presionar F5 por que su session expiro.";
}

$usuario = $_SESSION['usuario'];

$data = unserialize($usuario);
/*fin de agregado usuario*/
?>
<!DOCTYPE html>
    <script>

        function validar()
        {
            if($('#detalle').val()=='') {
                alert("Debe ingresar el nombre del componente.");
                return false;
            } else {
                return true;
            }
        }

    </script>
<body>
    <div id="divPrincipal" title="Agregar Sector" style="margin:0 auto 0 auto">

        <form method="post" name="formSector" id="formSector" >

            <label>Descripcion</label><br><input type="text" name="detalle" id="detalle" placeholder="Detalle de Sector" /><br/>

            <label>Hospital</label><br>
            <select id="idhospital" name="idhospital">
                <option value="1">Dr. Federico Abete “Trauma”</option>
                <option value="2">Centro Municipal de Cirugía Robótica</option>
                <option value="3">Centro Municipal de Obesidad y Enfermedades Metabólicas Dr. Alberto Cormillot</option>
                <option value="4">Hospital Materno Infantil María Eva Duarte de Perón</option>
                <option value="5">Hospital Central de Pediatría Dr. Claudio Zin</option>
            </select>
        </form>
    </div>
</body>
</html>