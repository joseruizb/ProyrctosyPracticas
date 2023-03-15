<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


//creo una sesión CUrl
$enlaceCurl = curl_init();

curl_setopt(
    $enlaceCurl,
    CURLOPT_URL,
    "http://www.practica12.es/aplicacion/API/productos.php?cod_producto=".$_GET["cod_producto"]
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
$productos = explode(';',$productos);

for ($i=0; $i < sizeof($productos) ; $i++) { 
    $productos[$i] = json_decode($productos[$i], JSON_PRETTY_PRINT);

}


if(isset($_POST["borrar"])){
    //creo una sesión CUrl
    $enlaceCurl2 = curl_init();
    //se indican las opciones para una petición HTTP GET
    curl_setopt(
        $enlaceCurl2,
        CURLOPT_URL,
        "http://www.practica12.es/aplicacion/API/productos.php"
    );
    curl_setopt($enlaceCurl2, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($enlaceCurl2, CURLOPT_POSTFIELDS, "cod_producto=".$_GET['cod_producto']);
    curl_setopt($enlaceCurl2, CURLOPT_HEADER, 0);
    curl_setopt($enlaceCurl2, CURLOPT_RETURNTRANSFER, 1);
    curl_exec($enlaceCurl2);
    //cierro la sesión
    curl_close($enlaceCurl2);

    header("location:/../../index.php");
}



inicioCabecera("APLICACION PRUEBA");
cabecera();
finCabecera();

inicioCuerpo("VER");
cuerpo($productos);
finCuerpo();



// **********************************************************


function cabecera()
{
}


function cuerpo($productos)
{

    foreach($productos as $producto){
        echo $producto["cod_producto"] . "<br>";
        echo $producto["cod_categoria"] . "<br>";
        echo $producto["nombre"] . "<br>";
        echo $producto["fabricante"] . "<br>";
        echo $producto["fecha_alta"] . "<br>";
        echo $producto["unidades"] . "<br>";
        echo $producto["precio_venta"] . "<br>";
        echo $producto["foto"] . "<br>";
        echo $producto["borrado"] . "<br>";
    }
    

?>

<form action="" method="post">

    <input type="submit" name="borrar" class="boton" value="borrar">





</form>


<?php
}
