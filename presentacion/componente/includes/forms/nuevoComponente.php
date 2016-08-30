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
    <div id="divPrincipal" title="Agregar Componente" style="width: 200px; text-align: center; margin:0 auto 0 auto">

        <form method="post" name="formComponente" id="formComponente" >

            <input type="text" name="detalle" id="detalle" placeholder="Detalle Componente" /><br/><br/>

            Tipo:
            <select id="idtipo_componente" name="idtipo_componente">
                <?php
                for ($i=0; $i < count($componentes); $i++) {
                    echo "<option value=".$componentes[$i]->id." >".$componentes[$i]->detalle."</option>";
                }
                ?>
            </select>

        </form>

    </div>
</body>
</html>