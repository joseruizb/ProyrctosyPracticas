<?php

$prov = $_POST["prov"];

$municDevul = [];

//creo una sesión CUrl
$enlaceCurl2 = curl_init();
//se indican las opciones para una petición HTTP Post
curl_setopt($enlaceCurl2, CURLOPT_URL, "http://ovc.catastro.meh.es/ovcservweb/ovcswlocalizacionrc/ovccallejero.asmx/ConsultaMunicipio");
curl_setopt($enlaceCurl2, CURLOPT_POST, 1);
curl_setopt($enlaceCurl2, CURLOPT_POSTFIELDS, "Provincia=" . $prov . "&Municipio=");
curl_setopt($enlaceCurl2, CURLOPT_HEADER, 0);
curl_setopt($enlaceCurl2, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($enlaceCurl2, CURLOPT_PROXY, "192.168.2.254:3128");
//ejecuto la petición
$xml2 = curl_exec($enlaceCurl2);
//cierro la sesión
curl_close($enlaceCurl2);

$xml2 = str_replace('xmlns=', 'ns=', $xml2);

$municipios = new SimpleXMLElement($xml2);

foreach ($municipios->municipiero->muni as $m) {

    array_push($municDevul, $m->nm);
}

echo "dee";





