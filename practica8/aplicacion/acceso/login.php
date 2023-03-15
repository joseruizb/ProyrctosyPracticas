<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

inicioCabecera("Practica8");
cabecera();
finCabecera();

inicioCuerpo("Ver Textos");
cuerpo();  
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo()
{


?>


<?php
    formulario();
}

function formulario()
{


?>
    <form action="" method="post">

    <input type="text" name="nombre">



    </form>

    <?php

}
