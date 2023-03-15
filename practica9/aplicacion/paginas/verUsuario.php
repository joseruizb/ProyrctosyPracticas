<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


$mysqli = new mysqli($servidor, $usuario, $contra, $bd);
$sentencia = 'SELECT * from usuarios';
$sentenciaWhere = ' where nick=' . "'".$_GET["nick"]."'";
$sentencia = $sentencia.$sentenciaWhere;

if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
    exit;
}
$consulta = $mysqli->query($sentencia);


inicioCabecera("APLICACION PRUEBA");
cabecera();
finCabecera();

inicioCuerpo("VER");
cuerpo($consulta);
finCuerpo();



// **********************************************************


function cabecera()
{
}


function cuerpo($consulta)
{

    while ($fila = $consulta->fetch_array()) {

        echo $fila["cod_usuario"]."<br>". 
            $fila["nick"]."<br>". 
            $fila["nif"]."<br>". 
            $fila["direccion"]."<br>". 
            $fila["poblacion"]."<br>". 
            $fila["provincia"]."<br>". 
            $fila["CP"]."<br>". 
            $fila["fecha_nac"]."<br>". 
            $fila["borrado"]."<br>";
            echo "<img src=".$fila["foto"].">";
    }

?>




<?php

}
