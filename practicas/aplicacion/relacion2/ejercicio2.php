<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


$string = "Está la niña en casa";





inicioCabecera("Ejercicio 2");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 2");
cuerpo($string);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($string)
{

    $string1 = $string;
    for ($i = 0; $i < strlen($string1); $i++) {
        echo str_repeat('&nbsp;', $i);
        echo mb_substr($string1, $i, 1) . "<br>";
    }

    echo "<hr>";

    for ($i = strlen($string1) - 1; $i >= 0; $i--) {
        if ($i % 2 != 0) $string1[$i] = strtoupper($string1[$i]);
        else $string1[$i] = strtolower($string1[$i]);
        echo str_repeat('&nbsp;', $i);
        echo mb_substr($string1, $i, 1) . "<br>";
    }

    echo "<hr>";

    $partes = explode('a', $string);
    
    foreach($partes as $val)
    echo $val."<br>";

    echo "<hr>";

    echo str_replace("niña", "mujer", $string);
?>

<?php

}
