<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;

Class Wilayah extends BaseController
{
    public function __construct() 
    {
    $this->ModelWilayah = new ModelWilayah();
    $this->ModelSetting = new ModelSetting();
    }

    public function index()
    {
        $data = [
            'judul' => 'Wilayah',
            'page' => 'Wilayah/v_index',
            'Wilayah' => $this->ModelWilayah->AllData(),
            'web' => $this->ModelSetting->DataWeb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Input Wilayah',
            'page' => 'Wilayah/v_input',
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors'=> [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'geojson' => [
                'label' => 'Data GeoJSON',
                'rules' => 'required',
                'errors'=> [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors'=> [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
        ])) {
            // jika validasi berhasil
            $data = [
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna' => $this->request->getPost('warna'),
                'geojson' => $this->request->getPost('geojson'),
            ];
            $this->ModelWilayah->InsertData($data);
            session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!');
            return redirect()->to('Wilayah');
        } else {
            // jika validasi gagal
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }
}