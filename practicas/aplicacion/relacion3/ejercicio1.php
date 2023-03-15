<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


function cuentaVeces(&$array, $texto, $num)
{
    static $x = 1;
    echo "Llamada numero $x a la función"."<br>";
    $array[$texto] = $num;

    $x++;
}





inicioCabecera("Ejercicio 1");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 1");
cuerpo();
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo()
{

    $vector = array();
    cuentaVeces($vector,"posicion", 7);
 //   echo $vector["posicion"];
    cuentaVeces($vector,"jijijija", 2);
  //  echo $vector["jijijija"];



    echo "Valores de el array: <br>";
    foreach($vector as $val)
    echo $val."<br>";



?>


<?php

}
