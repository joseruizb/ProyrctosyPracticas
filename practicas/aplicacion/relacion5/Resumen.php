<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


$datos = [
    "nombre" => "",
    "fechaNac" => "",
    "fechaCarnet" => "",
    "horaLevantarse" => "",
    "dia" => "",
    "mes" => "",
    "año" => "",
    "estado" => "",
    "estudios" => "",
    "edad" => -1,
    "sueldo" => 0
];




if (isset($_GET["nombre"])) {
    $datos["nombre"] = $_GET["nombre"];
}
if (isset($_GET["fechaNac"])) {
    $datos["fechaNac"] = $_GET["fechaNac"];
}
if (isset($_GET["fechaCarnet"])) {
    $datos["fechaCarnet"] = $_GET["fechaCarnet"];
}
if (isset($_GET["horaLevantarse"])) {
    $datos["horaLevantarse"] = $_GET["horaLevantarse"];
}
if (isset($_GET["estado"])) {
    $datos["estado"] = $_GET["estado"];
}
if (isset($_GET["estudios"])) {
    $datos["estudios"] = $_GET["estudios"];
}
if (isset($_GET["edad"])) {
    $datos["edad"] = $_GET["edad"];
}
if (isset($_GET["sueldo"])) {
    $datos["sueldo"] = $_GET["sueldo"];
}


inicioCabecera("RESUMEN");
cabecera();
finCabecera();

inicioCuerpo("RESUMEN");
cuerpo($datos);
finCuerpo();


function cabecera()
{
}


function cuerpo($datos)
{
    
        $resumen = "Nombre: " . $datos["nombre"] .
            "<br>Fecha de Nacimiento: " . $datos["fechaNac"] .
            "<br>Fecha de Carnet: " . $datos["fechaCarnet"] .
            "<br>Hora de Levantarse: " . $datos["horaLevantarse"] .
            "<br>Estado: " . $datos["estado"] .
            "<br>Estudios: " . $datos["estudios"] .
            "<br>Edad: " . $datos["edad"] .
            "<br>Sueldo: " . $datos["sueldo"];

        echo $resumen;


?>
<?php

}
