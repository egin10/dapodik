<?php
/**
 * https://github.com/egin10
 * Get Data from url
 * url : http://referensi.data.kemdikbud.go.id/index11.php
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
    $tabOne = $getData->checkNPSN($get);
    curl_close($ch);
    print_r($tabOne);
    unset($getData);
}