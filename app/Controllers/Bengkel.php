<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use App\Models\ModelBengkel;

class Bengkel extends BaseController
{
    public function __construct() 
    {
    $this->ModelWilayah = new ModelWilayah();
    $this->ModelSetting = new ModelSetting();
    $this->ModelBengkel = new ModelBengkel();
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
        ];
        return view('v_template_back_end', $data);
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



}
