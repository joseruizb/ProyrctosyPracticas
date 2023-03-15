<?php
include_once(dirname(__FILE__) . "/cabecera.php");

setcookie("visitas",1,time()+60*60*24);



inicioCabecera("Practica8");
cabecera();
finCabecera();

inicioCuerpo("WEB JRB PRACTICA8");
cuerpo();
finCuerpo();


// **********************************************************

function cabecera()
{
}


function cuerpo()
{
?>
<a href="/aplicacion/personalizar/personalizar.php" id="link">Personalizar</a>
<a href="/aplicacion/texto/verTextos.php" id="link">VerTextos</a>
<a href="/aplicacion/pruebas/prueba.php" id="link">Prueba</a>
<br>
<?php
$_COOKIE["visitas"] = 1 + $_COOKIE["visitas"];
if(isset($_COOKIE["visitas"])) echo "<h1>esta es tu visita número ".$_COOKIE["visitas"]."</h1>";
    
}
