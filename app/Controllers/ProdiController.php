<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProdiModel;

class ProdiController extends BaseController
{
    protected $mprodi;
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->mprodi = new ProdiModel();
    }
    public function halamanProdi()
    {
        if(session()->get('role') === 'admin') {
            $prodi = $this->mprodi->findAll();

            $data['prodi'] = $prodi;
            $data['title'] = 'Prodi';
            return view('beranda/admin/prodi', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
    public function tambahProdi()
    {
        $valiadationRules = [
            'kode_prodi' => 'required|max_length[10]|alpha_numeric|is_unique[prodi.kode_prodi]',
            'nama_prodi' => 'required|max_length[50]|alpha_numeric_space'
        ];
        $validationMessage = [
            'kode_prodi' => [
                'required' => 'Kode prodi tidak boleh kosong',
                'max_length' => 'Maximal karakter pada kode prodi adalah 10 karakter',
                'alpha_numeric' => 'Karakter pada kode prodi yang diperbolehkan hanya alphabet dan numeric',
                'is_unique' => 'Kode prodi tidak boleh sama dengan yang lain'
            ],
            'nama_prodi' => [
                'required' => 'Nama program studi tidak boleh kosong',
                'max_length' => 'Maximal karakter pada nama program studi adalah 50 karakter',
                'alpha_numeric_space' => 'Karakter pada nama program studi yang diperbolehkan hanya alphabet, numeric dan spasi'
            ]
        ];

        if(!$this->validate($valiadationRules, $validationMessage)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan');
            return redirect()->back()->with('gagal', $gagal);
        }

        $kode_prodi = esc($this->request->getPost('kode_prodi'));
        $nama_prodi = esc($this->request->getPost('nama_prodi'));

        $data = [
            'kode_prodi' => $kode_prodi,
            'nama_prodi' => $nama_prodi
        ];

        $this->mprodi->insert($data);

        if($this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Program studi gagal ditambahkan!',
                'alert' => 'danger'
            ];
            session()->SetFlashData('sweet', 'error');
            session()->SetFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Program studi berhasil ditambahkan!',
                'alert' => 'success'
            ];
            session()->SetFlashData('sweet', 'success');
            session()->SetFlashData('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
    public function UbahProdi($kode_prodi)
    {
        $valiadationRules = [
            'nama_prodi' => 'required|max_length[50]|alpha_numeric_space'
        ];
        $validationMessage = [
            'nama_prodi' => [
                'required' => 'Nama program studi tidak boleh kosong',
                'max_length' => 'Maximal karakter pada nama program studi adalah 50 karakter',
                'alpha_numeric_space' => 'Karakter pada nama program studi yang diperbolehkan hanya alphabet, numeric dan spasi'
            ]
        ];

        if(!$this->validate($valiadationRules, $validationMessage)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan');
            return redirect()->back()->with('gagal', $gagal);
        }

        $nama_prodi = esc($this->request->getPost('nama_prodi'));

        $data = [
            'kode_prodi' => $kode_prodi,
            'nama_prodi' => $nama_prodi
        ];

        $cekData = $this->mprodi->find($kode_prodi);
        $this->mprodi->save($data);

        if(!$cekData && $this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Program studi gagal ditambahkan!',
                'alert' => 'danger'
            ];
            session()->SetFlashData('sweet', 'error');
            session()->SetFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Program studi berhasil ditambahkan!',
                'alert' => 'success'
            ];
            session()->SetFlashData('sweet', 'success');
            session()->SetFlashData('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
    public function hapusProdi($kode_prodi)
    {
        if($kode_prodi && $this->mprodi->find($kode_prodi)) {
            if($this->mprodi->delete($kode_prodi)) {
                $pesan = [
                    'pesan' => 'Data program studi berhasil dihapus!',
                    'alert' => 'success'
                ];
                session()->setFlashdata('sweet', 'success');
                session()->setFlashdata('sweet_text', 'Permintaan Berhasil');
                return redirect()->back()->with('pesan', $pesan);
            } else {
                $pesan = [
                    'pesan' => 'Data program studi gagal dihapus!',
                    'alert' => 'danger'
                ];
                session()->setFlashdata('sweet', 'error');
                session()->setFlashdata('sweet_text', 'Permintaan Gagal');
                return redirect()->back()->with('pesan', $pesan);
            }
        } else {
            $pesan = [
                'pesan' => 'Data program studi gagal tidak dipilih atau tidak ada !',
                'alert' => 'danger'
            ];
            session()->setFlashdata('sweet', 'error');
            session()->setFlashdata('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
}
