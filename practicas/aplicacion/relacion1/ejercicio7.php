<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


$vector = array("primera" =>12.56, 24=>true, 67 =>23.76);



inicioCabecera("Ejercicio 7");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 7");
cuerpo($vector);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($vector)
{

    



    echo current($vector)." | ".next($vector)." | ".next($vector);
    echo "<br>";
    echo print_r(array_keys($vector));
    echo "<br>";
    echo print_r(array_values($vector));

    
?>

<?php

}