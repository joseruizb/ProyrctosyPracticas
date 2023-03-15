<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


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



inicioCabecera("Ejercicio 3");
cabecera();
finCabecera();

inicioCuerpo("Ejercicio 3");
cuerpo();
finCuerpo();



// **********************************************************

function cabecera()
{
}


function cuerpo()
{

echo operacion(1,8,5,2,2)."<br>";
echo operacion(2,8,2,2,2)."<br>";
echo operacion(3,8,2,2,2)."<br>";
echo operacion(5,8,2,2,2)."<br>";


?>

<?php

}
