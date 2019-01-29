<?php
include_once "func.php";

/**
 * https://github.com/egin10
 * Main Application
 * url : http://referensi.data.kemdikbud.go.id/index11.php
 */

$getData = new GetData;

if(sizeof($argv) == 1 || $argv[1] == NULL || $argv[1] == 'help' || $argv[1] == '-h') {
    echo "=============================================================================================================\n";
    echo "List Perintah \t| Deskripsi \t\t\t\t| Cara Menggunakan\n";
    echo "=============================================================================================================\n";
    echo "npsn \t\t| Check NPSN Sekolah \t\t\t| php main.php npsn npsn_sekolah\n";
    echo "getkec \t\t| Check Data Sekolah di kecamatan \t| php main.php getkec nama_kecamatan\n";
    echo "getkab \t\t| Check Data Sekolah di kabupaten \t| php main.php getkab nama_kabupaten\n";
    echo "getprov \t| Check Data Sekolah di provinsi \t| php main.php getprov nama_provinsi\n";
    echo "cekexcel \t| Check List NPSN Sekolah dari excel \t| php main.php cekexcel\n";
    echo "=============================================================================================================\n";
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