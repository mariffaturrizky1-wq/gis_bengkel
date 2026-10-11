<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Bengkel extends ResourceController
{
    protected $format = 'json';

    // GET /api/bengkel - List semua bengkel
    public function index()
    {
        $db = \Config\Database::connect();
        $bengkel = $db->query("
            SELECT b.*, 
                p.nama_provinsi,
                k.nama_kabupaten,
                kc.nama_kecamatan,
                w.nama_wilayah
            FROM gis_bengkel.tbl_bengkel b
            LEFT JOIN gis_bengkel.tbl_provinsi p ON b.id_provinsi::integer = p.id_provinsi::integer
            LEFT JOIN gis_bengkel.tbl_kabupaten k ON b.id_kabupaten::integer = k.id_kabupaten::integer
            LEFT JOIN gis_bengkel.tbl_kecamatan kc ON b.id_kecamatan::integer = kc.id_kecamatan::integer
            LEFT JOIN gis_bengkel.tbl_wilayah w ON b.id_wilayah::integer = w.id_wilayah::integer
        ")->getResultArray();

        return $this->respond([
            'status' => 200,
            'message' => 'Success',
            'data' => $bengkel
        ]);
    }

    // GET /api/bengkel/(:num) - Detail bengkel
   public function show($id = null)
{
    $db = \Config\Database::connect();
    $bengkel = $db->query("
        SELECT b.*, 
               p.nama_provinsi,
               k.nama_kabupaten,
               kc.nama_kecamatan,
               w.nama_wilayah,
               w.geojson
        FROM gis_bengkel.tbl_bengkel b
        LEFT JOIN gis_bengkel.tbl_provinsi p ON b.id_provinsi::integer = p.id_provinsi::integer
        LEFT JOIN gis_bengkel.tbl_kabupaten k ON b.id_kabupaten::integer = k.id_kabupaten::integer
        LEFT JOIN gis_bengkel.tbl_kecamatan kc ON b.id_kecamatan::integer = kc.id_kecamatan::integer
        LEFT JOIN gis_bengkel.tbl_wilayah w ON b.id_wilayah::integer = w.id_wilayah::integer
        WHERE b.id_bengkel = $id
    ")->getRowArray();

    if (!$bengkel) {
        return $this->failNotFound('Bengkel tidak ditemukan');
    }

    return $this->respond([
        'status' => 200,
        'message' => 'Success',
        'data' => $bengkel
    ]);
}

    // GET /api/bengkel/peta - Data untuk marker peta
    public function peta()
    {
        $db = \Config\Database::connect();
        $bengkel = $db->query("
            SELECT id_bengkel, nama_bengkel, alamat, 
                   kategori, foto, coordinat,
                   jam_buka, jam_tutup
            FROM gis_bengkel.tbl_bengkel
            WHERE coordinat IS NOT NULL AND coordinat != ''
        ")->getResultArray();

        // Format koordinat jadi lat/lng
        $result = array_map(function($item) {
            $coords = explode(',', $item['coordinat']);
            $item['lat'] = isset($coords[0]) ? trim($coords[0]) : null;
            $item['lng'] = isset($coords[1]) ? trim($coords[1]) : null;
            return $item;
        }, $bengkel);

        return $this->respond([
            'status' => 200,
            'message' => 'Success',
            'data' => $result
        ]);
    }
}