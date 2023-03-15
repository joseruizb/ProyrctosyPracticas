<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreriaLs.php");

$postFields = "";

if($_POST){
$postFields="cod_categoria=".$_POST["cod_categoria"]."&nombre=".$_POST["nombre"]."&fabricante=".$_POST["fabricante"]."&fecha_alta=".$_POST["fecha_alta"]."&unidades=".$_POST["unidades"]."&precio_venta=".$_POST["precio_venta"];
}




//creo una sesión CUrl
$enlaceCurl = curl_init();
//se indican las opciones para una petición HTTP Post
curl_setopt($enlaceCurl, CURLOPT_URL, "http://www.practica12.es/aplicacion/API/productos.php");
curl_setopt($enlaceCurl, CURLOPT_POST, 1);
curl_setopt($enlaceCurl, CURLOPT_POSTFIELDS, $postFields);
curl_setopt($enlaceCurl, CURLOPT_HEADER, 0);
curl_setopt($enlaceCurl, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($enlaceCurl, CURLOPT_PROXY, "192.168.2.254:3128");
//ejecuto la petición
curl_exec($enlaceCurl);
//cierro la sesión
curl_close($enlaceCurl);








//   header("location:/../../index.php");


inicioCabecera("APLICACION PRUEBA");
cabecera();
finCabecera();

inicioCuerpo("NUEVO PRODUCTO");
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
        <input type="submit" class="boton" value="Añadir usuario">



    </form>
<?php

}
