<?php
include_once "func.php";

/**
 * https://github.com/egin10
 * Get Data List Provinsi from url
 * url : http://referensi.data.kemdikbud.go.id/index11.php
 */
$base_url = "http://referensi.data.kemdikbud.go.id/";
$getData = new GetData;

//Get Kabupaten
$url_kab = $base_url."index11.php?kode=160000&level=1";
$ch_kab = curl_init($url_kab);
curl_setopt_array($ch_kab, [CURLOPT_RETURNTRANSFER => true]);
$get_kab = curl_exec($ch_kab);
$listKabupaten = $getData->listKabupaten($get_kab);

//Result Kabupaten
echo "==========================================================================================\n";
echo "||\t\t\tDaftar Sekolah Provinsi Kalimantan Timur\t\t\t||\n";
echo "==========================================================================================\n";
$t = 0;
$j = 1;
foreach ($listKabupaten as $kKab => $vKab) {
	//Get Kecamatan
	$url_kec = $base_url.$vKab['link'];
	$ch_kec = curl_init($url_kec);
	curl_setopt_array($ch_kec, [CURLOPT_RETURNTRANSFER => true]);
	$get_kec = curl_exec($ch_kec);
	$listKecamatan = $getData->listKecamatan($get_kec);

	//Result Kecamatan
	echo "\tNo. ".$j." -> ".$vKab['kab_name']."\n";
	echo "\t\tJml Kecamatan => ".count($listKecamatan)."\n";

	$k = 1;
	foreach ($listKecamatan as $kKec => $vKec) {
		//Get List NPSN
		$url_npsn = $base_url.$vKec['link'];
		$ch_npsn = curl_init($url_npsn);
		curl_setopt_array($ch_npsn, [CURLOPT_RETURNTRANSFER => true]);
		$get_npsn = curl_exec($ch_npsn);
		$listNpsn = $getData->listNpsn($get_npsn);

		//Result List NPSN
		echo "\t\tNo. ".$k." -> ".$vKec['kec_name']."\n";
		echo "\t\t\tJml Sekolah => ".count($listNpsn)."\n";
		
		$l = 0;
		foreach ($listNpsn as $kNpsn => $vNpsn) {
			$url_sekolah = $base_url."tabs.php?npsn=".$vNpsn['npsn'];
		    $ch_sekolah = curl_init($url_sekolah);
		    curl_setopt_array($ch_sekolah, [CURLOPT_RETURNTRANSFER => true]);
		    $get_sekolah = curl_exec($ch_sekolah);
		    $res = $getData->checkNPSN($get_sekolah);

			//Result NPSN Sekolah
			echo "\t\t\tNo. ".$l." -> NPSN ".$vNpsn['npsn']."\t".$vNpsn['nama_sekolah']."\n";

			curl_close($ch_sekolah);
			$l++;
			$t++;
		}

		curl_close($ch_npsn);
		$k++;
	}

	curl_close($ch_kec);
	$j++;
}

echo "Total Sekolah di Provinsi Kalimantan Timur : ".$t."\n";
// print_r($listProvinsi);
unset($getData);