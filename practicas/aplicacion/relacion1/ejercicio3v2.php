<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");



$tiradas=5;



inicioCabecera("Ejercicio 3v2");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 3v2");
cuerpo($tiradas);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($tiradas)
{
    $num = 0;
    $cont1 = 0; $cont2 = 0; $cont3 = 0; $cont4 = 0; $cont5 = 0; $cont6 = 0;
    for ($cont=1;$cont<=$tiradas;$cont++){
    echo "lanzamiento ".$cont." del dado: ";
    $num = (mt_rand()%5)+1;
    echo "$num"; 
    echo "<br>";

    //Creamos un switch con variables para contar los numeros que se repiten

    switch ($num) {
            case 1:
                $cont1++;
            break;
            case 2:
                $cont2++;
            break;
            case 3:
                $cont3++;
            break;
            case 4:
                $cont4++;
            break;
            case 5:
                $cont5++;
            break;
            case 6:
                $cont6++;
            break;
    }      
}

echo "<br>";
echo "lanzadado el dado ".$tiradas." veces"."<br>";

for ($cont=1;$cont<=6;$cont++){
    echo "<br>";
    echo "el ".$cont." ha salido ";
    switch ($cont) {
        case 1:
            echo $cont1." veces con un porcentaje de ";
            echo round($cont1/$tiradas*100);
            echo "%";
        break;
        case 2:
            echo $cont2." veces con un porcentaje de ";
            echo round($cont2/$tiradas*100);
            echo "%";
        break;
        case 3:
            echo $cont3." veces con un porcentaje de ";
            echo round($cont3/$tiradas*100);
            echo "%";
        break;
        case 4:
            echo $cont4." veces con un porcentaje de ";
            echo round($cont4/$tiradas*100);
            echo "%";
        break;
        case 5:
            echo $cont5." veces con un porcentaje de ";
            echo round($cont5/$tiradas*100);
            echo "%";
        break;
        case 6:
            echo $cont6." veces con un porcentaje de ";
            echo round($cont6/$tiradas*100);
            echo "%";
        break;}

}



?>

<?php

}