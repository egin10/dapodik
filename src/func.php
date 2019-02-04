<?php

/**
 * https://github.com/egin10
 * Class GetData
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

    public function checkNPSN($get)
    {
        //tab-1
        $tabOne = $this->getStringBetween($get, '<div id="tabs-1">', '</div>');
        $tableOne = $this->getStringBetween($tabOne, '<table>', '</table>');
        $arrTabOne = explode("</tr>", $tableOne);

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

        //tab-2
        $tabTwo = $this->getStringBetween($get, '<div id="tabs-2">', '</div>');
        $tableTwo = $this->getStringBetween($tabTwo, '<table>', '</table>');
        $arrTabTwo = explode("</tr>", $tableTwo);

        //Naungan
        $getNaungan = explode("</td>",$arrTabTwo[0])[3];
        $naungan = explode(">",$getNaungan)[1];

        //No_SK_Pendirian
        $getNoSKPendirian = explode("</td>",$arrTabTwo[1])[3];
        $noSKPendirian = strpos($getNoSKPendirian, "Perlu Update") ? "Perlu Update" : explode(">",$getNoSKPendirian)[1];

        //Tgl_SK_Pendirian
        $getTglSKPendirian = explode("</td>",$arrTabTwo[2])[3];
        $TglSKPendirian = explode(">",$getTglSKPendirian)[1];

        // No_SK_Operasional
        $getNoSKOperasional = explode("</td>",$arrTabTwo[4])[3];
        $noSKOperasional = strpos($getNoSKOperasional, "Perlu Update") ? "Perlu Update" : explode(">",$getNoSKOperasional)[1];

        // Tgl_SK_Operasional
        $getTglSKOperasional = explode("</td>",$arrTabTwo[5])[3];
        $tglSKOperasional = explode(">",$getTglSKOperasional)[1];

        // Akreditasi
        $getAkreditasi = explode("</td>",$arrTabTwo[8])[3];
        $akreditasi = $this->getStringBetween($getAkreditasi,'<strong>','</strong>');

        // No_SK_Akreditasi
        $getNoSKAkreditasi = explode("</td>",$arrTabTwo[10])[3];
        $noSKAkreditasi = explode(">",$getNoSKAkreditasi)[1];

        // Tgl_SK_Akreditasi
        $getTglSKAkreditasi = explode("</td>",$arrTabTwo[11])[3];
        $tglSKAkreditasi = explode(">",$getTglSKAkreditasi)[1];

        // No_Sertifikat_ISO
        $getNoSerISO = explode("</td>",$arrTabTwo[13])[3];
        $noSerISO = explode(">",$getNoSerISO)[1];

        //Result
        $res = [
            'npsn' => trim($npsn), //tab-1 start
            'nama' => trim($nama),
            'alamat' => trim($alamat),
            'kode_pos' => trim($kodePos),
            'desa_kelurahan' => trim($desKel),
            'kecamatan' => trim($kecKot),
            'kabupaten_kota' => trim($kabKot),
            'provinsi' => trim($provinsi),
            'status' => trim($statusSek),
            'waktu' => trim($waktuPen),
            'jenjang' => trim($jenjangPen),
            'naungan' => trim($naungan), //tab-2 start
            'no_sk_pendirian' => trim($noSKPendirian),
            'tgl_sk_pendirian' => trim($TglSKPendirian),
            'no_sk_operasional' => trim($noSKOperasional),
            'tgl_sk_operasional' => trim($tglSKOperasional),
            'akreditasi' => trim($akreditasi),
            'no_sk_akreditasi' => trim($noSKAkreditasi),
            'tgl_sk_akreditasi' => trim($tglSKAkreditasi),
            'no_sertifikat_iso' => trim($noSerISO)
        ];

        if($res['nama'] == ''){
            // echo "Data Sekolah tidak ditemukan.\n";
            $res = '';
        }else{
            // print_r($res);
            return $res;
        }
    }

    public function listProvinsi($get)
    {
        $listProv = trim($this->getStringBetween($get, '<tr bgcolor="#eeeeee">', '</tbody>'));
        $arrProv = explode("</tr>",$listProv);
        $dataProv = [];
        
        for($i=1; $i<count($arrProv)-1;$i++)
        {
            $pilah = $this->getStringBetween(explode('</td>',$arrProv[$i])[0], '<a href=', '</a>');
            $link = explode('>', $pilah)[0];
            $provName = explode('>', $pilah)[1];
            $dataProv[] = [
                'link' => trim($link),
                'prov_name' => trim($provName)
            ];
        }
        // print_r($dataProv);
        return $dataProv;
    }

    public function listKabupaten($get)
    {
        $listKab = trim($this->getStringBetween($get, '<tr bgcolor="#eeeeee">', '</tbody>'));
        $arrKab = explode("</tr>",$listKab);
        $dataKab = [];
        
        for($i=1; $i<count($arrKab)-1;$i++)
        {
            $pilah = $this->getStringBetween(explode('</td>',$arrKab[$i])[0], '<a href=', '</a>');
            $link = explode('>', $pilah)[0];
            $kabName = explode('>', $pilah)[1];
            $dataKab[] = [
                'link' => trim($link),
                'kab_name' => trim($kabName)
            ];
        }
        // print_r($dataKab);
        return $dataKab;
    }

    public function listKecamatan($get)
    {
        $listKec = trim($this->getStringBetween($get, '<tr bgcolor="#eeeeee">', '</tbody>'));
        $arrKec = explode("</tr>",$listKec);
        $dataKec = [];
        
        for($i=1; $i<count($arrKec)-1;$i++)
        {
            $pilah = $this->getStringBetween(explode('</td>',$arrKec[$i])[0], '<a href=', '</a>');
            $link = explode('>', $pilah)[0];
            $kecName = explode('>', $pilah)[1];
            $dataKec[] = [
                'link' => trim($link),
                'kec_name' => trim($kecName)
            ];
        }
        // print_r($dataKec);
        return $dataKec;
    }

    public function listNpsn($get)
    {
        $listNpsn = trim($this->getStringBetween($get, '</thead>', '</table>'));
        $arrNpsn = explode("</tr><tr>",$listNpsn);
        $dataNpsn = [];

        for($i=0; $i<count($arrNpsn); $i++)
        {
            $npsn = $this->getStringBetween($arrNpsn[$i],"&nbsp;<b>","</b></a>")."\n";
            $nama_sekolah = $this->getStringBetween($arrNpsn[$i],"</a></td><td>","</td><td>")."\n";

            $dataNpsn[] = [
                'npsn' => trim($npsn),
                'nama_sekolah' => trim($nama_sekolah)
            ];
        }
        // print_r($dataNpsn);
        return $dataNpsn;
    }
}