<?php
include_once "func.php";
include_once "xlsxwriter.class.php";

/**
 * https://github.com/egin10
 * Get Data List Provinsi from url
 * url : http://referensi.data.kemdikbud.go.id/index11.php
 */
$base_url = "http://referensi.data.kemdikbud.go.id/";
$getData = new GetData;

$linkProv = '';
$nameProv = '';

$getData = new GetData;
$url_prov = $base_url."index11.php";
$ch_prov = curl_init($url_prov);
curl_setopt_array($ch_prov, [CURLOPT_RETURNTRANSFER => true]);
$get_prov = curl_exec($ch_prov);
$listProvinsi = $getData->listProvinsi($get_prov);
curl_close($ch_prov);

foreach ($listProvinsi as $kProv => $vProv) {
	if($kProv == $argv[1]-1) {
		$linkProv = $vProv['link'];
		$nameProv = $vProv['prov_name'];
	}
}

// //Get Kabupaten
$url_kab = $base_url.$linkProv;
$ch_kab = curl_init($url_kab);
curl_setopt_array($ch_kab, [CURLOPT_RETURNTRANSFER => true]);
$get_kab = curl_exec($ch_kab);
$listKabupaten = $getData->listKabupaten($get_kab);

//Result Kabupaten
echo "==========================================================================================\n";
echo "||\t\t\tDaftar Sekolah Provinsi Kalimantan Timur\t\t\t||\n";
echo "||\t\t\t\tData dari Website Data Refrensi\t\t\t\t||\n";
echo "||\t\t\t\t\tKemenDikBud\t\t\t\t\t||\n";
echo "==========================================================================================\n";

$arrSekolah = [];
$arrSekolah[] = [
	'npsn' => "NPSN", //tab-1 start
    'nama' => "Nama Sekolah",
    'alamat' => "Alamat",
    'kode_pos' => "Kode Pos",
    'desa_kelurahan' => "Desa/Kelurahan",
    'kecamatan' => "Kecamatan",
    'kabupaten_kota' => "Kabupaten/Kota",
    'provinsi' => "Provinsi",
    'status' => "Status",
    'waktu' => "Waktu Penyelenggaraan",
    'jenjang' => "Jenjang",
    'naungan' => "Naungan", //tab-2 start
    'no_sk_pendirian' => "No SK Pendirian",
    'tgl_sk_pendirian' => "Tanggal SK Pendirian",
    'no_sk_operasional' => "No SK Operasional",
    'tgl_sk_operasional' => "Tanggal SK Operasional",
    'akreditasi' => "Akreditasi",
    'no_sk_akreditasi' => "No SK Akreditasi",
    'tgl_sk_akreditasi' => "Tanggal SK Akreditasi",
    'no_sertifikat_iso' => "No Sertifikat ISO"
];

$j = 1;
foreach ($listKabupaten as $kKab => $vKab) {
	//Get Kecamatan
	$url_kec = $base_url.$vKab['link'];
	$ch_kec = curl_init($url_kec);
	curl_setopt_array($ch_kec, [CURLOPT_RETURNTRANSFER => true]);
	$get_kec = curl_exec($ch_kec);
	$listKecamatan = $getData->listKecamatan($get_kec);
	curl_close($ch_kec);

	//Result Kecamatan
	echo "No. ".$j." -> ".$vKab['kab_name']."\n";
	echo "\tJml Kecamatan => ".count($listKecamatan)."\n";

	$k = 1;
	foreach ($listKecamatan as $kKec => $vKec) {
		//Get List NPSN
		$url_npsn = $base_url.$vKec['link'];
		$ch_npsn = curl_init($url_npsn);
		curl_setopt_array($ch_npsn, [CURLOPT_RETURNTRANSFER => true]);
		$get_npsn = curl_exec($ch_npsn);
		$listNpsn = $getData->listNpsn($get_npsn);
		curl_close($ch_npsn);

		//Result List NPSN
		echo "\tNo. ".$k." -> ".$vKec['kec_name']."\n";
		echo "\t\tJml Sekolah => ".count($listNpsn)."\n";
		
		$l = 1;
		foreach ($listNpsn as $kNpsn => $vNpsn) {
			$url_sekolah = $base_url."tabs.php?npsn=".trim($vNpsn['npsn']);
		    $ch_sekolah = curl_init($url_sekolah);
		    curl_setopt_array($ch_sekolah, [CURLOPT_RETURNTRANSFER => true]);
		    $get_sekolah = curl_exec($ch_sekolah);
		    $res = $getData->checkNPSN($get_sekolah);
			curl_close($ch_sekolah);

			//Result NPSN Sekolah
			echo "\t\tNo. ".$l." -> NPSN ".$vNpsn['npsn']."\t".$vNpsn['nama_sekolah']."\n";

			$l++;
			$arrSekolah[] = $res;
		}

		$k++;
	}

	$j++;
}

echo "Total Sekolah di Provinsi Kalimantan Timur : ".count($arrSekolah)."\n";

//Write xlsx
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
$filename = implode("_", explode(" ", $nameProv));
$rows = $arrSekolah;
$writer = new XLSXWriter();
$writer->setAuthor('egin10'); 
foreach($rows as $row)
	$writer->writeSheetRow('Sheet1', $row);
$writer->writeToFile($filename);

$mv = rename($filename, "FILES/".$filename."_".date('d-m-Y').".xlsx");
if($mv) {
	echo "File created!\n";
	echo "DONE!\n";
}
// print_r($listProvinsi);
unset($getData);