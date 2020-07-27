<?php
require_once __DIR__."/../src/func.php";

/**
 * https://github.com/egin10
 * Get Data from url
 * @param $kd_kec(index11.php?kode=KODE_KECAMATAN&level=3)
 * url : https://referensi.data.kemdikbud.go.id/index11.php?kode=KODE_KECAMATAN&level=3
 */

$getData = new GetData;
$url = "https://referensi.data.kemdikbud.go.id/index11.php?kode=166006&level=3";
$ch = curl_init($url);
curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true]);
$get = curl_exec($ch);
$listNpsn = $getData->listNpsn($get);
curl_close($ch);
print_r($listNpsn);
unset($getData);