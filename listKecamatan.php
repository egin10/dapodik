<?php
include_once "func.php";

/**
 * https://github.com/egin10
 * Get Data from url
 * @param $kd_kab(index11.php?kode=KODE_KABUPATEN&level=2)
 * url : http://referensi.data.kemdikbud.go.id/index11.php?kode=KODE_KABUPATEN&level=2
 */

$getData = new GetData;
$url = "http://referensi.data.kemdikbud.go.id/index11.php?kode=166000&level=2";
$ch = curl_init($url);
curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true]);
$get = curl_exec($ch);
$listKecamatan = $getData->listKecamatan($get);
curl_close($ch);
print_r($listKecamatan);
unset($getData);