<?php

namespace App\Controllers;

class Kontak extends BaseController
{
    public function index()
    {
        $data = [
            'title'    => 'Kontak & Bantuan - GIS Bengkel Online',
            'subtitle' => 'Hubungi Administrator dan Tim Teknis Sistem Informasi Geografis Bengkel',
            'email'    => 'naufalfajar@gisbengkel.com',
            'telepon'  => '0813-2633-2541',
            'jam_kerja'=> 'Senin - Sabtu (08.00 - 17.00 WIB)',
            'alamat'   => 'Jl. Teknokrat No. 45, Kota Pusat Data'
        ];

        // Memanggil view yang terletak di folder app/Views/kontak/index.php
        return view('kontak/index', $data);
    }
}