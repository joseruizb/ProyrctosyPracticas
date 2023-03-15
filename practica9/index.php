<?php
include_once(dirname(__FILE__) . "/cabecera.php");

$mysqli = new mysqli($servidor, $usuario, $contra, $bd);
$sentencia = 'SELECT * from usuarios';
$sentenciaOrder = ' order by ';

$ordena = [
    "nick" => "nick",
    "provincia" => "provincia",
    "borrado" => "borrado"
];



if ($_POST) {

    if (isset($_POST["ordena"])) {
        foreach ($_POST["ordena"] as $pos) {
            $sentenciaOrder = $sentenciaOrder . $pos . ",";
        }
        $sentenciaOrder = trim($sentenciaOrder, ",");

        $sentencia = $sentencia . $sentenciaOrder;
    }
}




//Ejecuto una sentencia SQL
//Compruebo si se ha establecido o no la conexión.
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
    exit;
}
$consulta = $mysqli->query($sentencia);












inicioCabecera("Practicas");
cabecera();
finCabecera();

inicioCuerpo("PRACTICA 9");
cuerpo($consulta, $ordena);
finCuerpo();













// **********************************************************

function cabecera()
{
}


function cuerpo($consulta, $ordena)
{
?>

    <form action="" method="post">

        <label for="">Filtrar por:</label>
        <br>
        <?php

        foreach ($ordena as $var => $val) {
            echo "<label>$var</label>";
            echo "<input type=\"checkbox\" name=\"ordena[]\" id=\"ordena\" value=\"$val\">";
            echo "<br>";
        }

        ?>
        <input type="submit" class="boton" value="Filtrar">
        <br>


    </form>

    <hr>

    <table class="table">
        <tr>
            <td>cod_ususario</td>
            <td>nick</td>
            <td>nif</td>
            <td>dirección</td>
            <td>población</td>
            <td>provincia</td>
            <td>CP</td>
            <td>fecha_nac</td>
            <td>borrado</td>
            <td>OPERACIONES</td>
        </tr>
        <?php

        while ($fila = $consulta->fetch_array()) {

            echo "<tr>";
            echo "<td>" . $fila["cod_usuario"] . "</td>";
            echo "<td>" . $fila["nick"] . "</td>";
            echo "<td>" . $fila["nif"] . "</td>";
            echo "<td>" . $fila["direccion"] . "</td>";
            echo "<td>" . $fila["poblacion"] . "</td>";
            echo "<td>" . $fila["provincia"] . "</td>";
            echo "<td>" . $fila["CP"] . "</td>";
            echo "<td>" . $fila["fecha_nac"] . "</td>";
            echo "<td>" . $fila["borrado"] . "</td>";
            echo "<td>" .
                "<a href='aplicacion/paginas/verUsuario.php?nick={$fila["nick"]}'>";
        ?>
            <img id="imgIni" src="/../imagenes/ver.png">
            <?php
            echo "</a>" .
                "<a href='aplicacion/paginas/modificarUsuario.php?nick={$fila["nick"]}'>";
            ?>
            <img id="imgIni" src="/../imagenes/modificar.png">
            <?php
            echo "</a>" .
                "<a href='aplicacion/paginas/borrarUsuario.php?nick={$fila["nick"]}'>";
            ?>
            <img id="imgIni" src="/../imagenes/borrar.png">
        <?php
            echo "</a>"."</td>";
            echo "</tr>";
        }

        ?>
    </table>

    <a href="aplicacion/paginas/nuevoUsuario.php">Nuevo Usuario</a>

<?php

}
