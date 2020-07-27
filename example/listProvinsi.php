<?php
require_once __DIR__."/../src/func.php";

/**
 * https://github.com/egin10
 * Get Data List Provinsi from url
 * url : https://referensi.data.kemdikbud.go.id/index11.php
 */

$getData = new GetData;
$url = "https://referensi.data.kemdikbud.go.id/index11.php";
$ch = curl_init($url);
curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true]);
$get = curl_exec($ch);
$listProvinsi = $getData->listProvinsi($get);
curl_close($ch);
// print_r($listProvinsi);
$n = 1;
echo "*========================================*\n";
echo "||\t List Provinsi se-Indonesia\t||\n";
echo "*========================================*\n";
foreach ($listProvinsi as $prov) {
	echo "* ".$n.". ".$prov['prov_name']."\n";
	$n++;
}
unset($getData);