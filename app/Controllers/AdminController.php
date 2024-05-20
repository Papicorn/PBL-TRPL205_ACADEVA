<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminModel;
use App\Models\MahasiswaModel;
use App\Models\DosenModel;

class AdminController extends BaseController
{
    public function masuk()
    {
        $validationRules = [
            'email' => 'required|valid_email',
            'kata_sandi' => 'required|min_length[6]',
        ];
        $validationMessage = [
            'email'  => [
                'required' => 'Email tidak boleh kosong!',
                'valid_email' => 'Gunakan format email yang benar!',
            ],
            'kata_sandi' => [
                'required' => 'Kata sandi tidak boleh kosong',
                'min_length' => 'Kata sandi tidak boleh kurang dari 6 character',
            ]
        ];

        if(!$this->validate($validationRules, $validationMessage)) {
            $gagal = $this->validator->getErrors();
            return redirect()->to(base_url('/masuk'))->with('gagal', $gagal);
        };

        $madmin = new AdminModel();

        $email = $this->request->getPost('email');
        $kata_sandi = $this->request->getPost('kata_sandi');

        $cek = $madmin->ambilDataAdmin($email);

        if($cek && password_verify($kata_sandi, $cek['kata_sandi'])) {
            $sessionData = [
                'nama_pengguna' => $cek['nama_pengguna'],
                'is_logged_in' => true,
                'role' => 'admin'
            ];

            session()->set($sessionData);
            session()->regenerate();

            session()->setFlashdata('title', 'Berhasil masuk!');
            session()->setFlashdata('success', 'Anda berhasil masuk ke aplikasi!');

            return redirect()->to(base_url('/home'));
        } else {
            $gagal = [
                'Email atau kata sandi tidak cocok!'
            ];
            return redirect()->to(base_url('/masuk'))->with('gagal', $gagal);
        }

    }

    public function keluar()
    {
        session()->destroy();
        
        session()->setFlashdata('title', 'Berhasil keluar!');
        session()->setFlashdata('success', 'Anda berhasil keluar dari aplikasi!');

        return redirect()->to(base_url('/masuk'));
    }

    public function beranda()
    {
        if(session()->get('role') === 'admin'){
            $mmhs = new MahasiswaModel();
            $mdosen = new DosenModel();

            $mhscount = $mmhs->countAll();
            $dosencount = $mdosen->countAll();

            $data['jumlah_mhs'] = $mhscount;
            $data['jumlah_dosen'] = $dosencount;
            $data['title'] = 'Beranda';
        
            return view('beranda/admin/beranda', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
}
