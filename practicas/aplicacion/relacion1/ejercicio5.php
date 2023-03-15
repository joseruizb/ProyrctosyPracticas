<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");



$vector = array();
$filas = 7;
$x = 1;

////Bucle que crea el Array
for ($fil = 0; $fil < $filas; $fil++) {
    for ($col = 0; $col < $filas; $col++) {
        $vector[$fil][$col] = $x;
        if ($col >= $x)
            $vector[$fil][$col] = " ";
    }
    $x++;
}



inicioCabecera("Ejercicio 5");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 5");
cuerpo($vector, $filas);
finCuerpo();



// **********************************************************

function cabecera()
{
}









function cuerpo($vector, $filas)
{


    //Bucle que lo muestra
    for ($fil = 0; $fil < $filas; $fil++) {
        for ($col = 0; $col < $filas; $col++) {
            echo $vector[$fil][$col];
            echo " ";
        }
        echo "<br>";
    }




?>

<?php

}
