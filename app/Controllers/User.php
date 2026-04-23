<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'User',
            'menu' => 'user',
            'page' => 'v_user',
        ];
        return view('v_template_back_end', $data);
    }
}