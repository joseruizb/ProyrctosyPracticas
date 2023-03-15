<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$var=12.700;
$cal1 = round($var);
$cal2 = floor($var);
$cal3 = pow($var,2);
$cal4 = sqrt($var);
$cal5 = dechex($var);
$cal6 = base_convert(round($var),4,8);







inicioCabecera("Ejercicio 2");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 2");
cuerpo($var,$cal1,$cal2,$cal3,$cal4,$cal5,$cal6);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($var,$cal1,$cal2,$cal3,$cal4,$cal5,$cal6)
{

echo "la variable sera ".$var;
echo "<br>";
echo "Round = ".$cal1;
echo "<br>";
echo "Floor = ".$cal2;
echo "<br>";
echo "Pow = ".$cal3;
echo "<br>";
echo "sqtr = ".$cal4;
echo "<br>";
echo "Entero a hexadecimal = ".$cal5;
echo "<br>";
echo "Base 4 a 8 = ".$cal6;




?>

<?php

}