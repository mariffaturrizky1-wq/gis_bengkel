<?php

namespace App\Controllers;

class Kategori extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Kategori',
            'menu' => 'kategori',
            'page' => 'v_kategori',
        ];
        return view('v_template_back_end', $data);
    }
}