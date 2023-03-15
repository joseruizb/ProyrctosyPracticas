<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

inicioCabecera("Practicas");
cabecera();
finCabecera();

inicioCuerpo("CATASTRO");
cuerpo();
finCuerpo();



// **********************************************************

function cabecera()
{

}


function cuerpo()
{
?>

<a href="consulta_municipios.php">consulta_municipios</a>
<br>
<a href="consulta_por_datos.php">consulta_por_datos</a>
<br>
<a href="consulta_rustica.php">consulta_rustica</a>
<br>
<a href="consulta_por_datos_ajax.php">consulta_por_datos_ajax</a>
<br>
<?php


}
