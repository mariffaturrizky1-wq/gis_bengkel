<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;
use App\Models\ModelAuth;

class Auth extends BaseController
{

    protected $ModelUser;
    protected $ModelAuth;
    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelAuth = new ModelAuth();
    }
    public function login()
    {
        $data = [
            'judul' => 'Login',
        ];
        return view('v_login', $data);
    }

    public function cek_login_user()
    {
        if (
            $this->validate([
                'email' => [
                    'label' => 'E-mail',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi !!'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi !!'
                    ]
                ],
            ])
        ) {
            $email = $this->request->getPost('email');
            $password = sha1($this->request->getPost('password'));
            $CekLogin = $this->ModelAuth->Login($email, $password);
            if ($CekLogin) {
                # jika berhasil Login
                session()->set('nama_user',$CekLogin['nama_user']);
                session()->set('foto',$CekLogin['foto']);
                session()->set('login', 1);
                return redirect()->to(base_url('admin'));
            } else {
                # Jika gagal Login
                session()->setFlashdata('pesan', 'Email Atau Password Salah');
                return redirect()->to(base_url('auth/login'));
            }


        } else {
            //Jika gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/login'))->withInput()->with('validation', $this->validator);
        }
    }

    public function logout()
    {
        session()->remove('nama_user');
        session()->remove('foto');
        session()->remove('login');
        session()->setFlashdata('logout', 'Anda Berhasil Log Out');
        return redirect()->to(base_url('auth/login'));
    }
}