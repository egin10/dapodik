#!/usr/bin/php
<?php
/**
 * https://github.com/egin10
 * Get Data from url
 * @param $file
 * @return array
 * url : http://referensi.data.kemdikbud.go.id/tabs.php?npsn=NPSN_SEKOLAH
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
date_default_timezone_set("Asia/Jakarta");

require_once __DIR__.'/src/SimpleXLSX.php';
require_once __DIR__.'/src/func.php';

$n = 1;
if ( $xlsx = SimpleXLSX::parse(__DIR__.'/check-npsn.xlsx') ) {
	// print_r( $xlsx->rows() );
	$t = count($xlsx->rows());
	if($t < 3) {
		echo "Silahkan isi list NPSN di file check-npsn.xlsx\n";
	} else {
		echo "Daftar Sekolah yang di check\n";
		for($i=2; $i<$t; $i++) {
			
			$getData = new GetData;
			$url = "http://referensi.data.kemdikbud.go.id/tabs.php?npsn=".trim($xlsx->rows()[$i][0]);
			$ch = curl_init($url);
			curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true]);
			$get = curl_exec($ch);
			$res = $getData->checkNPSN($get);
			curl_close($ch);
			// print_r($res);
			echo "======================================\n";
			echo "No. ".$n."\n";
			echo "NPSN Excel : ".$xlsx->rows()[$i][0]."\n";
			if($res == '') {
				echo "Data tidak ditemukan.\n";
			}else{
				echo "NPSN Dapodik : ".$res['npsn']."\n";
				echo "Nama Sekolah : ".$res['nama']."\n";
				echo "Alamat : ".$res['alamat']."\n";
				echo "Kecamatan : ".$res['kecamatan']."\n";
				echo "Kab/Kota : ".$res['kabupaten_kota']."\n";
				echo "Provinsi : ".$res['provinsi']."\n";
				echo "Status : ".$res['status']."\n";
				echo "Jenjang : ".$res['jenjang']."\n";
				echo "Akreditasi : ".$res['akreditasi']."\n";
				echo "Tgl SK Akreditasi : ".$res['tgl_sk_akreditasi']."\n";
			}
			$n++;
			unset($getData);
		}
	}
} else {
	echo SimpleXLSX::parseError();
}