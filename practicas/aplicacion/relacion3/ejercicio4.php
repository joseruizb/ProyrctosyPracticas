<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


function devuelbe(&$valor,$va1,$va2){

    $res = $valor * $va1 * $va2;

    $valor = $valor + $va1 +$va2;

    return $res;
}










inicioCabecera("Ejercicio 4");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 4");
cuerpo();
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo()
{

$valor = 7;

echo $valor."<br>";    
echo devuelbe($valor,4,10)."<br>";
echo $valor;




?>


<?php

}