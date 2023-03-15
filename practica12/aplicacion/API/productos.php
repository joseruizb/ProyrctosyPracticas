<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//Sintaxis procedimental
//Establece una conexión a un servidor MySQL
$mysqli = mysqli_connect($servidor, $usuario, $contra, $bd);
//Compruebo si se ha establecido o no la conexión.
if (mysqli_connect_errno($mysqli)) {
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
    exit;
}



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //petición por GET-> es una consulta
    if (isset($_GET["cod_producto"])) {

        //Ejecuto una sentencia SQL
        $consulta = mysqli_query($mysqli, "SELECT * FROM productos WHERE cod_producto = " . $_GET["cod_producto"]);
        
        //obtengo una fila del conjunto resultado
        foreach($consulta as $fila){

        $res = json_encode($fila, JSON_PRETTY_PRINT);
    
        echo $res;
        }
        exit;
    }


    if(isset($_GET["orden"]) && $_GET["orden"] != ""){
    //no se ha indicado un id, se devuelven todos los elementos
    //Ejecuto una sentencia SQL
    $consulta = mysqli_query($mysqli, "SELECT * FROM productos ORDER BY ".$_GET['orden']);

    }
    else{
    //no se ha indicado un id, se devuelven todos los elementos
    //Ejecuto una sentencia SQL
    $consulta = mysqli_query($mysqli, "SELECT * FROM productos");
    }

  //  while ($fila = $consulta->fetch_array()) {
    //obtengo una fila del conjunto resultado
    foreach($consulta as $fila){

    $res = json_encode($fila, JSON_PRETTY_PRINT);

    echo $res;
    }
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //petición por POST-> es una inserción

    //recojo los parametros y los compruebo
    //se inserta un elemento

    $sentencia = 'INSERT INTO `productos` (`cod_producto`, `cod_categoria`, `nombre`, `fabricante`, `fecha_alta`, `unidades`, `precio_venta`, `foto`, `borrado`) ';

    $sentValues = "VALUES ('', '".$_POST['cod_categoria']."' , '".$_POST['nombre']."' , '".$_POST['fabricante']."' , '".$_POST['fecha_alta']."', '".$_POST['unidades']."', '".$_POST['precio_venta']."', '', '0'";



    $sentValues = $sentValues . ')';
    $sentencia = $sentencia . $sentValues;


    if ($mysqli->connect_errno) {
        echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
        exit;
    }
    $consulta = $mysqli->query($sentencia);

    


    //todo correcto, en codigo podría poner el id del elementocreado

    //si hay algun error
    // header("HTTP/1.0 404 No se ha podido insertar.");
    //$resultado=[codigo=>0,
    // correcto=>false
    // ]; //hay error, en codigo devuelvo el codigo de error

    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    //petición por PUT-> es una modificación

    //recojo los parámetros
    $parametros = recogerParametros();

    //se inserta un elemento
    if (isset($parametros["cod_producto"])) //se ha pasado id
    {
        $sentencia = 'UPDATE productos';

        $sentValues = ' SET ';

        $sentWhere = ' where cod_producto=' . "'" . $parametros["cod_producto"] . "'";

    
        if (isset($parametros["cod_categoria"])) {
        //    if (\validacionManual\validaCadena($parametros["cod_categoria"], 40, "")) {
    
                if ($parametros["cod_categoria"] != "") {
                    $sentValues = $sentValues . "cod_categoria =" . "'" . $parametros["cod_categoria"] . "'" . ',';
                }
          //  }
        }
    
        if (isset($parametros["nombre"])) {
          //  if (\validacionManual\validaCadena($parametros["nombre"], 40, "")) {
    
                if ($parametros["nombre"] != "") {
                    $sentValues = $sentValues . "nombre =" . "'" . $parametros["nombre"] . "'" . ',';
                }
          //  }
        }
        if (isset($parametros["unidades"])) {
            //if (\validacionManual\validaCadena($parametros["unidades"], 40, "")) {
    
                if ($parametros["unidades"] != "") {
                    $sentValues = $sentValues . "unidades =" . "'" . $parametros["unidades"] . "'" . ',';
                }
            //}
        }
        if (isset($parametros["precio_venta"])) {
            //if (\validacionManual\validaCadena($parametros["unidades"], 40, "")) {
    
                if ($parametros["precio_venta"] != "") {
                    $sentValues = $sentValues . "precio_venta =" . "'" . $parametros["precio_venta"] . "'" . ',';
                }
            //}
        }
        

        $sentValues = trim($sentValues, ",");
        $sentencia = $sentencia . $sentValues . $sentWhere;
    
    
        if ($mysqli->connect_errno) {
            echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
            exit;
        }
        $consulta = $mysqli->query($sentencia);

        exit;
    }

    //no se ha indicado id a modificar,
    //se devuelve error
    header("HTTP/1.0 404 No se ha indicado el elemento a modificar.");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    //petición por DELETE-> es un borrado
    
    //recojo los parámetros
    $parametros = recogerParametros();
    //se inserta un elemento
    if (isset($parametros["cod_producto"])) //se ha pasado id
    {
        $sentenciaB = 'UPDATE productos';

        $sentValuesB = ' SET borrado =' . "'1'";
        
        $sentWhereB = ' where cod_producto=' . "'" . $parametros["cod_producto"] . "'";
        
        $sentenciaB = $sentenciaB . $sentValuesB . $sentWhereB;
    
        $consulta2 = $mysqli->query($sentenciaB);

        exit;
    }

    //no se ha indicado id a borrar,
    //se devuelve error
    header("HTTP/1.0 404 No se ha indicado el elemento a borrar.");
    exit;
}

echo "";
exit;
/********************************************************************/
function recogerParametros()
{
    //recojo los parámetros
    $ficEntrada = fopen("php://input", "r");

    $datos = "";
    while ($leido = fread($ficEntrada, 1024)) {
        $datos .= $leido;
    }

    fclose($ficEntrada);

    //convierto los datos en variables
    $par = [];
    $partes = explode("&", $datos);
    foreach ($partes as $parte) {
        $p = explode("=", $parte);
        if (count($p) == 2)
            $par[$p[0]] = $p[1];
    }

    return $par;
}

//cierro la conexión a la base de datos
mysqli_close($mysqli);
