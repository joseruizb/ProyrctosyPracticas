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
    if (isset($_GET["cod_categoria"])) {

        //Ejecuto una sentencia SQL
        $consulta = mysqli_query($mysqli, "SELECT * FROM categorias WHERE cod_categoria = " . $_GET["cod_categoria"]);
        
        //obtengo una fila del conjunto resultado
        foreach($consulta as $fila){

        $res = json_encode($fila, JSON_PRETTY_PRINT);
    
        echo $res;
        }
        exit;
    }


    //no se ha indicado un id, se devuelven todos los elementos
    //Ejecuto una sentencia SQL
    $consulta = mysqli_query($mysqli, "SELECT * FROM categorias");

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

    $sentencia = 'INSERT INTO `categorias` (`cod_categoria`, `descripcion`) ';

    $sentValues = "VALUES ('', '".$_POST['descripcion']."'";



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
    if (isset($parametros["cod_categoria"])) //se ha pasado id
    {
        $sentencia = 'UPDATE categorias';

        $sentValues = ' SET ';

        $sentWhere = ' where cod_categoria=' . "'" . $parametros["cod_categoria"] . "'";

        if (isset($parametros["descripcion"])) {
          //  if (\validacionManual\validaCadena($parametros["nombre"], 40, "")) {
    
                if ($parametros["descripion"] != "") {
                    $sentValues = $sentValues . "descripcion =" . "'" . $parametros["descripcion"] . "'" . ',';
                }
          //  }
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
    if (isset($parametros["cod_categoria"])) //se ha pasado id
    {
        $sentenciaB = 'DELETE FROM `categorias` WHERE cod_categoria = '.$parametros["cod_categoria"];
    
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
