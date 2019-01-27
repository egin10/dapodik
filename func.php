<?php
/**
 * https://github.com/egin10
 * function getStringBetween
 */

class GetData
{
    private function getStringBetween($teks, $sebelum, $sesudah)
    {
        $teks = ' '.$teks;
        $ini = strpos($teks, $sebelum);
        if($ini == 0) return '';
        $ini += strlen($sebelum);
        $panjang = strpos($teks, $sesudah, $ini) - $ini;

        return substr($teks, $ini, $panjang);
    }

    public function tabOne($get)
    {
        //tab-1
        $tabOne = $this->getStringBetween($get, '<div id="tabs-1">', '</div>');
        $table = $this->getStringBetween($tabOne, '<table>', '</table>');
        $arrTabOne = explode("</tr>", $table);

        //Nama Sekolah
        $getNama = explode("</td>", $arrTabOne[0])[3];
        $nama = $this->getStringBetween($getNama,'">','</a>');

        //NPSN Sekolah
        $getNpsn = explode("</td>", $arrTabOne[1])[3];
        $npsn = explode('>', $getNpsn)[1];
        
        //Alamat Sekolah
        $getAlamat = explode("</td>", $arrTabOne[2])[3];
        $alamat = explode('>', $getAlamat)[1];

        //Kode POS Sekolah
        $getKodePos = explode("</td>", $arrTabOne[3])[3];
        $kodePos = explode('>', $getKodePos)[1];

        //Desa/Kelurahan Sekolah
        $getDesKel = explode("</td>", $arrTabOne[5])[3];
        $desKel = explode('>', $getDesKel)[1];

        //Kecamatan/Kota
        $getKecKot = explode("</td>", $arrTabOne[6])[3];
        $kecKot = explode('>', $getKecKot)[1];

        //Kabupaten/Kota
        $getKabKot = explode("</td>", $arrTabOne[7])[3];
        $kabKot = explode('>', $getKabKot)[1];

        //Provinsi
        $getProv = explode("</td>", $arrTabOne[8])[3];
        $provinsi = explode('>', $getProv)[1];

        //Status Sekolah
        $getStat = explode("</td>", $arrTabOne[9])[3];
        $statusSek = explode('>', $getStat)[1];

        //Waktu Penyelenggaraan
        $getWp = explode("</td>", $arrTabOne[11])[3];
        $waktuPen = explode('>', $getWp)[1];

        //Jenjang Pendidikan
        $getJp = explode("</td>", $arrTabOne[13])[3];
        $jenjangPen = explode('>', $getJp)[1];

        $tabOne = [
            'nama' => $nama,
            'npsn' => $npsn,
            'alamat' => $alamat,
            'kode_pos' => $kodePos,
            'desa_kelurahan' => $desKel,
            'kecamatan' => $kecKot,
            'kabupaten_kota' => $kabKot,
            'provinsi' => $provinsi,
            'status' => $statusSek,
            'waktu' => $waktuPen,
            'jenjang' => $jenjangPen
        ];

        print_r($tabOne);
    }
}