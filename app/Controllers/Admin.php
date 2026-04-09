<?php

namespace App\Controllers;


class Admin extends BaseController
{


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
        ];
        return view('v_template_back_end', $data);
    }
}
