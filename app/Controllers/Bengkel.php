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
        ];
        return view('v_template_back_end', $data);
    }
}