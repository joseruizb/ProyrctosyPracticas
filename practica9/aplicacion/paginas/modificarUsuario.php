<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreriaLs.php");

$mysqli = new mysqli($servidor, $usuario, $contra, $bd);
$sentencia = 'UPDATE usuarios';

$sentValues = ' SET ';

$sentWhere = ' where nick=' . "'" . $_GET["nick"] . "'";


if ($_POST) {

    if (isset($_POST["nick"])) {
        if (\validacionManual\validaCadena($_POST["nick"], 40, "")) {
            if ($_POST["nick"] != "") {
                $sentValues = $sentValues . "nick =" . "'" . $_POST['nick'] . "'" . ',';
            }
        }
    }

    if (isset($_POST["nif"])) {
        if (\validacionManual\validaCadena($_POST["nif"], 40, "")) {
            if ($_POST["nif"] != "") {
                $sentValues = $sentValues . "nif =" . "'" . $_POST['nif'] . "'" . ',';
            }
        }
    }

    if (isset($_POST["direccion"])) {
        if (\validacionManual\validaCadena($_POST["direccion"], 40, "")) {

            if ($_POST["direccion"] != "") {
                $sentValues = $sentValues . "direccion =" . "'" . $_POST['direccion'] . "'" . ',';
            }
        }
    }

    if (isset($_POST["poblacion"])) {
        if (\validacionManual\validaCadena($_POST["poblacion"], 40, "")) {

            if ($_POST["poblacion"] != "") {
                $sentValues = $sentValues . "poblacion =" . "'" . $_POST['poblacion'] . "'" . ',';
            }
        }
    }
    if (isset($_POST["provincia"])) {
        if (\validacionManual\validaCadena($_POST["provincia"], 40, "")) {

            if ($_POST["provincia"] != "") {
                $sentValues = $sentValues . "provincia =" . "'" . $_POST['provincia'] . "'" . ',';
            }
        }
    }
    if (isset($_POST["CP"])) {
        if (\validacionManual\validaEntero($_POST["CP"], 0, 1000000, 29200)) {

            if ($_POST["CP"] != "") {
                $sentValues = $sentValues . "CP =" . "'" . $_POST['CP'] . "'" . ',';
            }
        }
    }
    if (isset($_POST["fecha_nac"])) {
        if (\validacionManual\validaCadena($_POST["fecha_nac"], 40, "")) {

            if ($_POST["fecha_nac"] != "") {
                $sentValues = $sentValues . "fecha_nac =" . "'" . $_POST['fecha_nac'] . "'" . ',';
            }
        }
    }
    if (isset($_POST["borrado"])) {

        // if ($_POST["borrado"] != "") {
        //     $sentValues = $sentValues . "borrado =" . "'" . $_POST['borrado'] . "'" . ',';
        // }

        if (\validacionManual\validaRango($_POST["borrado"], [0, 1])) {
            if ($_POST["borrado"]) {
                $sentValues = $sentValues . "borrado =" . "'" . intval('1') . "'" . ',';
            }
        }
    }
    if (isset($_POST['archivo'])) {

        if (\validacionManual\validaCadena($_POST["archivo"], 400, "")) {


            if ($_POST['archivo'] != "") {
                $sentValues = $sentValues . "foto =" . "'/../../imagenes/" . $_POST['archivo'] . "'";
            }
        }
    }


    $sentValues = trim($sentValues, ",");
    $sentencia = $sentencia . $sentValues . $sentWhere;


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
        <input type="submit" class="boton" value="Modificar">



    </form>
<?php

}
