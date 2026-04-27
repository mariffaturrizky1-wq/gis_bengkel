<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKategori;
class Kategori extends BaseController
{
      public function __construct() 
    {
    $this->ModelKategori = new ModelKategori();
    }

    public function index()
    {
        $data = [
            'judul' => 'Kategori',
            'menu' => 'kategori',
            'page' => 'v_kategori',
            'kategori' => $this->ModelKategori->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateData($id_kategori)
    {
        $marker = $this->request->getFile('marker');
        $name_file = $marker->getRandomName();
        $data = [
            'id_kategori' => $id_kategori,
            'marker' => $name_file,
        ];
        $marker->move('marker', $name_file);
        $this->ModelKategori->UpdateData($data);
        session()->setFlashdata('Update', 'Marker Berhasil Di Update !!');
            return redirect()->to('Kategori');


    }
}