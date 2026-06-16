<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    public function __construct()
    {
        $this->ModelUser = new ModelUser;
    }

    public function index()
    {
        $data = [
            'judul' => 'User',
            'menu' => 'user',
            'page' => 'user/v_index',
            'user' => $this->ModelUser->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Input User',
            'menu' => 'user',
            'page' => 'user/v_input',

        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
{
    $rules = [
        'nama_user' => 'required',
        'email'     => 'required',
        'password'    => 'required',
        'foto'         => 'uploaded[foto]|max_size[foto,2000]|mime_in[foto,image/jpg,image/jpeg,image/png]',
    ];

    if ($this->validate($rules)) {

        $foto = $this->request->getFile('foto');
        $nama_file_foto = $foto->getRandomName();

        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'email'     => $this->request->getPost('email'),
            'password'    => sha1($this->request->getPost('password')),
            'foto'         => $nama_file_foto,
        ];

        $foto->move('foto', $nama_file_foto);
        $this->ModelUser->InsertData($data);
        session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!');
        return redirect()->to(base_url('User'));

    } else {
    dd($this->validator->getErrors());
}

}
}