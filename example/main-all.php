<?php
require_once __DIR__."/../src/func.php";

/**
 * https://github.com/egin10
 * Get Data List Provinsi from url
 * url : https://referensi.data.kemdikbud.go.id/index11.php
 */
$base_url = "https://referensi.data.kemdikbud.go.id/";
$getData = new GetData;
$url = $base_url."index11.php";
$ch = curl_init($url);
curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true]);
$get = curl_exec($ch);
$listProvinsi = $getData->listProvinsi($get);
curl_close($ch);

$i = 1;
foreach ($listProvinsi as $kProv => $vProv) {
	//Get Kabupaten
	$url_kab = $base_url.$vProv['link'];
	$ch_kab = curl_init($url_kab);
	curl_setopt_array($ch_kab, [CURLOPT_RETURNTRANSFER => true]);
	$get_kab = curl_exec($ch_kab);
	$listKabupaten = $getData->listKabupaten($get_kab);

	//Result Kabupaten
	echo "No. ".$i." -> ".$vProv['prov_name']."\n";
	echo "Jml Kabupaten => ".count($listKabupaten)."\n";

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
			}

			curl_close($ch_npsn);
			$k++;
		}

		curl_close($ch_kec);
		$j++;
	}

	curl_close($ch_kab);
	$i++;
}
// print_r($listProvinsi);
unset($getData);