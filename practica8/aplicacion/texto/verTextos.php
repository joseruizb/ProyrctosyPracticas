<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

session_start();

$textoT = [];

$errores = [];

if($_POST){


    $txt = "";

    if(isset($_POST["texto"])){
        $txt = $_POST["texto"];
        $ob = new RegistroTexto($txt);
        $_SESSION["$ob"] = $ob;
    }

    if(isset($_POST["limpiar"])){
        session_unset();
        header("location:verTextos.php");
        exit;
    }

}

inicioCabecera("Practica8");
cabecera();
finCabecera();

inicioCuerpo("Ver Textos");
cuerpo($errores,$textoT);  
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($errores,$textoT)
{


?>


<?php
    formulario($errores,$textoT);
}

function formulario($errores,$textoT)
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

        <label for="texto">Introduce el texto</label>
        <input type="text" name="texto" id="texto" value="">
        <input type="submit" value="introduce" name="introduce">
        <input type="submit" value="limpiar" name="limpiar">
        <br>
        <textarea name="textoT" id="" cols="30" rows="10"><?php

            foreach($_SESSION as $var => $val) echo $val.PHP_EOL

        ?>


        </textarea>

    </form>
    <?php

}
