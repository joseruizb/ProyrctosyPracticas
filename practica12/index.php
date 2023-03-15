<?php
include_once(dirname(__FILE__) . "/cabecera.php");


$ordena = [
    "nombre" => "nombre",
    "categoria" => "cod_categoria",
    "borrado" => "borrado"
];

$sentenciaOrder = "";

if (isset($_POST["filtrar"])) {

    if (isset($_POST["ordena"])) {
        foreach ($_POST["ordena"] as $pos) {
            $sentenciaOrder = $sentenciaOrder . $pos . ",";
        }
        $sentenciaOrder = trim($sentenciaOrder, ",");
    }
}



//creo una sesión CUrl
$enlaceCurl = curl_init();
//se indican las opciones para una petición HTTP GET
curl_setopt(
    $enlaceCurl,
    CURLOPT_URL,
    "http://www.practica12.es/aplicacion/API/productos.php?orden=" . $sentenciaOrder
);
curl_setopt($enlaceCurl, CURLOPT_HTTPGET, 1);
curl_setopt($enlaceCurl, CURLOPT_HEADER, 0);
curl_setopt($enlaceCurl, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($enlaceCurl, CURLOPT_PROXY, "192.168.2.254:3128");
//ejecuto la petición
$productos = curl_exec($enlaceCurl);
//cierro la sesión
curl_close($enlaceCurl);

$productos = str_replace('}{', '};{', $productos);
$productos = explode(';', $productos);

for ($i = 0; $i < sizeof($productos); $i++) {
    $productos[$i] = json_decode($productos[$i], JSON_PRETTY_PRINT);
}

inicioCabecera("Practicas");
cabecera();
finCabecera();

inicioCuerpo("PRACTICA 12");
cuerpo($productos, $ordena);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($productos, $ordena)
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
        <input type="submit" class="boton" name="filtrar" value="Filtrar">
        <br>


    </form>





    <a href="aplicacion/paginas/nuevoProducto.php">Nuevo Producto</a>
    <br>
    <table class="table">
        <tr>
            <td>cod_producto</td>
            <td>cod_categoria</td>
            <td>nombre</td>
            <td>fabricante</td>
            <td>fecha_alta</td>
            <td>unidades</td>
            <td>precio_venta</td>
            <td>foto</td>
            <td>borrado</td>
            <td>OPERACIONES</td>
        </tr>
        <?php

        foreach ($productos as $consultaV) {
            echo "<tr>";
            echo "<td>" . $consultaV["cod_producto"] . "</td>";
            echo "<td>" . $consultaV["cod_categoria"] . "</td>";
            echo "<td>" . $consultaV["nombre"] . "</td>";
            echo "<td>" . $consultaV["fabricante"] . "</td>";
            echo "<td>" . $consultaV["fecha_alta"] . "</td>";
            echo "<td>" . $consultaV["unidades"] . "</td>";
            echo "<td>" . $consultaV["precio_venta"] . "</td>";
            echo "<td>" . $consultaV["foto"] . "</td>";
            echo "<td>" . $consultaV["borrado"] . "</td>";
            echo "<td>" .
                "<a href='aplicacion/paginas/verProducto.php?cod_producto={$consultaV["cod_producto"]}'>";
        ?>
            <img id="imgIni" src="/../imagenes/ver.png">
            <?php
            echo "</a>" .
                "<a href='aplicacion/paginas/modificarProducto.php?cod_producto={$consultaV["cod_producto"]}'>";
            ?>
            <img id="imgIni" src="/../imagenes/modificar.png">
            <?php
            echo "</a>" .
                "<a href='aplicacion/paginas/borrarProducto.php?cod_producto={$consultaV["cod_producto"]}'>";
            ?>
            <img id="imgIni" src="/../imagenes/borrar.png">
        <?php
            echo "</a>" . "</td>";
            echo "</tr>";
        }

        ?>
    </table>


<?php


}
