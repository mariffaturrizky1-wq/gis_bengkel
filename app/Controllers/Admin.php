<?php

namespace App\Controllers;

use App\Models\ModelSetting;

class Admin extends BaseController
{
    public function __construct() 
    {
    $this->ModelSetting = new ModelSetting();
    }

    public function index(): string
    {
        $data = [
            'judul' => 'Dashboard',
            'page' => 'v_dashboard',
        ];
        return view('v_template_back_end', $data);
    }

     public function Setting(): string
    {
        $data = [
            'judul' => 'Setting',
            'page' => 'v_setting',
            'web' => $this->ModelSetting->DataWeb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateSetting()
    {
       $data = [
        'id' => 1,
        'nama_web' => $this->request->getPost('nama_web'),
        'coordinat_wilayah' => $this->request->getPost('coordinat_wilayah'),
        'zoom_view' => $this->request->getPost('zoom_view')
        ];
        $this->ModelSetting->UpdateData($data);
        session()->setFlashdata('pesan','Setting Web Telah Diupdate !!!');
        return redirect()->to('Admin/Setting');
    }
}
