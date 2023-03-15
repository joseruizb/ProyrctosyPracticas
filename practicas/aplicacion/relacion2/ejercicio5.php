<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

$nombre = "Jorge";
$cad = <<<fin
            <s><b>Mi querida amiga</b></s> 
            escribo estas líneas esperando que me leas. 
            <br>
            2, 4, 7.5; 12; 13;
            <br>
            56 1 4
            <br>
            rider@lipo.co 
            juli@cumm.es    
            <br>
            <b>Firmado: $nombre</b>
            <br>
            <br>
            fin;

inicioCabecera("Ejercicio 5");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 5");
cuerpo($cad);
finCuerpo();



// **********************************************************

function cabecera()
{
}







function cuerpo($cad)
{


echo $cad;

echo "Correos electronicos: ".preg_match_all("/.{4}@.{4}\..{2}/",$cad)."<br>";
echo "Separaciones con (,): ".preg_match_all("/.,/",$cad)."<br>";
echo "Separaciones con (;): ".preg_match_all("/.;/",$cad)."<br>";
echo "Numeros enteros o decimales: ".preg_match_all("/[0-9]+(\.)?[0-9]?/",$cad)."<br>";
echo "Etiquetas de html: ".preg_match_all("/<.+>.+<\/.+>/",$cad)."<br>";
echo "Etiquetas de salto de linea(< br >): ".preg_match_all("/<br>/",$cad)."<br>";

?>

<?php

}
