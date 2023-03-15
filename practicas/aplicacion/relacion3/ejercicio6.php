<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");




function Ordenar($array){

    function Fam($a, $b){ 
    return strcasecmp(strlen($b), strlen($a));}

    usort($array, "Fam");

    foreach($array as $val){
        echo $val." ";

    }

}


inicioCabecera("Ejercicio 6");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 6");
cuerpo();
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo()
{




    $vector=array("uno", "grande", "caminos","a");
    Ordenar($vector); //el vector debe quedar (“caminos”,”grande”,”uno”,”a”)


?>

<?php

}