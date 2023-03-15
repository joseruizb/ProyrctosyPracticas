<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


function generarCadena($num){

    $string = "";

    if(is_integer($num) == false) $num = 10;


    $letras = array(
        1, 2, 3, 4, 5, 6, 7, 8, 9, 0,
        'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm',
        'A', 'Q', 'W', 'S', 'D', 'E', 'F', 'R', 'G', 'T', 'H', 'Y', 'J', 'U', 'K', 'I', 'L', 'O', 'P', 'Z', 'X', 'C', 'V', 'B', 'N', 'M',
        'ñ','Ñ','º','ª','!','@','#','·','$','%','&','/','(',')','=','?','\'','¡','^','[','`','+',']','*','´','{','¨','}','ç',
        '-','_','.',':',',',';'
    );

    for($i = 0;$i < $num; $i++)
    $string = $string.$letras[rand(0,94)];

    return $string;
}





inicioCabecera("Ejercicio 2");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 2");
cuerpo();
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo()
{
    
echo generarCadena("aa ")."<br>";
echo generarCadena(4);


?>

<?php

}