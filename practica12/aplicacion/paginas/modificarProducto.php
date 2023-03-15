<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreriaLs.php");

$parametros = "";





if (isset($_POST["Modificar"])) {


    if(isset($_POST["cod_categoria"]) && $_POST["cod_categoria"] != ""){
        $parametros = $parametros."&cod_categoria=".$_POST["cod_categoria"];
    }
    if(isset($_POST["nombre"]) && $_POST["nombre"] != ""){
        $parametros = $parametros."&nombre=".$_POST["nombre"];

    }
    if(isset($_POST["fabricante"]) && $_POST["fabricante"] != ""){
        $parametros = $parametros."&fabricante=".$_POST["fabricante"];

    }
    if(isset($_POST["unidades"]) && $_POST["unidades"] != ""){
        $parametros = $parametros."&unidades=".$_POST["unidades"];

    }
    if(isset($_POST["precio_venta"]) && $_POST["precio_venta"] != ""){
        $parametros = $parametros."&precio_venta=".$_POST["precio_venta"];

    }

    //creo una sesión CUrl
    $enlaceCurl = curl_init();

    curl_setopt(
        $enlaceCurl,
        CURLOPT_URL,
        "http://www.practica12.es/aplicacion/API/productos.php"
    );
    curl_setopt($enlaceCurl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($enlaceCurl, CURLOPT_POSTFIELDS, "cod_producto=" . $_GET['cod_producto'] . $parametros);
    curl_setopt($enlaceCurl, CURLOPT_HEADER, 0);
    curl_setopt($enlaceCurl, CURLOPT_RETURNTRANSFER, 1);
    curl_exec($enlaceCurl);
    //cierro la sesión
    curl_close($enlaceCurl);
    header("location:/../../index.php");
}


inicioCabecera("APLICACION PRUEBA");
cabecera();
finCabecera();

inicioCuerpo("MODIFICAR USUARIO");
cuerpo();
finCuerpo();



// **********************************************************


function cabecera()
{
}


function cuerpo()
{
?>
    <form action="" method="post">


        <label>cod_categoria</label>
        <input type="text" name="cod_categoria">
        <br>
        <label>nombre</label>
        <input type="text" name="nombre">
        <br>
        <label>fabricante</label>
        <input type="text" name="fabricante">
        <br>
        <label>fecha_alta</label>
        <input type="date" name="fecha_alta">
        <br>
        <label>unidades</label>
        <input type="text" name="unidades">
        <br>
        <label>precio_venta</label>
        <input type="text" name="precio_venta">
        <br>
        <input type="submit" class="boton" value="Modificar" name="Modificar">



    </form>
<?php

}
