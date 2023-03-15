<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


$coloresFondo = [
    "rojo" => "red",
    "azul" => "blue",
    "blanco" => "white",
    "negro" => "black",
    "cyan" => "cyan"
];
$coloresTexto = [
    "rojo" => "red",
    "azul" => "blue",
    "blanco" => "white",
    "negro" => "black"
];


$errores = [];

if($_POST){

    $colorfondo="";

    if (isset($_POST["coloresFondo"])) {
        foreach ($coloresFondo as $pos => $val) {
            if ($_POST["coloresFondo"] == $val) $colorfondo = $val;
        }
    } else $errores["coloresFondo"][] = "Debe indicarse un color";


    $colortexto="";

    if (isset($_POST["coloresTexto"])) {
        foreach ($coloresTexto as $pos => $val) {
            if ($_POST["coloresTexto"] == $val) $colortexto = $val;
        }
    } else $errores["coloresTexto"][] = "Debe indicarse un color";

    if(!$errores){
        
        setcookie("colorFondo",$colorfondo,time()+60*60.7*27,"/");
        setcookie("colorFondo",$colorfondo,time()+60*60.7*27);

        setcookie("colorTexto",$colortexto,time()+60*60.7*27,"/");
        setcookie("colorTexto",$colortexto,time()+60*60.7*27);

        header("location:personalizar.php?");
        exit;
    
    }

}

inicioCabecera("Practica8");
cabecera();
finCabecera();

inicioCuerpo("Personalizar");
cuerpo($errores,$coloresFondo,$coloresTexto);  
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($errores,$coloresFondo,$coloresTexto)
{


?>


<?php
    formulario($errores,$coloresFondo,$coloresTexto);
}

function formulario($errores,$coloresFondo,$coloresTexto)
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
        <label for="coloresFondo">Colores Fondo</label>
        <select name="coloresFondo" id="coloresFondo">
            <?php
            foreach ($coloresFondo as $var => $val) {
                echo "<option name=\"coloresFondo\" id=\"coloresFondo\" value=\"$val\">" . $var . "</option>";
            }
            ?>
        </select>
        <br>
        <label for="coloresTexto">Colores Texto</label>
        <select name="coloresTexto" id="coloresTexto">
            <?php
            foreach ($coloresTexto as $var => $val) {
                echo "<option name=\"coloresTexto\" id=\"coloresTexto\" value=\"$val\">" . $var . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" class="boton" value="Crear" name="Crear">
    </form>
    <?php

}
