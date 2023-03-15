<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


    $vector=array();
    $vector[1]="esto es una cadena";
    $vector["posi1"]=25.67;
    $vector[]=false;
    $vector["ultima"]= array(2,5,96);
    $vector[56]=23;







inicioCabecera("Ejercicio 6");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 6");
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
        elseif(is_int($val) == true){
            echo "entero bonito "." valor: ".$val." a binario ".decbin($val)."<br>";
        }
        elseif(is_double($val) == true){
            echo "Un real ".$val." al cuadrado ". sqrt($val)."<br>";
        }
        elseif(is_string($val) == true){
            echo "-".$val."-"."<br>";
        }
        elseif(is_bool($val) == true){ 
            if($val = true) echo "true";
            else if($val = false) echo "false";
            echo " y su opuesto ";
            if($val = true) echo "false";
            else if($val = false) echo "true";
            echo "<br>";
        }
    }







?>

<?php

}