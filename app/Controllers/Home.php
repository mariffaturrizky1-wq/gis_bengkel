<?php

namespace App\Controllers;

use App\Models\ModelSetting;
use App\Models\ModelWilayah;
use App\Models\ModelBengkel;   // tambahkan

class Home extends BaseController
{
    public function __construct() 
    {
        $this->ModelSetting = new ModelSetting();
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelBengkel = new ModelBengkel();   // tambahkan
    }

    public function index(): string
    {
        $bengkelRaw = $this->ModelBengkel->AllData();

        $Bengkel = [];
        foreach ($bengkelRaw as $b) {
            // pisahkan "lat, lng" jadi latitude & longitude
            $coord = array_map('trim', explode(',', $b['coordinat'] ?? ''));
            if (count($coord) < 2 || $coord[0] === '' || $coord[1] === '') {
                continue; // lewati kalau koordinat kosong/rusak
            }

            $kategori = trim($b['kategori'] ?? 'Lainnya');

            // tentukan file ikon sesuai kategori (motor.png / mobil.png, sesuai tbl_kategori)
            if (stripos($kategori, 'motor') !== false) {
                $marker = 'motor.png';
            } elseif (stripos($kategori, 'mobil') !== false) {
                $marker = 'mobil.png';
            } else {
                $marker = null; // pakai ikon default leaflet
            }

            $Bengkel[] = [
                'nama_bengkel' => $b['nama_bengkel'],
                'alamat'       => $b['alamat'],
                'latitude'     => $coord[0],
                'longitude'    => $coord[1],
                'kategori'     => $kategori,
                'marker'       => $marker,
            ];
        }

        $data = [
            'judul'   => 'Home',
            'page'    => 'v_home',
            'web'     => $this->ModelSetting->DataWeb(),
            'Wilayah' => $this->ModelWilayah->AllData(),
            'Bengkel' => $Bengkel,   // huruf B besar, harus sama persis dengan yang dipakai di v_home.php
        ];
        return view('v_template_front_end', $data);
    }
}