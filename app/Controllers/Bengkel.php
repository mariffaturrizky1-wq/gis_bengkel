<?php

namespace App\Controllers;

class Bengkel extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Bengkel',
            'menu' => 'bengkel',
            'page' => 'bengkel/v_index',
        ];
        return view('v_template_back_end', $data);
    }
}