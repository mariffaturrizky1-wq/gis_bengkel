<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKategori; // 1. Imported the missing model namespace

// bengkel motor
class Kategori extends BaseController
{
    protected $ModelKategori; // 2. Declared the property for PHP compatibility

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
        
        // Prepare base data array
        $data = [
            'id_kategori' => $id_kategori,
        ];

        // 3. Check if a new file was actually uploaded before processing it
        if ($marker->isValid() && !$marker->hasMoved()) {
            $name_file = $marker->getRandomName();
            
            // Add the file name to the database payload
            $data['marker'] = $name_file;
            
            // Move file to 'public/marker' directory
            $marker->move('marker', $name_file);
        }

        // Send data to model (whether it contains a new marker file or just other updates)
        $this->ModelKategori->UpdateData($data);
        
        session()->setFlashdata('Update', 'Marker Berhasil Di Update !!');
        return redirect()->to('Kategori');
    }
}