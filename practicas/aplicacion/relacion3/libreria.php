<?php

function cuentaVeces(&$array, $texto, $num)
{
    static $x = 1;
    echo "Llamada numero $x a la función"."<br>";
    $array[$texto] = $num;

    $x++;
}

function generarCadena($num){

    $string = "";

    if(is_integer($num) == false) $num = 10;


    $letras = array(
        1, 2, 3, 4, 5, 6, 7, 8, 9, 0,
        'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm',
        'A', 'Q', 'W', 'S', 'D', 'E', 'F', 'R', 'G', 'T', 'H', 'Y', 'J', 'U', 'K', 'I', 'L', 'O', 'P', 'Z', 'X', 'C', 'V', 'B', 'N', 'M',
        'ñ','Ñ','º','ª','!','@','#','·','$','%','&','/','(',')','=','?','\'','¡','^','[','`','+',']','*','´','{','¨','}','ç',
        '-','_','.',':',',',';'
    );

    for($i = 0;$i < $num; $i++)
    $string = $string.$letras[rand(0,94)];

    return $string;
}



function operacion($opr, $op1, $op2, ...$resto)
{

    switch ($opr) {
        case 1:
            $res = $op1 + $op2;
            foreach ($resto as $num)
                $res += $num;
            return "Haria la suma de (".$op1.",".$op2.",".implode(",",$resto).") resultado:".$res;
            break;
        case 2:
            $res= $op1 - $op2;
            foreach ($resto as $num)
            $res -= $num;
            return "Haria la suma de (".$op1.",".$op2.",".implode(",",$resto).") resultado:".$res;
            break;
        case 3:
            $res= $op1 * $op2;
            foreach ($resto as $num)
            $res *= $num;
            return "Haria la suma de (".$op1.",".$op2.",".implode(",",$resto).") resultado:".$res;
            break;
        default:
            $res= $op1 - $op2;
            foreach ($resto as $num)
            if($num%2 == 0) $res += $num;
            else $res -= $num;
            return "Haria la suma de (".$op1.",".$op2.",".implode(",",$resto).") resultado:".$res;
                break;
    }
}

function devuelbe(&$valor,$va1,$va2){

    $res = $valor * $va1 * $va2;

    $valor = $valor + $va1 +$va2;

    return $res;
}


function suma($v1,$v2){
    return $re = $v1 + $v2;
}
function resta($v1,$v2){
    return $re = $v1 + $v2;
}
function multiplicacion($v1,$v2){
    return $re = $v1 + $v2;
}
function hacerOperacion($op,$v1,$v2){
    
    switch ($op) {
        case "suma":
        return suma($v1,$v2);
        break;
        case "resta":
        return resta($v1,$v2);
        break;
        case "multiplicacion":
        return multiplicacion($v1,$v2);
        break;
        default:
        return "No existe la opcion introducida";
        break;
    }


}

function Ordenar($array){

    function Fam($a, $b){ 
    return strcasecmp(strlen($b), strlen($a));}

    usort($array, "Fam");

    foreach($array as $val){
        echo $val." ";

    }

}



?>