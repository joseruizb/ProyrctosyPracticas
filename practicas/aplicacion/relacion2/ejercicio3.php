<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//A partir de un array de letras y numeros
$arrayNum = array(
    1, 2, 3, 4, 5, 6, 7, 8, 9, 0,
    'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm',
    'A', 'Q', 'W', 'S', 'D', 'E', 'F', 'R', 'G', 'T', 'H', 'Y', 'J', 'U', 'K', 'I', 'L', 'O', 'P', 'Z', 'X', 'C', 'V', 'B', 'N', 'M'
);




inicioCabecera("Ejercicio 3");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 3");
cuerpo($arrayNum);
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo($arrayNum)
{

    for ($i = 0; $i < 20; $i++) {
        echo $arrayNum[rand(0,61)];
        
    }



    //A partir de los codigos ascii
    echo "<br>";
    for ($i = 0; $i < 20; $i++) {
        $ascii = mt_rand(48, 122);
        do {
            $ascii = mt_rand(48, 122);
        } while (($ascii >= 91 && $ascii <= 96) || ($ascii >= 58 && $ascii <= 64));

        echo chr($ascii);
    }


?>

<?php

}
