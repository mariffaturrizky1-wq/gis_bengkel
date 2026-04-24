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
}