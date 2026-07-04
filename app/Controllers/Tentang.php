<?php

namespace App\Controllers;

class Tentang extends BaseController
{
    public function index()
    {
        $data = [
            'title'       => 'Tentang Aplikasi - GIS Bengkel Online',
            'subtitle'    => 'Sistem Informasi Geografis Pemetaan Lokasi Bengkel Resmi & Umum',
            'deskripsi'   => 'Aplikasi GIS Bengkel merupakan platform berbasis web yang dirancang untuk mempermudah masyarakat dalam mencari, menemukan, dan melihat rute menuju lokasi bengkel terdekat. Menggunakan teknologi Sistem Informasi Geografis (GIS), sistem ini menyajikan data persebaran bengkel secara real-time dan interaktif.',
            'teks_tombol' => 'Kembali ke Login', // <-- Tambahkan ini untuk mengubah nama tombol
            'fitur'       => [
                'Pemetaan Lokasi Bengkel Interaktif',
                'Pencarian Bengkel Berdasarkan Kategori & Wilayah',
                'Informasi Detail Mekanik & Layanan Servis',
                'Sistem Manajemen Data Kendaraan Aman'
            ]
        ];

        return view('tentang/index', $data);
    }
}