<?php
/**
 * https://github.com/egin10
 * Get Data from url
 * url : http://referensi.data.kemdikbud.go.id/index11.php
 */

include "func.php";
//69964524

$getData = new GetData;
//check argv[1]
if(sizeof($argv) == 1 || $argv[1] == NULL) {
    echo "Silahkan isi NPSN sekolah : php run.php NPSN";
}else{
    $url = "http://referensi.data.kemdikbud.go.id/tabs.php?npsn=".$argv[1];
    $get = file_get_contents($url);
    $tabOne = $getData->tabOne($get);

    unset($getData);
}