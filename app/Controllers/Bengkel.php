<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use App\Models\ModelBengkel;
use App\Models\ModelKategori;

class Bengkel extends BaseController
{
    public function __construct() 
    {
    $this->ModelWilayah = new ModelWilayah();
    $this->ModelSetting = new ModelSetting();
    $this->ModelBengkel = new ModelBengkel();
    $this->ModelKategori = new ModelKategori();
    }

    public function index()
    {
        $data = [
            'judul' => 'Bengkel',
            'menu' => 'bengkel',
            'page' => 'bengkel/v_index',
            'bengkel' => $this->ModelBengkel->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Input Bengkel',
            'menu' => 'bengkel',
            'page' => 'Bengkel/v_input',
            'web' => $this->ModelSetting->DataWeb(),
            'provinsi' => $this->ModelBengkel->allProvinsi(),
            'Wilayah' => $this->ModelWilayah->AllData(),
            'kategori' => $this->ModelKategori->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    
    public function InsertData()
{
    $rules = [
        'nama_bengkel' => 'required',
        'jam_buka'     => 'required',
        'jam_tutup'    => 'required',
        'id_kategori'  => 'required',
        'coordinat'    => 'required',
        'id_provinsi'  => 'required',
        'id_kabupaten' => 'required',
        'id_kecamatan' => 'required',
        'alamat'       => 'required',
        'id_wilayah'   => 'required',
        'foto'         => 'uploaded[foto]|max_size[foto,2000]|mime_in[foto,image/jpg,image/jpeg,image/png]',
    ];

    if ($this->validate($rules)) {

        $foto = $this->request->getFile('foto');
        $nama_file_foto = $foto->getRandomName();

        $data = [
            'nama_bengkel' => $this->request->getPost('nama_bengkel'),
            'jam_buka'     => $this->request->getPost('jam_buka'),
            'jam_tutup'    => $this->request->getPost('jam_tutup'),
            'id_kategori'  => $this->request->getPost('id_kategori'),
            'coordinat'    => $this->request->getPost('coordinat'),
            'id_provinsi'  => $this->request->getPost('id_provinsi'),
            'id_kabupaten' => $this->request->getPost('id_kabupaten'),
            'id_kecamatan' => $this->request->getPost('id_kecamatan'),
            'alamat'       => $this->request->getPost('alamat'),
            'id_wilayah'   => $this->request->getPost('id_wilayah'),
            'foto'         => $nama_file_foto,
        ];

        $foto->move('foto', $nama_file_foto);

        $this->ModelBengkel->InsertData($data);

        session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!');

        return redirect()->to(base_url('Bengkel'));

    } else {
    dd($this->validator->getErrors());
}

}

    public function Edit($id_bengkel)
    {
        $data = [
            'judul' => 'Edit Bengkel',
            'menu' => 'bengkel',
            'page' => 'Bengkel/v_edit',
            'web' => $this->ModelSetting->DataWeb(),
            'provinsi' => $this->ModelBengkel->allProvinsi(),
            'Wilayah' => $this->ModelWilayah->AllData(),
            'kategori' => $this->ModelKategori->AllData(),
            'bengkel' => $this->ModelBengkel->DetailData($id_bengkel),
        ];
        return view('v_template_back_end', $data);
    }

public function UpdateData($id_bengkel)
{
    $rules = [
        'nama_bengkel' => 'required',
        'jam_buka'     => 'required',
        'jam_tutup'    => 'required',
        'id_kategori'  => 'required',
        'coordinat'    => 'required',
        'id_provinsi'  => 'required',
        'id_kabupaten' => 'required',
        'id_kecamatan' => 'required',
        'alamat'       => 'required',
        'id_wilayah'   => 'required',
        'foto'         => 'permit_empty|max_size[foto,2000]|mime_in[foto,image/jpg,image/jpeg,image/png]',
    ];

    if ($this->validate($rules)) {
        $bengkel = $this->ModelBengkel->DetailData($id_bengkel);
        $foto = $this->request->getFile('foto');
    
        if ($foto->isValid() && ! $foto->hasMoved()) {
            $nama_file_foto = $foto->getRandomName();
            $foto->move('foto', $nama_file_foto);
        } else {
            $nama_file_foto = $bengkel['foto'];
        }

        $data = [
            'id_bengkel'   => $id_bengkel,
            'nama_bengkel' => $this->request->getPost('nama_bengkel'),
            'jam_buka'     => $this->request->getPost('jam_buka'),
            'jam_tutup'    => $this->request->getPost('jam_tutup'),
            'id_kategori'  => $this->request->getPost('id_kategori'),
            'coordinat'    => $this->request->getPost('coordinat'),
            'id_provinsi'  => $this->request->getPost('id_provinsi'),
            'id_kabupaten' => $this->request->getPost('id_kabupaten'),
            'id_kecamatan' => $this->request->getPost('id_kecamatan'),
            'alamat'       => $this->request->getPost('alamat'),
            'id_wilayah'   => $this->request->getPost('id_wilayah'),
            'foto'         => $nama_file_foto,
        ];

        $this->ModelBengkel->UpdateData($data);

        session()->setFlashdata('insert', 'Data Berhasil Diupdate !!');

        return redirect()->to(base_url('Bengkel'));

    } else {
        // Jika ada input teks lain yang lupa belum diisi, errornya akan tercetak jelas di sini sekarang
        dd($this->validator->getErrors());
    }
}


    public function Delete($id_bengkel)
    {
        //delete foto
        $bengkel = $this->ModelBengkel->DetailData($id_bengkel);
        if ($bengkel ['foto'] <> ''){
            unlink('foto/' . $bengkel ['foto']);
        }
        $data = [
            'id_bengkel'   => $id_bengkel,
        ];
        $this->ModelBengkel->DeleteData($data);

        session()->setFlashdata('insert', 'Data Berhasil Didelete !!');

        return redirect()->to(base_url('Bengkel'));
    }

    public function kabupaten()
    {
        $id_provinsi = trim($this->request->getGet('id_provinsi')); 
        
        $kab = $this->ModelBengkel->allKabupaten($id_provinsi);
        
        echo '<option value="">---Pilih Kabupaten---</option>';
        if ($kab) {
            foreach ($kab as $key => $value) {
                echo '<option value="' . $value['id_kabupaten'] . '">' . $value['nama_kabupaten'] . '</option>';
            }
        } else {
            echo '<option value="">Data Kabupaten Tidak Ditemukan</option>';
        }
    }

    //kabupaten, kecamatan
    public function kecamatan()
    {
        // 1. Gunakan getGet karena di AJAX pakai type: "GET"
        $id_kabupaten = $this->request->getGet('id_kabupaten'); 
        
        $kec = $this->ModelBengkel->allKecamatan($id_kabupaten);
        
        echo '<option value="">--Pilih Kecamatan---</option>';
        
        // 2. Pastikan yang di-foreach adalah variabel $kec, bukan $kab
        if ($kec) {
            foreach ($kec as $key => $value) {
                echo '<option value="' . $value['id_kecamatan'] . '">' . $value['nama_kecamatan'] . '</option>';
            }
        }
    }

    public function jenjang()
{
    $jenjang = $this->ModelBengkel->allJenjang();

    echo '<option value="">--Pilih Jenjang--</option>';

    if ($jenjang) {
        foreach ($jenjang as $value) {
            echo '<option value="' . $value['id_jenjang'] . '">' . $value['jenjang'] . '</option>';
        }
    }
}



}
