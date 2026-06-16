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

public function Edit($id_user)
    {
        $data = [
            'judul' => 'Edit User',
            'menu' => 'user',
            'page' => 'user/v_edit',
            'user' => $this->ModelUser->DetailData($id_user),

        ];
        return view('v_template_back_end', $data);
    }

public function UpdateData($id_user)
{
    $rules = [
        'nama_user' => 'required',
        'email'     => 'required',
        'password'  => 'required',
        'foto'      => 'max_size[foto,2000]|mime_in[foto,image/jpg,image/jpeg,image/png]',
    ];

    if ($this->validate($rules)) {

        $foto = $this->request->getFile('foto');
        $user = $this->ModelUser->DetailData($id_user);
        
        // 1. Cek apakah user mengunggah file baru yang valid
        if ($foto && $foto->isValid() && ! $foto->hasMoved()) {
            $nama_file_foto = $foto->getRandomName();
            $foto->move('foto', $nama_file_foto); // Pindahkan file di sini saja
            
            if (!empty($user['foto']) && file_exists('foto/' . $user['foto'])) {
                unlink('foto/' . $user['foto']);
            }
        } else {
            $nama_file_foto = $user['foto'];
        }

        $data = [
            'id_user'   => $id_user,
            'nama_user' => $this->request->getPost('nama_user'),
            'email'     => $this->request->getPost('email'),
            'password'  => sha1($this->request->getPost('password')),
            'foto'      => $nama_file_foto,
        ];

        // 2. BARIS $foto->move() YANG DI SINI SUDAH DIHAPUS

        $this->ModelUser->UpdateData($data);
        session()->setFlashdata('update', 'Data Berhasil Diupdate !!');
        return redirect()->to(base_url('User'));

    } else {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
    }

    public function Delete($id_user)
    {
        //delete foto
        $user = $this->ModelUser->DetailData($id_user);
        if ($user ['foto'] <> ''){
            unlink('foto/' . $user ['foto']);
        }
        $data = [
            'id_user'   => $id_user,
        ];

        $this->ModelUser->DeleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Didelete !!');
        return redirect()->to(base_url('User'));
    }


}
