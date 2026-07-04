<?php

namespace App\Controllers;

class Peta extends BaseController
{
    public function index()
    {
        $data = [
            'title'    => 'Peta Persebaran - GIS Bengkel Online',
            'subtitle' => 'Sistem Pemetaan Lokasi Bengkel Resmi & Umum secara Real-Time',
            // Menambahkan data kategori secara manual (atau nanti bisa diambil dari Model/Database)
            'kategori' => [
                ['id_kategori' => 1, 'nama_kategori' => 'Motor'],
                ['id_kategori' => 2, 'nama_kategori' => 'Mobil']
            ]
        ];

        return view('peta/index', $data);
    }
}