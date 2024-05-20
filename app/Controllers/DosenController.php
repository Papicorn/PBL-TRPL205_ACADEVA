<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DosenModel;

class DosenController extends BaseController
{
    public function masuk()
    {
        $validationRules = [
            'nama_pengguna' => 'required',
            'kata_sandi' => 'required|min_length[6]'
        ];
        $validationMessage = [
            'nama_pengguna' => [
                'required' => 'Nama pengguna tidak boleh kosong!'
            ],
            'kata_sandi' => [
                'required' => 'Kata sandi tidak boleh kosong!',
                'min_length' => 'Kata sandi tidak boleh kurang dari 6 karakter!'
            ]
        ];

        if(!$this->validate($validationRules, $validationMessage)) {
            $gagal = $this->validator->getErrors();
            return redirect()->to(base_url('/masuk'))->with('gagal', $gagal);
        }

        $mdosen = new DosenModel();

        $nama_pengguna = $this->request->getPost('nama_pengguna');
        $kata_sandi = $this->request->getPost('kata_sandi');

        $cek = $mdosen->ambilDataDosen($nama_pengguna);

        if($cek && password_verify($kata_sandi, $cek['kata_sandi'])) {
            $sessionData = [
                'nama_pengguna' => $cek['nama_pengguna'],
                'is_logged_in' => true,
                'role' => 'dosen'
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
            return redirect()->to(base_url('masuk'))->with('gagal', $gagal);
        }

    }
}
