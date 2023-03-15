<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


/**
 * Ejercicio01
 * 
 * Las pruebas se realizan caundo la clase no es abstracta al ser abstrracta no la podemos llamar por eso esta comentada
 */
/*
$instancia01 = new InstrumentoBase("Es una flauta reventada y vieja",1);
$instancia01 -> envejecer();
$instancia01 -> envejecer();
$cad01 = $instancia01 -> __toString();
$instancia02 = new InstrumentoBase("Es un piano utilizado por mi madre",10);
$cad02 = $instancia02 -> __toString();
*/
/**
 * Ejercicio02
 * 
 * 
 */
$in03 = new IFabricable("Plastico Calentado","Contenedor de plasticos");

/**
 * Ejercicio03
 * 
 * 
 */
$in04 = new InstrumentoViento(25);
$in05 = new InstrumentoViento(6, "metal");

/**
 * 
 * Ejercicio04
 */
$in06 = new Flauta();
$copiain06 = clone $in06; 
/**
 * 
 * Ejercicio05
 */

$in08 = new SerieFibonacci(10);

inicioCabecera("RELACION 4");
cabecera();
finCabecera();

inicioCuerpo("RELACION 4");
cuerpo(/*$cadena, $cad01, $cad02, $instancia03,*/$in03,$in04, $in05, $in06 , $copiain06 ,$in08);
finCuerpo();


function cabecera()
{
}


function cuerpo(/*$cadena, $cad01, $cad02,$instancia03,*/$in03,$in04, $in05, $in06, $copiain06 , $in08)
{
    /**
     * Ejercicio 1
     */
    echo "<h1>Ejercicio 1</h1>";
    echo "<h4>Al ser una clase Abstracta no podemos probarla</h4>";
    /**
     * Ejercicio 2
     */
    echo "<h1>Ejercicio 2</h1>";
    $in03->metodoFabricacion();
    echo "<br>";
    $in03->metodoReciclaje();
    /**
     * Ejercicio 3
     */
    echo "<h1>Ejercicio 3</h1>";
    echo $in04->__toString()."<br>";
    echo "<br>";
    echo $in05->__toString()."<br>";
    /**
     * Ejercicio 4
     */
    echo "<h1>Ejercicio 4</h1>";
    echo $in06->__toString()."<br>";
    echo "<br>";
    echo $copiain06->__toString()."<br>";
    /**
     * Ejercicio 5
     */
    echo "<h1>Ejercicio 5</h1>";
    foreach ($in08 as $valor) {
        echo "$valor &nbsp;";
    }
    echo "<br>";
    foreach (new SerieFibonacci(3) as $valor) {
        echo "$valor &nbsp;";
    }
    echo "<br>";

    //Con generadores
    echo "<h3>Con generadores</h3>";
    foreach ($in08->fFibonacci(10) as $numero){
         echo "$numero &nbsp;";
        } 
        
    echo "<br>";
 
    /**
     * Ejercicio 6
     */
    echo "<h1>Ejercicio 6</h1>";
    $Objeto = new MisPropiedades();
    $Objeto->propPublica = "publica";
    // $Objeto->_propPrivada="privada"; //no es valida al ser privada
    $Objeto->propiedad1 = 25;
    $Objeto->propiedad2 = "cadena de texto";
    $Objeto->propiedad3 = "Mr unchained";
    // echo "la propiedad 1 vale ".$Objeto->propiedad1."<br>";
    // echo $Objeto->propiedad3; // esto debería dar un error al no haber asignado previamente la propiedad 
    foreach ($Objeto as $clave => $valor) {
        echo "propiedad oi_" . key(current($Objeto)) . " valor $valor <br>";
    }




?>


<?php

}
