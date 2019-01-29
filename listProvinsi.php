<?php
include_once "func.php";

/**
 * https://github.com/egin10
 * Get Data List Provinsi from url
 * url : http://referensi.data.kemdikbud.go.id/index11.php
 */

$getData = new GetData;
$url = "http://referensi.data.kemdikbud.go.id/index11.php";
$ch = curl_init($url);
curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true]);
$get = curl_exec($ch);
$listProvinsi = $getData->listProvinsi($get);
curl_close($ch);
print_r($listProvinsi);
unset($getData);