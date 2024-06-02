<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MatakuliahModel;
use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\ProdiModel;

class MatakuliahController extends BaseController
{
    protected $mmatkul;
    protected $mdosen;
    protected $mkelas;
    protected $mprodi;
    protected $db;
    public function __construct()
    {
        $this->mmatkul = new MatakuliahModel();
        $this->mkelas = new KelasModel();
        $this->mprodi = new ProdiModel();
        $this->mdosen = new DosenModel();
        $this->db = \Config\Database::connect();
    }
    public function halamanMatakuliah()
    {
        if(session()->get('role') === 'admin') {
            $matkul = $this->mmatkul->ambilMatkulJoinDosenProdi();
            $dosen = $this->mdosen->findAll();
            $prodi = $this->mprodi->findAll();

            $data['matkul'] = $matkul;
            $data['dosen'] = $dosen;
            $data['prodi'] = $prodi;
            $data['title'] = "Matakuliah";
            return view('beranda/admin/matakuliah', $data);
        } else if(session()->get('role') === 'dosen') {
            return redirect()->to(base_url('/home'));
        } else if(session()->get('role') === 'mahasiswa') {
            return redirect()->to(base_url('/home'));
        }
    }
    public function tambahMatkul()
    {
        $list_dosen = array_column($this->mdosen->findAll(), 'nidn');
        $list_prodi = array_column($this->mprodi->findAll(), 'kode_prodi');
        $validationRules = [
            'kode_matkul' => 'required|alpha_numeric|max_length[15]|is_unique[matakuliah.kode_matkul]',
            'nama_matkul' => 'required|alpha_numeric_space|max_length[50]',
            'nidn' => 'required|in_list['. implode(',', $list_dosen) .']',
            'kode_prodi' => 'required|in_list['. implode(',', $list_prodi) .']'
        ];

        if(!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('gagal', $gagal);
        };

        $kode_matkul = esc($this->request->getPost('kode_matkul'));
        $nama_matkul = esc($this->request->getPost('nama_matkul'));
        $nidn = esc($this->request->getPost('nidn'));
        $kode_prodi = esc($this->request->getPost('kode_prodi'));

        $data = [
            'kode_matkul' => $kode_matkul,
            'nama_matkul'  => $nama_matkul,
            'nidn' => $nidn,
            'kode_prodi' => $kode_prodi
        ];

        $this->mmatkul->insert($data);
        
        if ($this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => "Matakuliah gagal ditambahkan!",
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Matakuliah berhasil ditambahkan!',
                'alert' => 'success'
            ];
            session()->setFlashData('sweet', 'success');
            session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
    public function ubahMatkul($kode_matkul)
    {
        $list_dosen = array_column($this->mdosen->findAll(), 'nidn');
        $list_prodi = array_column($this->mprodi->findAll(), 'kode_prodi');
        $validationRules = [
            'nama_matkul' => 'required|alpha_numeric_space|max_length[50]',
            'nidn' => 'required|in_list['. implode(',', $list_dosen) .']',
            'kode_prodi' => 'required|in_list['. implode(',', $list_prodi) .']'
        ];

        if(!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('gagal', $gagal);
        };

        $nama_matkul = esc($this->request->getPost('nama_matkul'));
        $nidn = esc($this->request->getPost('nidn'));
        $kode_prodi = esc($this->request->getPost('kode_prodi'));

        $data = [
            'kode_matkul' => $kode_matkul,
            'nama_matkul'  => $nama_matkul,
            'nidn' => $nidn,
            'kode_prodi' => $kode_prodi
        ];

        $cekData = $this->mmatkul->find($kode_matkul);
        $this->mmatkul->save($data);
        
        if (!$cekData && $this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => "Matakuliah gagal diubah atau data tidak ada!",
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Matakuliah berhasil diubah!',
                'alert' => 'success'
            ];
            session()->setFlashData('sweet', 'success');
            session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
    public function hapusMatkul($kode_matkul)
    {
        if(!$kode_matkul && $this->mmatkul->find($kode_matkul)) {
            if($this->mmatkul->delete($kode_matkul)) {
                $pesan = [
                    'pesan' => 'Matakuliah berhasil di hapus!',
                    'alert' => 'success'
                ];
                session()->setFlashData('sweet', 'success');
                session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
                return redirect()->back()->with('pesan', $pesan);
            } else {
                $pesan = [
                    'pesan' => 'Matakuliah gagal di hapus!',
                    'alert' => 'danger'
                ];
                session()->setFlashData('sweet', 'error');
                session()->setFlashData('sweet_text', 'Permintaan Gagal!');
                return redirect()->back()->with('pesan', $pesan);
            }
        } else {
            $pesan = [
                'pesan' => 'Matakuliah tidak dipilih atau kosong!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
}
