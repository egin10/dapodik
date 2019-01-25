<?php
/**
 * https://github.com/egin10
 * Get Data from url
 * url : http://referensi.data.kemdikbud.go.id/index11.php
 */

 $url = "http://referensi.data.kemdikbud.go.id/index11.php";
 $get = file_get_contents($url);

 print_r($get);