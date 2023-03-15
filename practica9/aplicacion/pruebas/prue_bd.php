<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Cabecera

//Sintaxis Orientada a Objetos
//Establece una conexión a un servidor MySQL
$mysqli = new mysqli($servidor,$usuario,$contra,$bd);


//Ejecuto una sentencia SQL
//Compruebo si se ha establecido o no la conexión.
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
    exit;
}
$sentencia = 'SELECT * from poblaciones';
$consulta = $mysqli->query($sentencia);
while($fila=$consulta->fetch_array()){

    $cadena = $fila["id_poblacion"]."-".$fila["nombre"]."-".$fila["id_provincia"];
}


// $sentencia = "insert into poblaciones (id_poblacion,nombre,id_provincia) values ('23','Mollina',29)";
// $consulta = $mysqli->query($sentencia);

// if($mysqli->affected_rows<>0){
//     echo "id de la fila insertada" . $mysqli->insert_id;

// }








inicioCabecera("APLICACION PRUEBA");
cabecera();
finCabecera();

inicioCuerpo("APLICACION PRUEBA");
cuerpo();
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo()
{
}
