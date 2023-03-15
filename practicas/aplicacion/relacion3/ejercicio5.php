<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");



function suma($v1,$v2){
    return $re = $v1 + $v2;
}
function resta($v1,$v2){
    return $re = $v1 + $v2;
}
function multiplicacion($v1,$v2){
    return $re = $v1 + $v2;
}
function hacerOperacion($op,$v1,$v2){
    
    switch ($op) {
        case "suma":
        return suma($v1,$v2);
        break;
        case "resta":
        return resta($v1,$v2);
        break;
        case "multiplicacion":
        return multiplicacion($v1,$v2);
        break;
        default:
        return "No existe la opcion introducida";
        break;
    }


}








inicioCabecera("Ejercicio 5");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 5");
cuerpo();
finCuerpo();



// **********************************************************

function cabecera()
{
}









function cuerpo()
{

    echo hacerOperacion("suma",1,1)."<br>";
    echo hacerOperacion("resta",1,1)."<br>";
    echo hacerOperacion("multiplicacion",1,1)."<br>";
    echo hacerOperacion("awdsgesg",1,1)."<br>";


?>

<?php

}
