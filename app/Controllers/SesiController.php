<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DosenModel;
use App\Models\JadwalUjianModel;
use App\Models\SesiModel;

class SesiController extends BaseController
{
    protected $mdosen;
    protected $msesi;
    protected $mjadwal;
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->msesi = new SesiModel();
        $this->mdosen = new DosenModel();
        $this->mjadwal = new JadwalUjianModel();
    }
    public function halamanSesi()
    {
        if(session()->get('role') === 'dosen') {
            $nama_pengguna = session()->get('nama_pengguna');
            $dosen = $this->mdosen->ambilDataDosen($nama_pengguna);
            $nidn = $dosen['nidn'];
            $sesi_diampu = $this->msesi->ambilSesiPengampuJoinMatkul($nidn);

            $jadwal_diampu = $this->mjadwal->ambilJadwalPengampu($nidn);

            $data['dosen'] = $dosen;
            $data['sesi'] = $sesi_diampu;
            $data['jadwal_diampu'] = $jadwal_diampu;
            $data['title'] = "Sesi Asesmen";
            return view('beranda/dosen/sesi_ujian', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
    public function tambahSesi($id_jadwal)
    {
        $validationRules = [
            'nama_sesi' => 'required|max_length[50]|alpha_numeric_space',
            'keterangan_sesi' => 'required|max_length[100]',
            'passing_grade' => 'required|integer|max_length[11]'
        ];
        // $validationMessage = [
        //     'nama_sesi' => [
        //         'required' => 'Nama sesi tidak boleh kosong!',
        //         'max_length' => 'Panjang karakter nama sesi tidak boleh lebih dari 50!',
        //         'alpha_numeric_space' => 'Karakter yang diperbolehkan dari nama sesi hanya alphabet, numeric dan spasi!',
        //         'is_unique' => 'Nama sesi telah ada, tidak diperbolehkan sama!'
        //     ],
        //     'waktu' => [
        //         'required' => 'Waktu pengerjaan tidak boleh kosong!',
        //         'integer' => ''
        //     ]
        // ]
        if(!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('gagal', $gagal);
        };

        $nama_sesi = esc($this->request->getPost('nama_sesi'));
        $keterangan_sesi = esc($this->request->getPost('keterangan_sesi'));
        $passing_grade = esc($this->request->getPost('passing_grade'));

        $data = [
            'nama_sesi' => $nama_sesi,
            'keterangan_sesi' => $keterangan_sesi,
            'passing_grade' => $passing_grade,
            'id_jadwal' => $id_jadwal
        ];

        if($id_jadwal) {
            $this->msesi->insert($data);
            if($this->db->affectedRows() == 0) {
                $pesan = [
                    'pesan' => 'Sesi gagal ditambahkan!',
                    'alert' => 'danger'
                ];
                session()->setFlashData('sweet', 'error');
                session()->setFlashData('sweet_text', 'Permintaan Gagal!');
                return redirect()->back()->with('pesan', $pesan);
            } else {
                $pesan = [
                    'pesan' => 'Sesi berhasil ditambahkan!',
                    'alert' => 'success'
                ];
                session()->setFlashData('sweet', 'success');
                session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
                return redirect()->back()->with('pesan', $pesan);
            }
        } else {
            $pesan = [
                'pesan' => 'Jadwal tidak dipilih!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
    public function ubahSesi($id_sesi)
    {
        $validationRules = [
            'nama_sesi' => 'required|max_length[50]|alpha_numeric_space',
            'keterangan_sesi' => 'required|max_length[100]',
            'passing_grade' => 'required|integer|max_length[11]'
        ];
        // $validationMessage = [
        //     'nama_sesi' => [
        //         'required' => 'Nama sesi tidak boleh kosong!',
        //         'max_length' => 'Panjang karakter nama sesi tidak boleh lebih dari 50!',
        //         'alpha_numeric_space' => 'Karakter yang diperbolehkan dari nama sesi hanya alphabet, numeric dan spasi!',
        //         'is_unique' => 'Nama sesi telah ada, tidak diperbolehkan sama!'
        //     ],
        //     'waktu' => [
        //         'required' => 'Waktu pengerjaan tidak boleh kosong!',
        //         'integer' => ''
        //     ]
        // ]
        if(!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('gagal', $gagal);
        };

        $nama_sesi = esc($this->request->getPost('nama_sesi'));
        $keterangan_sesi = esc($this->request->getPost('keterangan_sesi'));
        $passing_grade = esc($this->request->getPost('passing_grade'));

        $data = [
            'id_sesi' => $id_sesi,
            'nama_sesi' => $nama_sesi,
            'keterangan_sesi' => $keterangan_sesi,
            'passing_grade' => $passing_grade
        ];

        $cek_data = $this->msesi->find($id_sesi);
        $this->msesi->save($data);
        if(!$cek_data && $this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Sesi gagal diubah!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Sesi berhasil diubah!',
                'alert' => 'success'
            ];
            session()->setFlashData('sweet', 'success');
            session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
    public function hapusSesi($id_sesi)
    {
        if($id_sesi && $this->msesi->find($id_sesi)) {
            if($this->msesi->delete($id_sesi)) {
                $pesan = [
                    'pesan' => 'Data berhasil dihapus!',
                    'alert' => 'success'
                ];
                session()->setFlashdata('sweet', 'success');
                session()->setFlashdata('sweet_text', 'Permintaan Berhasil!');
                return redirect()->back()->with('pesan', $pesan);
            } else {
                $pesan = [
                    'pesan' => 'Data gagal dihapus!',
                    'alert' => 'danger'
                ];
                return redirect()->back()->with('pesan', $pesan);
            }
        } else {
            $pesan = [
                'pesan' => 'Data yang dipilih kosong atau tidak ada!',
                'alert' => 'danger'
            ];
            return redirect()->back()->with('pesan', $pesan);
        }
    }
}
