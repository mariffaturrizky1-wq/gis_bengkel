<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'judul' => 'Home'
        ];
        return view('v_template_front_end');
    }
}
