<?php
/**
 * https://github.com/egin10
 * Get Data from url
 * @param $argv[1]
 * url : http://referensi.data.kemdikbud.go.id/tabs.php?npsn=NPSN_SEKOLAH
 */

include_once "func.php";

$getData = new GetData;

if(sizeof($argv) == 1 || $argv[1] == NULL) {
    echo "Silahkan isi NPSN sekolah : php run.php NPSN";
}else{
    $url = "http://referensi.data.kemdikbud.go.id/tabs.php?npsn=".$argv[1];
    $ch = curl_init($url);
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true]);
    $get = curl_exec($ch);
    $res = $getData->checkNPSN($get);
    curl_close($ch);
    print_r($res);
    unset($getData);
}