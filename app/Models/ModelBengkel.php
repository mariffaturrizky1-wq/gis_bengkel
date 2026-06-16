<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBengkel extends Model
{
    public function AllData()
{
    return $this->db->table('tbl_bengkel')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_bengkel.id_kategori', 'left')
            ->get()
            ->getResultArray();
}

    public function InsertData($data)
    {
        $this->db->table('tbl_bengkel')->insert($data);
    }

    public function DetailData($id_bengkel)
    {
        return $this->db->table('tbl_bengkel')
             ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_bengkel.id_kategori', 'left')
             ->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = tbl_bengkel.id_kabupaten', 'left')
             ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_bengkel.id_kecamatan', 'left')
                ->where('id_bengkel', $id_bengkel)
                ->get()->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_bengkel')
        ->where('id_bengkel', $data['id_bengkel'])
        ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_bengkel')
        ->where('id_bengkel', $data['id_bengkel'])
        ->delete($data);
    }


    //provinsi
    public function allProvinsi()
    {
        return $this->db->table('tbl_provinsi')
                ->orderBy('id_provinsi', 'ASC')
                ->get()->getResultArray();
    }

    public function allKabupaten($id_provinsi)
    {
        return $this->db->table('tbl_kabupaten')
                ->where('id_provinsi', $id_provinsi)
                ->get()->getResultArray();
    }

    public function allKecamatan($id_kabupaten)
    {
        return $this->db->table('tbl_kecamatan')
            ->where('id_kabupaten', $id_kabupaten)
            ->get()->getResultArray();
    }

    public function allJenjang()
{
    return $this->db->table('tbl_jenjang')
            ->orderBy('id_jenjang', 'ASC')
            ->get()->getResultArray();
}

}