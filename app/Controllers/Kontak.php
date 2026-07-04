<?php

namespace App\Controllers;

class Kontak extends BaseController
{
    public function index()
    {
        $data = [
            'title'    => 'Kontak & Bantuan - GIS Bengkel Online',
            'subtitle' => 'Hubungi Administrator dan Tim Teknis Sistem Informasi Geografis Bengkel',
            'email'    => 'support@gisbengkel.com',
            'telepon'  => '0812-3456-7890',
            'jam_kerja'=> 'Senin - Sabtu (08.00 - 17.00 WIB)',
            'alamat'   => 'Jl. Teknokrat No. 45, Kota Pusat Data'
        ];

        // Memanggil view yang terletak di folder app/Views/kontak/index.php
        return view('kontak/index', $data);
    }
}