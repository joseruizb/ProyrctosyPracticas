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


if (isset($_REQUEST["prov"])) $pr = $provin[$_REQUEST["prov"]];
else $pr = "MALAGA";

//creo una sesión CUrl
$enlaceCurl2 = curl_init();
//se indican las opciones para una petición HTTP Post
curl_setopt($enlaceCurl2, CURLOPT_URL, "http://ovc.catastro.meh.es/ovcservweb/ovcswlocalizacionrc/ovccallejero.asmx/ConsultaMunicipio");
curl_setopt($enlaceCurl2, CURLOPT_POST, 1);
curl_setopt($enlaceCurl2, CURLOPT_POSTFIELDS, "Provincia=" . $pr . "&Municipio=");
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

$parceDevul = [];
if (isset($_POST["enviar"])) {

    //creo una sesión CUrl
    $enlaceCurl3 = curl_init();
    //se indican las opciones para una petición HTTP Post
    curl_setopt($enlaceCurl3, CURLOPT_URL, "http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejero.asmx/Consulta_DNPPP");
    curl_setopt($enlaceCurl3, CURLOPT_POST, 1);
    curl_setopt($enlaceCurl3, CURLOPT_POSTFIELDS, "Provincia=" . $provin[$_POST["provElec"]] . "&Municipio=" . $_POST["muniElec"] . "&Poligono=" . $_POST["pol"] . "&Parcela=" . $_POST["par"]);
    curl_setopt($enlaceCurl3, CURLOPT_HEADER, 0);
    curl_setopt($enlaceCurl3, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($enlaceCurl3, CURLOPT_PROXY, "192.168.2.254:3128");
    //ejecuto la petición
    $xml3 = curl_exec($enlaceCurl3);
    //cierro la sesión
    curl_close($enlaceCurl3);

    $xml3 = str_replace('xmlns=', 'ns=', $xml3);

    $parcelas = new SimpleXMLElement($xml3);

    if (!$parcelas->bico->bi) array_push($parceDevul, $parcelas->lerr->err->des);
    else
        foreach ($parcelas->bico->bi->idbi->rc as $p) {

            array_push($parceDevul, $p->pc1 . $p->pc2 . $p->car . $p->cc1 . $p->cc2);
        }
}


inicioCabecera("Practicas");
cabecera();
finCabecera();

inicioCuerpo("CONSULTA DATOS");
cuerpo($provin, $provIni, $municDevul, $parceDevul);
finCuerpo();



// **********************************************************

function cabecera()
{
?>
    <script src="/javascript/ConsultaRustica.js" defer></script>

<?php
}


function cuerpo($provin, $provIni, $municDevul, $parceDevul)
{
?>

    <form action="" method="POST">
        <label for="">Provincia</label>
        <select name="provElec" id="prov">
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
        <label for="">Municipio</label>
        <select name="muniElec" id="munic">
            <?php
            foreach ($municDevul as $m) {
                $cadena = "<option value='$m' name='$m'";
                if ($_REQUEST["munic"] == $m) {
                    $cadena .= " selected='selected'";
                }
                $cadena .= "> $m </option>";
                echo $cadena;
            }

            ?>

        </select>
        <br>
        <label for="">Poligono</label>
        <input type="text" name="pol">
        <br>
        <label for="">Parcela</label>
        <input type="text" name="par">
        <br>
        <input type="submit" name="enviar" id="enviar" class="boton">

    </form>
    <br><br>
<?php

    foreach ($parceDevul as $p) {
        echo $p . "<br>";
    }
}
