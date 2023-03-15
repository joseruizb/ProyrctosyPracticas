<?php
define("RUTABASE", dirname(__FILE__));
//define("MODO_TRABAJO","produccion"); //en "produccion o en desarrollo
define("MODO_TRABAJO", "desarrollo"); //en "produccion o en desarrollo

if (MODO_TRABAJO == "produccion")
    error_reporting(0);
else
    error_reporting(E_ALL);


spl_autoload_register(function ($clase) {
    $ruta = RUTABASE . "/scripts/clases/";
    $fichero = $ruta . "$clase.php";

    if (file_exists($fichero)) {
        require_once($fichero);
    } else {
        throw new Exception("La clase $clase no se ha encontrado.");
    }
});

include(RUTABASE . "/aplicacion/plantilla/plantilla.php");
 //include(RUTABASE."/aplicacion/config/acceso_bd.php");

 //creo todos los objetos que necesita mi aplicación

$ACL = new ACLArray();
$acceso = new Acesso();

// if (!isset($_SESSION["usuario"])) {
//     header('WWW-Authenticate: Basic realm="Mensaje acceso"');
//     header('HTTP/1.0 401 Unauthorized');
//     echo 'Usuario incorrecto no puede acceder al sitio';
//     exit;
//    } else { 
//         $acceso->registrarUsuario();
//         $ACL->anadirUsuario();
//    }




