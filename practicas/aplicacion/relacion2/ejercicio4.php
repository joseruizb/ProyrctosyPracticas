<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


$v1 = 17.5;
$v2 = 379987.2375;
$vcd = "cadena";


$c1 = number_format($v1, 1, ',', '');
$c1 = str_repeat(0, 5) . $c1;
$c2 = number_format($v2, 2, ',', '.');



inicioCabecera("Ejercicio 4");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 4");
cuerpo($c1, $c2, $vcd);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($c1, $c2, $vcd)
{

    echo "la cadena es: $vcd , el primer valor -$c1- el segundo valor -$c2-";










?>


<?php

}
