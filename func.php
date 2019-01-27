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

        print_r($desKel);
    }
}