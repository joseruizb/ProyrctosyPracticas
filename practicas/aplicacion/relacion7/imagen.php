<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


inicioCabecera("IMAGEN");
cabecera();
finCabecera();

inicioCuerpo("IMAGEN");
cuerpo();
finCuerpo();


function cabecera()
{
}


function cuerpo()
{   


?>

<img src="imagen.jpg" alt=""> 



<?php

    $nombreSalida="imagen.jpg";
    header('Content-Type:'.'image/jpeg');
    header('Content-Disposition:attachment;filename="'.$nombreSalida.'"');
    //el contenido de un fichero
    echo file_get_contents("imagen.jpg");
}
