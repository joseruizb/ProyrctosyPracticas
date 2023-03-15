<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


    $vector = array();

    for($i=0;$i<=55;$i++)
    $vector[$i] = 0;
    

    $vector[1] = 1;
    $vector[16] = 16;
    $vector[54] = 54;
    $vector[array_key_last($vector)] = 34;
    $vector["uno"] = "cadena";
    $vector["dos"] = true;
    $vector["tres"] = 1.345;

    $array[0] = 1;
    $array[1] = 34;
    $array[2] = 'nueva';

    array_push($vector,$array);

inicioCabecera("Ejercicio 4");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 4");
cuerpo($vector);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($vector)
{

    

    foreach ($vector as $val) {
        
        if(is_array($val) == true){
            foreach ($val as $val2){
                echo $val2." ";
            }
            echo "<br>";
        }
        else echo ($val);
        echo "<br>";
    }





?>


<?php

}