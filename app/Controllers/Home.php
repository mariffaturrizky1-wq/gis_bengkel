<?php

namespace App\Controllers;

use App\Models\ModelSetting;
use App\Models\ModelWilayah;

class Home extends BaseController
{
    public function __construct() 
    {
    $this->ModelSetting = new ModelSetting();
    $this->ModelWilayah = new ModelWilayah();
    }

    public function index(): string
    {
        $data = [
            'judul' => 'Home',
            'page' => 'v_home',
            'web' => $this->ModelSetting->DataWeb(),
            'Wilayah' => $this->ModelWilayah->AllData(),
        ];
        return view('v_template_front_end', $data);
    }
}
