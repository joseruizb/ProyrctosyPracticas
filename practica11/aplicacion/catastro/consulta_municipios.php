<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");


//creo una sesión CUrl
$enlaceCurl = curl_init();
//se indican las opciones para una petición HTTP Post
curl_setopt($enlaceCurl, CURLOPT_URL, "http://ovc.catastro.meh.es/ovcservweb/ovcswlocalizacionrc/ovccallejero.asmx/ConsultaProvincia");
curl_setopt($enlaceCurl, CURLOPT_POST, 1);
curl_setopt($enlaceCurl, CURLOPT_POSTFIELDS, "");
curl_setopt($enlaceCurl, CURLOPT_HEADER, 0);
curl_setopt($enlaceCurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($enlaceCurl, CURLOPT_PROXY, "192.168.2.254:3128");
//ejecuto la petición
$xml = curl_exec($enlaceCurl);
//cierro la sesión
curl_close($enlaceCurl);

$xml = str_replace('xmlns=', 'ns=', $xml);

$provincias = new SimpleXMLElement($xml);


foreach ($provincias->provinciero->prov as $p) {

    $codigo = intval($p->cpine);
    $texto = $p->np . "";

    $provin[$codigo] = $texto;
}

$provIni = 29;
if ($_REQUEST) {

    if (isset($_REQUEST["prov"])) {
        $provIni = intval($_REQUEST["prov"]);
    }
}
$municDevul = [];

if (isset($_POST["enviar"]) && $_POST["muni"] != "") {

    if (isset($_REQUEST["prov"])) $pr = $provin[$_REQUEST["prov"]];
    else $pr = "MALAGA";
    $muc = $_POST["muni"];

    //creo una sesión CUrl
    $enlaceCurl2 = curl_init();
    //se indican las opciones para una petición HTTP Post
    curl_setopt($enlaceCurl2, CURLOPT_URL, "http://ovc.catastro.meh.es/ovcservweb/ovcswlocalizacionrc/ovccallejero.asmx/ConsultaMunicipio");
    curl_setopt($enlaceCurl2, CURLOPT_POST, 1);
    curl_setopt($enlaceCurl2, CURLOPT_POSTFIELDS, "Provincia=" . $pr . "&Municipio=" . $muc);
    curl_setopt($enlaceCurl2, CURLOPT_HEADER, 0);
    curl_setopt($enlaceCurl2, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($enlaceCurl2, CURLOPT_PROXY, "192.168.2.254:3128");
    //ejecuto la petición
    $xml2 = curl_exec($enlaceCurl2);
    //cierro la sesión
    curl_close($enlaceCurl2);

    $xml2 = str_replace('xmlns=', 'ns=', $xml2);

    $municipios = new SimpleXMLElement($xml2);

    foreach ($municipios->municipiero->muni as $m) {

        array_push($municDevul, $m->nm);
    }
}

inicioCabecera("Practicas");
cabecera();
finCabecera();

inicioCuerpo("CONSULTA MUNICIPIOS");
cuerpo($provin, $provIni, $municDevul);
finCuerpo();



// **********************************************************

function cabecera()
{
?>
    <script src="/javascript/ConsultaMunicipios.js" defer></script>

<?php
}


function cuerpo($provin, $provIni, $municDevul)
{
?>

    <form action="" method="POST">
        <label for="">Provincia</label>
        <select name="" id="prov">
            <?php
            foreach ($provin as $pnu => $pno) {
                $cadena = "<option value='$pnu'";
                if ($pnu == $provIni) {
                    $cadena .= " selected='selected'";
                }
                $cadena .= "> $pno </option>";
                echo $cadena;
            }

            ?>

        </select>
        <br>
        <br>
        <label for="">Municipio</label>
        <input type="text" name="muni" id="muni">
        <br><br>
        <input type="submit" name="enviar" id="enviar" class="boton">

    </form>

<?php

    foreach ($municDevul as $m) {
        echo $m . "<br>";
    }
}
