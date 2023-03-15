<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//inicializaciones
$colores = [
    "rojo" => "red",
    "azul" => "blue",
    "amarillo" => "yellow",
    "negro" => "black"
];
$grosor = [
    1 => "fino",
    2 => "medio",
    3 => "gordo"
];

$datos = [
    "x" => 0,
    "y" => 0,
    "color" => "",
    "grosor" => ""
];
$errores = [];

/**
 * array donde guardaremos los objetos
 */
$Puntos = array();

/**
 * Abrimos el fichero y añadimos al array de Punto s los puntos almacenados en el .dat
 */
$fich = fopen("puntos.dat", "r+");

while ($linea = fgets($fich)) {
    $linea = str_replace("\r", "", $linea);
    $linea = str_replace("\n", "", $linea);

    if ($linea != "") {
        $aux = explode(";", $linea);

        array_push($Puntos, new Punto($aux[0], $aux[1], $aux[2], $aux[3]));
    }
}
crearImagen($Puntos);

if (isset($_REQUEST["oper"])) {
    $oper = intval($_REQUEST["oper"]);

    /**
     * 
     * Cuando estamos en el primero formulario
     */
    if ($oper == 1) {
        /**
         * 
         * 
         */
        $coordx = "";
        if (isset($_POST["x"])) {
            $coordx = $_POST["x"];
        }
        if ($coordx > 500 || $coordx < 0)
            $errores["x"][] = "La coordenada x tiene que estar entre 0 y 500";
        $datos["x"] = $coordx;
        /**
         * 
         * 
         */
        $coordy = "";
        if (isset($_POST["y"])) {
            $coordy = $_POST["y"];
        }
        if ($coordy > 500 || $coordy < 0)
            $errores["y"][] = "La coordenada y tiene que estar entre 0 y 500";
        $datos["y"] = $coordy;
        /**
         * 
         * 
         */
        $color = "";
        if (isset($_POST["colores"])) {
            foreach ($colores as $pos => $val) {
                if ($_POST["colores"] == $val) $color = $val;
            }
        } else $errores["estado"][] = "Debe indicarse un color";

        $datos["color"] = $color;
        /**
         * 
         * 
         * 
         */
        $gr = "";
        if (isset($_POST["grosor"])) {
            foreach ($grosor as $pos => $val) {
                if ($_POST["grosor"] == $pos) $gr = $pos;
            }
        } else $errores["estado"][] = "Debe indicarse un grosor";

        $datos["grosor"] = $gr;
        /**
         * 
         * 
         * 
         */
        if (!$errores) {


            $pto = new Punto($datos["x"], $datos["y"], $datos["color"], $datos["grosor"]);
            array_push($Puntos, $pto);

            //  escribirAFichero("datos.pto",$pto);
            fwrite($fich, $pto . "\n");

            crearImagen($Puntos);
        }

        if (isset($_POST["enlace"])) {
            header("location: imagen.php?");
            exit;
        }
        /**
         * 
         * Cuando estamos en el segundo formulario
         */
    } else if ($oper == 2) {

        $borra = "";
        if (isset($_POST["ptoBorrar"])) {
            foreach ($Puntos as $pos => $val) {
                if ($_POST["ptoBorrar"] == $val) $borra = $val;
            }
        }

        if (isset($_POST["borrar"])) {
            foreach ($Puntos as $pos => $val) {
               
                if ($val == $borra) {
                    $aux ="";
                    $Puntos[$pos] = $aux;
                    $Puntos[$pos] = $Puntos[sizeof($Puntos)-1];
                    $Puntos[sizeof($Puntos)-1] = $aux;
                    array_pop($Puntos);
                }
            }
            $fich = fopen("puntos.dat", "w+");
            foreach ($Puntos as $pos => $val) fwrite($fich, $val . "\n");
            header("location: index.php?");

        }
        /**
         * 
         * Cuando estamos en el tercer formulario
         */
    } else if ($oper == 3) {

        if (isset($_FILES['archivo']['tmp_name'])) {

            $nombre = $_FILES['archivo']['tmp_name'];
            $fich2 = fopen($nombre, "r+");

            while ($linea = fgets($fich2)) {
                $linea = str_replace("\r", "", $linea);
                $linea = str_replace("\n", "", $linea);

                if ($linea != "") {
                    $aux = explode(";", $linea);
                    $pto = new Punto($aux[0], $aux[1], $aux[2], $aux[3]);
                    array_push($Puntos, $pto);
                    fwrite($fich, $pto . "\n");
                }

            }
            fclose($fich2);
            header("location: index.php?");
        }

    }
    fclose($fich);
}


inicioCabecera("PRUEBA: articulos");
cabecera();
finCabecera();

inicioCuerpo("NUEVO ARTICULO");
cuerpo($datos, $errores, $colores, $grosor, $Puntos);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($datos, $errores, $colores, $grosor, $Puntos)
{


?>


<?php
    formulario($datos, $errores, $colores, $grosor, $Puntos);
}

function formulario($datos, $errores, $colores, $grosor, $Puntos)
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
    <form action="?oper=1" method="post">
        <label for="x">X: </label>
        <input type="text" name="x" id="x" value="<?php echo $datos["x"]; ?>" size=5><br>
        <label for="x">Y: </label>
        <input type="text" name="y" id="y" value="<?php echo $datos["y"]; ?>" size=5><br>
        <select name="colores" id="colores">
            <?php
            foreach ($colores as $var => $val) {
                echo "<option name=\"colores\" id=\"colores\" value=\"$val\">" . $var . "</option>";
            }
            ?>
        </select>
        <br>
        <?php

        foreach ($grosor as $var => $val) {
            echo "<label>$val</label>";
            echo "<input type=\"radio\" name=\"grosor\" id=\"grosor\" value=\"$var\">";
            echo "<br>";
        }


        ?>
        <br>
        <input type="submit" class="boton" value="Crear">
        <input type="submit" class="boton" name="enlace" id="enlace" value="enlace">
        <br>
        <br>
        <br>
        <textarea name="Puntos" id="Puntos" cols="80" rows="20"><?php
                                                                foreach ($Puntos as $var => $val) {
                                                                    echo $val . PHP_EOL;
                                                                }
                                                                ?>
        </textarea>

        <br>
        <br>
        <br>
        <img src="imagen.jpg" alt="">
    </form>

    <form action="?oper=2" method="post">

        <select name="ptoBorrar" id="ptoBorrar">
            <?php
            foreach ($Puntos as $var => $val) {
                echo "<option name=\"ptoBorrar\" id=\"ptoBorrar\" value=\"$val\" >" . $val . "</option>";
            }
            ?>
        </select>

        <input type="submit" class="boton" name="borrar" id="borrar" value="borrar">


    </form>

    <form action="?oper=3" method="post" enctype="multipart/form-data">

        <!--MAX_FILE_SIZE debe preceder al campo de entrada de archivo-->
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
        Enviar este archivo: <input name="archivo" type="file" />
        <input type="submit" value="Enviar fichero" />


    <?php

}

function crearImagen($Puntos)
{

    //ruta en la que se guardará el fichero
    $ruta = $_SERVER["DOCUMENT_ROOT"] . "/aplicacion/relacion7/";
    $nombre = "imagen.jpg";
    $ruta .= $nombre;
    $img = imagecreatetruecolor(500, 500);

    $color_fondo = imagecolorallocate($img, 255, 255, 255);
    imagefilledrectangle($img, 0, 0, 500, 500, $color_fondo);

    for ($i = 0; $i < sizeof($Puntos); $i++) {

        $color = "";
        $grosor = "";

        switch ($Puntos[$i]->color) {
            case "red":
                $color = imagecolorallocate($img, 255, 0, 0);
                break;
            case "blue":
                $color = imagecolorallocate($img, 0, 0, 255);
                break;
            case "yellow":
                $color = imagecolorallocate($img, 255, 233, 0);
                break;
            case "black":
                $color = imagecolorallocate($img, 0, 0, 0);
                break;
        }

        switch ($Puntos[$i]->grosor) {
            case "1":
                $grosor = 50;
                break;
            case "2":
                $grosor = 100;
                break;
            case "3":
                $grosor = 150;
                break;
        }

        imagefilledellipse($img, $Puntos[$i]->x, $Puntos[$i]->y, $grosor, $grosor, $color);
    }



    $archivo = $ruta;
    imagejpeg($img, $archivo);
}
