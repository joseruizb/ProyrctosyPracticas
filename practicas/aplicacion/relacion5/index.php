<?php


include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreriaLs.php");
include_once("libreriaFilter.php");

//inicializaciones

$estado = [
    "Estudiante" => "Estudiante",
    "En paro" => "En paro",
    "Trabajando" => "Trabajando",
    "Jubilado" => "Jubilado"
];

$estudios = [
    "Sin Estudios" => "Sin Estudios",
    "Primaria" => "Primaria",
    "Secundaria" => "Secundaria",
    "Bachillerato" => "Bachillerato",
    "Ciclo formativo" => "Ciclo formativo",
    "Universidad" => "Universidad"
];

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
$errores = [];



//comprobar si se ha dado a insertar
if ($_POST) {
    /**
     * Nombre
     */
    $nombre = "";
    if (isset($_POST["nombre"])) {
        $nombre = $_POST["nombre"];
        $nombre = strtoupper(trim($nombre));
    }
    if ($nombre == "")
        $errores["nombre"][] = "Debe indicarse un nombre";

    if (!\validacionManual\validaCadena($nombre, 25, ""))
        $errores["nombre"][] = "El nombre no puede tener mas de 25 caracteres";

    if (!\validacionManual\validaExpresion($nombre, "/^H[A-z]*$/", ""))
        $errores["nombre"][] = "No puede empezar por H o h";
    $datos["nombre"] = $nombre;

    /**
     * FechaNac
     */
    $fechaNac = "";
    if (isset($_POST["fechaNac"])) {
        $fechaNac = $_POST["fechaNac"];
    }
    if (!\validacionManual\validaFecha($fechaNac, "07/07/2002"))
        $errores["fechaNac"][] = "La fecha de nacimineto es incorrecta";
    $datos["fechaNac"] = $fechaNac;

    /**
     * Fecha Carnet
     */
    $fechaCarnet = "";
    if (isset($_POST["dia"]) && isset($_POST["mes"]) && isset($_POST["año"])) {
        $dia = $_POST["dia"];
        $mes = $_POST["mes"];
        $año = $_POST["año"];
    }
    $fechaCarnet =  $dia . "/" . $mes . "/" . $año;
    if (!\validacionManual\validaFecha($fechaCarnet, "07/07/2002")) {
        $datos["dia"] = "07";
        $datos["mes"] = "07";
        $datos["año"] = "2002";
        $errores["fechaCarnet"][] = "La fecha del carnet es incorrecta";
    }
    $datos["fechaCarnet"] = $fechaCarnet;
    $datos["dia"] = $dia;
    $datos["mes"] = $mes;
    $datos["año"] = $año;

    /**
     *  hORA levantarse
     * 
     */
    $horaLevantarse = "";
    if (isset($_POST["horaLevantarse"])) {
        $horaLevantarse = $_POST["horaLevantarse"];
    }
    if (!\validacionManual\validaHora($horaLevantarse, "07:07:45"))
        $errores["horaLevantarse"][] = "La hora de levantarse es incorrecta";
    $datos["horaLevantarse"] = $horaLevantarse;

    /**
     * Estado
     */
    $est = "";

    if (isset($_POST["estado"])) {
        foreach ($estado as $pos) {
            if ($_POST["estado"] == $pos) $est = $pos;
        }
    }
    else $errores["estado"][] = "Debe indicarse un estado";

    $datos["estado"] = $est;

    /**
     * Estudios
     */
    $estud = "";
    $cadena = "";
    $aux = false;
    if (isset($_POST["estudios"])) {
        foreach ($_POST["estudios"] as $pos) {
            $cadena = $cadena . " " . $pos;
            if(trim($cadena) == "Sin Estudios") $aux = true;
            
        }
        if(trim($cadena) != "Sin Estudios" && $aux == true)
        $errores["estudios"][] = "No puede añadir otro estudio realizado si ha marcado Sin Estudios";
    }
    else $errores["estudios"][] = "Debe indicarse un estudio al menos";
    $estud = $cadena;
    $datos["estudios"] = $estud;





    /**
     *  Edad
     * 
     */
    $edad = "";
    if (isset($_POST["edad"])) {
        $edad = $_POST["edad"];
        $edad = (int) $edad;
    }
    if (!\validacionManual\validaEntero($edad, 0, 20, -1))
        $errores["edad"][] = "edad no esta entre dentro del rango(0-20)";
    $datos["edad"] = $edad;
    /**
     *  Sueldo
     * 
     */
    $sueldo = "";
    if (isset($_POST["sueldo"])) {
        $sueldo = $_POST["sueldo"];
        $sueldo = (float) $sueldo;
    }
    if (!\validacionManual\validaReal($sueldo, 1000, 150000, 0))
        $errores["sueldo"][] = "sueldo no esta entre dentro del rango(1000-150000)";
    $datos["sueldo"] = $sueldo;


    /**
     * Cuando no se encuentran errores se ejecuta el resumen
     */
    if (!$errores) {
        $codigo = 1;

        header("location:   Resumen.php?nombre={$datos["nombre"]}&fechaNac={$datos["fechaNac"]}&fechaCarnet={$datos["fechaCarnet"]}&horaLevantarse={$datos["horaLevantarse"]}&estado={$datos["estado"]}&estudios={$datos["estudios"]}&edad={$datos["edad"]}&sueldo={$datos["sueldo"]}");

        exit;
    }
}


inicioCabecera("Relacion 5");
cabecera();
finCabecera();

inicioCuerpo("RELACION 5");
cuerpo($datos, $errores, $estado, $estudios);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($datos, $errores, $estado, $estudios)
{


?>


<?php
    formulario($datos, $errores, $estado, $estudios);
}

function formulario($datos, $errores, $estado, $estudios)
{
    if ($errores) { //mostrar los errores
        echo "<div class='error'>";
        foreach ($errores as $clave => $valor) {
            foreach ($valor as $error)
                echo "$clave => $error<br>" . PHP_EOL;
        }
        echo "</div>";
    }

?>
    <form action="" method="post">



        <label for="nombre"><b>Nombre</b></label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $datos["nombre"]; ?>" size=21><br>



        <label for="fechaNac"><b>Fecha Nacimiento</b></label>
        <input type="text" name="fechaNac" id="fechaNac" value="<?php echo $datos["fechaNac"]; ?>" size=21><br>



        <label for="fechaCarnet"><b>Fecha Carnet</b></label>
        <br>
        <label for="dia">Dia</label>
        <input type="text" name="dia" id="dia" value="<?php echo $datos["dia"]; ?>" size=2 maxlength="2"><br>
        <label for="mes">Mes </label>
        <input type="text" name="mes" id="mes" value="<?php echo $datos["mes"]; ?>" size=2 maxlength="2"><br>
        <label for="año">Año </label>
        <input type="text" name="año" id="año" value="<?php echo $datos["año"]; ?>" size=2 maxlength="4"><br>



        <label for="horaLevantarse"><b>Hora Levantarse</b></label>
        <input type="text" name="horaLevantarse" id="horaLevantarse" value="<?php echo $datos["horaLevantarse"]; ?>" size=21 maxlength="25"><br>



        <label for="estado"><b>Estado</b></label>
        <br>

        <?php

        foreach ($estado as $var => $value) {
            echo "<label>$var</label>";
            echo "<input type=\"radio\" name=\"estado\" id=\"estado\" value=\"$value\">";
            echo "<br>";
        }


        ?>

        <label for="estudios"><b>Estudios</b></label>
        <br>

        <?php

        foreach ($estudios as $var => $value) {
            echo "<label>$var</label>";
            echo "<input type=\"checkbox\" name=\"estudios[]\" id=\"estudios\" value=\"$value\">";
            echo "<br>";
        }

        ?>




        <label for="edad"><b>Edad</b></label>
        <input type="text" name="edad" id="edad" value="<?php echo $datos["edad"]; ?>" size=4 maxlength="6">
        <br>



        <label for="sueldo"><b>Sueldo</b></label>
        <input type="text" name="sueldo" id="sueldo" value="<?php echo $datos["sueldo"]; ?>" size=4 maxlength="6">
        <br>



        <input type="submit" class="boton" value="Enviar">
    </form>
<?php
}
