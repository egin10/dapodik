#!/usr/bin/php
<?php
/**
 * https://github.com/egin10
 * Get Data List Provinsi from url
 * url : https://referensi.data.kemdikbud.go.id/index11.php
 */

require_once __DIR__."/src/func.php";
date_default_timezone_set("Asia/Jakarta");

$getData = new GetData;
$url = "https://referensi.data.kemdikbud.go.id/index11.php";
$ch = curl_init($url);
curl_setopt_array($ch, [
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_SSL_VERIFYHOST => false
]);
$get = curl_exec($ch);
$listProvinsi = $getData->listProvinsi($get);
curl_close($ch);

$n = 1;
echo "*========================================*\n";
echo "||\t List Provinsi se-Indonesia\t||\n";
echo "*========================================*\n";
foreach ($listProvinsi as $prov) {
	echo "* ".$n.". ".$prov['prov_name']."\n";
	$n++;
}
unset($getData);