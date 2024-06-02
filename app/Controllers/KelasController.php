<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KelasModel;
use App\Models\ProdiModel;

class KelasController extends BaseController
{
    protected $db;
    protected $mkelas;
    protected $mprodi;
    public function __construct()
    {
        $this->mkelas = new KelasModel();
        $this->mprodi = new ProdiModel();
        $this->db = \Config\Database::connect();
    }
    public function halamanKelas()
    {
        if(session()->get('role') === 'admin') {
            $kelas = $this->mkelas->ambilKelasJoinProdi();
            $prodi = $this->mprodi->findAll();

            $data['kelas'] = $kelas;
            $data['prodi'] = $prodi;
            $data['title'] = "Kelas";
            return view('beranda/admin/kelas', $data);
        } else {
            return redirect()->to(base_url('/home'));
        };
    }
    public function tambahKelas()
    {
        $kode_prodiList = array_column($this->mprodi->findAll(), 'kode_prodi');
        $validationRules = [
            'nama_kelas' => 'required|alpha_numeric_space|is_unique[kelas.nama_kelas]|max_length[50]',
            'kode_prodi' => 'required|in_list['. implode(',', $kode_prodiList) .']'
        ];
        $validationMessage = [
            'nama_kelas' => [
                'required' => 'Nama kelas tidak boleh kosong!',
                'alpha_numeric_space' => 'Karakter yang di perbolehkan hanya alphabet, numeric dan spasi pada nama kelas!',
                'max_length' => 'Karakter tidak di perbolehkan lebih dari 50 pada nama kelas!',
                'is_unique' => 'Nama kelas yang anda isi telah ada!'
            ],
            'kode_prodi' => [
                'required' => 'Prodi tidak boleh kosong!',
                'in_list' => 'Prodi harus dipilih!'
            ]
        ];
        if(!$this->validate($validationRules, $validationMessage)) {
            $gagal = $this->validator->getErrors();

            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('gagal', $gagal);
        };
        $nama_kelas = esc($this->request->getPost('nama_kelas'));
        $kode_prodi = esc($this->request->getPost('kode_prodi'));

        $data = [
            'nama_kelas' => $nama_kelas,
            'kode_prodi'=> $kode_prodi
        ];

        $this->mkelas->insert($data);
        if($this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Data kelas gagal ditambahkan!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Data kelas berhasil ditambahkan!',
                'alert' => 'success'
            ];
            session()->setFlashData('sweet', 'success');
            session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
    public function ubahKelas($id_kelas)
    {
        $kode_prodiList = array_column($this->mprodi->findAll(), 'kode_prodi');
        $validationRules = [
            'nama_kelas' => 'required|min_length[1]|alpha_numeric_space|max_length[50]',
            'kode_prodi' => 'required|in_list['. implode(',', $kode_prodiList) .']'
        ];
        $validationMessage = [
            'nama_kelas' => [
                'required' => 'Nama kelas tidak boleh kosong!',
                'alpha_numeric_space' => 'Karakter yang di perbolehkan hanya alphabet, numeric dan spasi pada nama kelas!',
                'max_length' => 'Karakter tidak di perbolehkan lebih dari 50 pada nama kelas!'
            ],
            'kode_prodi' => [
                'required' => 'Prodi tidak boleh kosong!',
                'in_list' => 'Prodi harus dipilih!'
            ]
        ];
        if(!$this->validate($validationRules, $validationMessage)) {
            $gagal = $this->validator->getErrors();

            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('gagal', $gagal);
        };
        $nama_kelas = esc($this->request->getPost('nama_kelas'));
        $kode_prodi = esc($this->request->getPost('kode_prodi'));

        $data = [
            'id_kelas' => $id_kelas,
            'nama_kelas' => $nama_kelas,
            'kode_prodi'=> $kode_prodi
        ];

        $cekData = $this->mkelas->find($id_kelas);
        $this->mkelas->save($data);
        
        if(!$cekData && $this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Data kelas gagal diubah!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Data kelas berhasil diubah!',
                'alert' => 'success'
            ];
            session()->setFlashData('sweet', 'success');
            session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
    public function hapusKelas($id_kelas)
    {
        if($id_kelas && $this->mkelas->find($id_kelas)) {
            $this->mkelas->delete($id_kelas);
            if($this->db->affectedRows() == 0) {
                $pesan = [
                    'pesan' => 'Kelas gagal dihapus!',
                    'alert' => 'danger'
                ]; 
                session()->setFlashData('sweet_text', 'Permintaan Gagal!');
                session()->setFlashData('sweet', 'error');
                return redirect()->back()->with('pesan', $pesan);
            } else {
                $pesan = [
                    'pesan' => 'Kelas berhasil dihapus!',
                    'alert' => 'success'
                ]; 
                session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
                session()->setFlashData('sweet', 'success');
                return redirect()->back()->with('pesan', $pesan);
            }
        } else {
            $pesan = [
                'pesan' => 'Kelas tidak dipilih atau tidak ada!',
                'alert' => 'danger'
            ]; 
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            session()->setFlashData('sweet', 'error!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
}
