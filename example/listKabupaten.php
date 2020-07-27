<?php
require_once __DIR__."/../src/func.php";

/**
 * https://github.com/egin10
 * Get Data from url
 * @param $kd_prov(index11.php?kode=KODE_PROVINSI&level=1)
 * url : https://referensi.data.kemdikbud.go.id/index11.php?kode=KODE_PROVINSI&level=1
 */

$getData = new GetData;
$url = "https://referensi.data.kemdikbud.go.id/index11.php?kode=160000&level=1";
$ch = curl_init($url);
curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true]);
$get = curl_exec($ch);
$listKabupaten = $getData->listKabupaten($get);
curl_close($ch);
print_r($listKabupaten);
unset($getData);