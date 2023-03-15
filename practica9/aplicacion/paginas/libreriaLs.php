<?php

namespace validacionManual;

// Esta función comprueba que $var
// contiene un entero cuyo valor está entre $min y $max
function validaEntero(&$var, $min, $max, $defecto){
        
    if(!is_int($var)){
        $var = $defecto;
        return false;
    }
    if($var < $min || $var > $max){
        $var = $defecto;
        return false;
    }
    return true;
}

// Esta función comprueba que $var
// contiene un real cuyo valor está entre $min y $max
function validaReal(&$var, $min, $max, $defecto){
       
    if(!is_float($var)){
        $var = $defecto;
        return false;
    }
    if($var < $min || $var > $max){
        $var = $defecto;
        return false;
    }
    return true;

}

// Esta función comprueba que $var contiene una
// fecha correcta en el formato dd/mm/aaaa
function validaFecha(&$var, $defecto){
    $val = explode('/', $var);
    if(count($val) != 3){
        $var = $defecto;
        return false;
    }
    if(!checkdate($val[1], $val[0], $val[2])){
        $var = $defecto;
        return false;
    }
    return true;
}

// Esta función comprueba que $var contiene una
// hora correcta en el formato hh:mm:ss.
function validaHora(&$var, $defecto){
    $val = explode(':', $var);
    if(count($val) != 3){
        $var = $defecto;
        return false;
    }
    if(!($val[0] < 24 && $val[1] < 60 && $val[2] < 60)){
        $var = $defecto;
        return false;
    }
    return true;

}

// Esta función comprueba que $var contiene un
// email correcto en el formato aaaaa@bbbb.ccc.
function validaEmail(&$var, $defecto){

    if(!preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/',$var)){
        $var = $defecto;
        return false;
    }

    return true;
}

// Esta función comprueba que $var
// contiene una cadena de longitud máxima $longitud
function validaCadena(&$var, $longitud, $defecto){
    
    if(strlen($var)>$longitud){
        $var = $defecto;
        return false;
    }
    return true;

}

// Esta función comprueba que
// $var cumple con la expresión regular $expresion
function validaExpresion(&$var, $expresion, $defecto){

    if(preg_match($expresion,$var)){
        $var = $defecto;
        return false;
    }

    return true;

}

// Esta función comprueba que $var sea igual a
// uno de los elementos del array $posibles
function validaRango(&$var, $posibles){

    foreach($posibles as $val){

        if($val == $var) return true;
        
    }
    return false;

}
