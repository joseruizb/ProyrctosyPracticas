<?php

namespace validacionFilter;

// Esta función comprueba que $var
// contiene un entero cuyo valor está entre $min y $max
function validaEntero(&$var, $min, $max, $defecto){
      
    $opciones = [
        'options'=>["default"=>$defecto],
            "min_range"=>$min,
            "max:range"=>$max
        

    ];
    $aux = filter_var($var,FILTER_VALIDATE_INT,$opciones);
    
    if($aux!=$var){
        $var = $defecto;
        return false;

    }
    
    return true;


}

// Esta función comprueba que $var
// contiene un real cuyo valor está entre $min y $max
function validaReal(&$var, $min, $max, $defecto){

    $opciones = [
        'options'=>["default"=>$defecto],
            "min_range"=>$min,
            "max:range"=>$max
        

    ];
    $aux = filter_var($var,FILTER_VALIDATE_FLOAT,$opciones);
    
    if($aux!=$var){
        $var = $defecto;
        return false;

    }
    
    return true;


}

// Esta función comprueba que $var contiene una
// fecha correcta en el formato dd/mm/aaaa
function validaFecha(&$var, $defecto){
   



    

}

// Esta función comprueba que $var contiene una
// hora correcta en el formato hh:mm:ss.
function validaHora(&$var, $defecto){


}

// Esta función comprueba que $var contiene un
// email correcto en el formato aaaaa@bbbb.ccc.
function validaEmail(&$var, $defecto){

    $opciones = [
        'options'=>["default"=>$defecto]
        

    ];
    $aux = filter_var($var,FILTER_VALIDATE_EMAIL,$opciones);
    
    if($aux!=$var){
        $var = $defecto;
        return false;

    }
    
    return true;

}

// Esta función comprueba que $var
// contiene una cadena de longitud máxima $longitud
function validaCadena(&$var, $longitud, $defecto){

    $opciones = [
        'options'=>["default"=>$defecto]
        

    ];
    $aux = filter_var($var,FILTER_VALIDATE_INT,$opciones);
    
    if($aux > $longitud){
        $var = $defecto;
        return false;

    }
    
    return true;


}

// Esta función comprueba que
// $var cumple con la expresión regular $expresion
function validaExpresion(&$var, $expresion, $defecto){

}

// Esta función comprueba que $var sea igual a
// uno de los elementos del array $posibles
function validaRango(&$var, $posibles){

    
}