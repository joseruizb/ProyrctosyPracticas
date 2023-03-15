<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


$x = 1;
$cad1 = "comillas dobles: 'cadena' \"cadena\" á é ñ ñ ñññññññ = $x <br><br>";
$cad2 = 'comillas simples "cadena" \'cadena\' á é ñññññññññ = $x <br><br>';
$nombre = "Jorge";
$cad3 = <<<fin
            Mi querida amiga <br>
            escribo estas líneas esperando que me leas. <br>
            <b>Firmado: $nombre</b>
            <br>
            <br>
            fin;

$cad4 = <<<'fin'
            Mi querida amiga <br>
            escribo estas líneas esperando que me leas. <br>
            <b>Firmado: $nombre</b> 
            <br>
            <br>
            fin;









inicioCabecera("Ejercicio 1");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 1");
cuerpo($cad1, $cad2, $cad3, $cad4);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($cad1, $cad2, $cad3, $cad4)
{

    echo $cad1;
    echo $cad2;
    echo $cad3;
    echo $cad4;


?>

<?php

}
