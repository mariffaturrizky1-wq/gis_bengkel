<?php
// File: app/Controllers/Admin.php (atau sesuaikan dengan nama controller dashboard-mu)

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        // Hubungkan langsung ke database aktif
        $db = \Config\Database::connect();

        // Mengambil jumlah data otomatis dari masing-masing tabel database kamu
        $totalWilayah = $db->table('tbl_wilayah')->countAllResults(); // sesuaikan nama tabel wilayahmu
        $totalBengkel = $db->table('tbl_bengkel')->countAllResults(); // sesuaikan nama tabel bengkelmu
        $totalKategori = $db->table('tbl_kategori')->countAllResults(); // sesuaikan nama tabel kategorimu
        $totalUsers   = $db->table('tbl_user')->countAllResults(); // sesuaikan nama tabel usermu

        // Bungkus data ke dalam array penampung
        $data = [
            'judul'          => 'Dashboard',
            'total_wilayah'  => $totalWilayah,
            'total_bengkel'  => $totalBengkel,
            'total_kategori' => $totalKategori,
            'total_users'    => $totalUsers,
        ];

        return view('v_dashboard', $data);
    }
}