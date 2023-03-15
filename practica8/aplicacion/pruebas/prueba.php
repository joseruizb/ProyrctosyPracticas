<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


$ACL = new ACLArray();




inicioCabecera("Practica8");
cabecera();
finCabecera();

inicioCuerpo("Pruebas");
cuerpo($ACL);
finCuerpo();


// **********************************************************

function cabecera()
{
}


function cuerpo($ACL)
{

    echo $ACL->anadirUsuario("juan","juani","1234",1);
    echo $ACL->anadirUsuario("josemi","dudu","1234",1);
    echo "<br>";
    echo $ACL->dameUsuarios();
    echo $ACL->dameRoles();

?>


<?php
    
}

