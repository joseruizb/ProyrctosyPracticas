<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreriaLs.php");

$mysqli = new mysqli($servidor, $usuario, $contra, $bd);
$sentencia = 'INSERT INTO `usuarios` (`cod_usuario`,`nick`, `nif`, `direccion`, `poblacion`, `provincia`, `CP`, `fecha_nac`, `borrado`, `foto`) ';

$sentValues = "VALUES ('',";



if ($_POST) {

    if (isset($_POST["nick"])) {
        if ($_POST["nick"] != "") {
            $sentValues = $sentValues."'".$_POST['nick']."'". ', ';
        } else $sentValues = $sentValues . "'', ";
    }

    if (isset($_POST["nif"])) {

        if ($_POST["nif"] != "") {
            $sentValues = $sentValues."'".$_POST["nif"]."'".', ';
        } else $sentValues = $sentValues . "'', ";
    }

    if (isset($_POST["direccion"])) {

        if ($_POST["direccion"] != "") {
            $sentValues = $sentValues."'".$_POST["direccion"]."'".', ';
        } else $sentValues = $sentValues . "'', ";
    }

    if (isset($_POST["poblacion"])) {

        if ($_POST["poblacion"] != "") {
            $sentValues = $sentValues."'".$_POST["poblacion"]."'".', ';
        } else $sentValues = $sentValues . "'', ";
    }
    if (isset($_POST["provincia"])) {

        if ($_POST["provincia"] != "") {
            $sentValues = $sentValues."'".$_POST["provincia"]."'".', ';
        } else $sentValues = $sentValues . "'', ";
    }
    if (isset($_POST["CP"])) {

        if ($_POST["CP"] != "") {
            $sentValues = $sentValues."'".$_POST["CP"]."'".', ';
        } else $sentValues = $sentValues . "'', ";
    }
    if (isset($_POST["fecha_nac"])) {

        if ($_POST["fecha_nac"] != "") {
            $sentValues = $sentValues."'".$_POST["fecha_nac"]."'".', ';
        } else $sentValues = $sentValues . "'', ";
    }
    if (isset($_POST["borrado"])) {
        if (\validacionManual\validaRango($_POST["borrado"], [0,1])) {
        if ($_POST["borrado"]) {
            $sentValues = $sentValues.intval('1').', ';
        } else $sentValues = $sentValues . "0, ";
    }
    }
    if (isset($_POST['archivo'])) {

        if (\validacionManual\validaCadena($_POST["archivo"], 400, "")) {


            if ($_POST['archivo'] != "") {
                $sentValues = $sentValues . "foto =" . "'/../../imagenes/" . $_POST['archivo'] . "'";
            }
            else $sentValues = $sentValues . "''";
        }
    }

    $sentValues = $sentValues . ')';
    $sentencia = $sentencia . $sentValues;


    if ($mysqli->connect_errno) {
        echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
        exit;
    }
    $consulta = $mysqli->query($sentencia);

    header("location:/../../index.php");
}

inicioCabecera("APLICACION PRUEBA");
cabecera();
finCabecera();

inicioCuerpo("NUEVO USUARIO");
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


        <label>nick</label>
        <input type="text" name="nick">
        <br>
        <label>nif</label>
        <input type="text" name="nif">
        <br>
        <label>dirección</label>
        <input type="text" name="direccion">
        <br>
        <label>población</label>
        <input type="text" name="poblacion">
        <br>
        <label>provincia</label>
        <input type="text" name="provincia">
        <br>
        <label>CP</label>
        <input type="text" name="CP">
        <br>
        <label>fecha_nac</label>
        <input type="text" name="fecha_nac">
        <br>
        <label>borrado</label>
        <input type="checkbox" name="borrado">
        <br>
        <label>foto</label>
        <input name="archivo" type="file" />
        <br>
        <input type="submit" class="boton" value="Añadir usuario">



    </form>
<?php

}
