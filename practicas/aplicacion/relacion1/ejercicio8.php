<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");






$fecha01= date("d/m/Y");
$fecha02 = "dia ".date(" d ")." de ".date(" M ")." de ".date(" Y ")." ,dia de la semana ".date(" D ");
$hora01= date("h:m:s.m");
// ---------------------------------------------------------------------------------------------------
$fecha1=mktime(0,0,0,3,29,2012);
$fecha11 = date("d/m/Y",$fecha1);
$fecha12 = "dia ".date(" d ",$fecha1)." de ".date(" M ",$fecha1)." de ".date(" Y ",$fecha1)." ,dia de la semana ".date(" D ",$fecha1);
$hora1=mktime(12,45,00);
$hora11 = date("H:i:s",$hora1);
// ------------------------------------------------------------------------------------------
$fecha2 = date("d-m-Y");
$fecha21 = date("d-m-Y",strtotime($fecha2."- 12 days")); 
$fecha22 = "dia ".date(" d ",strtotime($fecha2."- 12 days"))." de ".date(" M ",strtotime($fecha2."- 12 days"))." de ".date(" Y ",strtotime($fecha2."- 12 days"))." ,dia de la semana ".date(" D ",strtotime($fecha2."- 12 days"));
$hora2 = date("H:i:s");
$hora21 = date("h:m:s.m",strtotime($hora2."- 4 hours")); 





inicioCabecera("Ejercicio 8");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 8");
cuerpo($fecha01,$fecha02,$hora01,$fecha11,$fecha12,$hora11,$fecha21,$fecha22,$hora21);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($fecha01,$fecha02,$hora01,$fecha11,$fecha12,$hora11,$fecha21,$fecha22,$hora21)
{
    echo $fecha01;
    echo "<br>";
    echo $fecha02;
    echo "<br>";
    echo $hora01;
    echo "<br>";
    echo "<br>";

    // -------------------------------------------------------------------

 
    echo $fecha11;
    echo "<br>";
    echo $fecha12;
    echo "<br>";
    echo $hora11;
    echo "<br>";
    echo "<br>";

    
    //------------------------------------------------------


    echo $fecha21;
    echo "<br>";
    echo $fecha22;
    echo "<br>";
    echo $hora21;
    echo "<br>";
    echo "<br>";

?>

<?php

}