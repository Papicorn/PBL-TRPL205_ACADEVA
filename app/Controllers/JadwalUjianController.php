<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JadwalUjianModel;
use App\Models\KelasModel;
use App\Models\MatakuliahModel;
use App\Models\ProdiModel;
use App\Models\MahasiswaModel;

class JadwalUjianController extends BaseController
{
    protected $mjadwal;
    protected $mmhs;
    protected $mkelas;
    protected $mprodi;
    protected $mmatkul;
    protected $db;
    public function __construct()
    {
        $this->mjadwal = new JadwalUjianModel();
        $this->mmhs = new MahasiswaModel();
        $this->mprodi = new ProdiModel();
        $this->mkelas = new KelasModel();
        $this->mmatkul = new MatakuliahModel();
        $this->db = \Config\Database::connect();
    }
    public function halamanJadwalAsesmen()
    {
        if(session()->get('role') === "admin") {
            $jadwal = $this->mjadwal->joinJadwalMatkulKelasProdi();
            $kelas = $this->mkelas->findAll();
            $matkul = $this->mmatkul->findAll();
            $prodi = $this->mprodi->findAll();

            $currentDateTime = new \DateTime();

            foreach ($jadwal as &$jadwal1) {
                $ujianSelesai = new \DateTime($jadwal1['tanggal'] . ' ' . $jadwal1['waktu_selesai']);
                $ujianMulai = new \DateTime($jadwal1['tanggal'] . ' ' . $jadwal1['waktu_mulai']);
                if($currentDateTime <= $ujianMulai) {
                    $jadwal1['status'] = "Belum Dimulai";
                    $jadwal1['badge'] = "warning";
                } else if ($currentDateTime <= $ujianSelesai && $currentDateTime >= $ujianMulai) {
                    $jadwal1['status'] = '<i class="fa-solid fa-file-pen fa-bounce"></i> Berlangsung';
                    $jadwal1['badge'] = "secondary";
                } else {
                    $jadwal1['status'] = 'Selesai';
                    $jadwal1['badge'] = "primary";                    
                };
            };

            $data['jadwal'] = $jadwal;
            $data['prodi'] = $prodi;
            $data['matkul'] = $matkul;
            $data['kelas'] = $kelas;
            $data['title'] = "Jadwal Asesmen";
            return view('beranda/admin/jadwal_ujian', $data);
        } elseif(session()->get('role') === "mahasiswa") {
            $nama_pengguna = session()->get('nama_pengguna');
            $mhs = $this->mmhs->ambilDataMahasiswa($nama_pengguna);
            $jadwal = $this->mjadwal->ambilJadwalDariKelas($mhs['id_kelas']);

            $currentDateTime = new \DateTime();

            foreach ($jadwal as &$jadwal1) {
                $ujianSelesai = new \DateTime($jadwal1['tanggal'] . ' ' . $jadwal1['waktu_selesai']);
                $ujianMulai = new \DateTime($jadwal1['tanggal'] . ' ' . $jadwal1['waktu_mulai']);
                if($currentDateTime <= $ujianMulai) {
                    $jadwal1['status'] = "Belum Dimulai";
                    $jadwal1['badge'] = "warning";
                } else if ($currentDateTime <= $ujianSelesai && $currentDateTime >= $ujianMulai) {
                    $jadwal1['status'] = '<i class="fa-solid fa-file-pen fa-bounce"></i> Berlangsung';
                    $jadwal1['badge'] = "secondary";
                } else {
                    $jadwal1['status'] = "Selesai";
                    $jadwal1['badge'] = "primary";                    
                };
            };

            $data['title'] = 'Jadwal Asesmen';
            $data['mhs'] = $mhs;
            $data['jadwal'] = $jadwal;
            return view('beranda/mahasiswa/jadwal_asesmen', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
    public function tambahJadwal()
    {
        $kode_matkulList = array_column($this->mmatkul->findAll(), 'kode_matkul');
        $id_kelasList = array_column($this->mkelas->findAll(), 'id_kelas');
        $validationRules = [
            'kode_matkul' => 'required|in_list['. implode(",", $kode_matkulList) .']',
            'id_kelas' => 'required|in_list['. implode(",", $id_kelasList) .']',
            'tanggal' => 'required|valid_date[Y-m-d]',
            'waktu_mulai' => 'required|valid_date[H:i:s]',
            'waktu_selesai' => 'required|valid_date[H:i:s]',
        ];
        // $validationMessage = [
        //     'kode_matkul' => [
        //         ''
        //     ],
        //     'id_kelas' => [
        //         ''
        //     ],
        //     'tanggal' => [
        //         ''
        //     ],
        //     'waktu_mulai' => [
        //         ''
        //     ],
        //     'waktu_selesai' => [
        //         ''
        //     ]
        // ]
        
        if(!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();

            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('gagal', $gagal);
        };
        $kode_matkul = esc($this->request->getPost('kode_matkul'));
        $id_kelas = esc($this->request->getPost('id_kelas'));
        $tanggal = esc($this->request->getPost('tanggal'));
        $waktu_mulai = esc($this->request->getPost('waktu_mulai'));
        $waktu_selesai = esc($this->request->getPost('waktu_selesai'));
        
        $currentDateTime = new \DateTime();
        $dibuatTgl = new \DateTime($tanggal . ' ' . $waktu_mulai);
        if($dibuatTgl->format('Y-m-d') < $currentDateTime->format('Y-m-d')) {
            $pesan = [
                'pesan' => 'Tanggal yang di pilih telah berlalu!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        }

        $data = [
            'kode_matkul' => $kode_matkul,
            'id_kelas'=> $id_kelas,
            'tanggal' => $tanggal,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesai
        ];

        $this->mjadwal->insert($data);
        if($this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Data jadwal gagal ditambahkan!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Data jadwal berhasil ditambahkan!',
                'alert' => 'success'
            ];
            session()->setFlashData('sweet', 'success');
            session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
    public function ubahJadwal($id_jadwal)
    {
        $kode_matkulList = array_column($this->mmatkul->findAll(), 'kode_matkul');
        $id_kelasList = array_column($this->mkelas->findAll(), 'id_kelas');
        // if($this->request->getPost('kode_matkul')) { $required = 'required|'; } else { $required = ""; };
        $validationRules = [
            'kode_matkul' => 'required|in_list['. implode(",", $kode_matkulList) .']',
            'id_kelas' => 'required|in_list['. implode(",", $id_kelasList) .']',
            'tanggal' => 'required|valid_date[Y-m-d]',
            'waktu_mulai' => 'required|valid_date[H:i:s]',
            'waktu_selesai' => 'required|valid_date[H:i:s]',
        ];
        // $validationMessage = [
        //     'kode_matkul' => [
        //         ''
        //     ],
        //     'id_kelas' => [
        //         ''
        //     ],
        //     'tanggal' => [
        //         ''
        //     ],
        //     'waktu_mulai' => [
        //         ''
        //     ],
        //     'waktu_selesai' => [
        //         ''
        //     ]
        // ]
        if(!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();

            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('gagal', $gagal);
        };
        $kode_matkul = esc($this->request->getPost('kode_matkul'));
        $id_kelas = esc($this->request->getPost('id_kelas'));
        $tanggal = esc($this->request->getPost('tanggal'));
        $waktu_mulai = esc($this->request->getPost('waktu_mulai'));
        $waktu_selesai = esc($this->request->getPost('waktu_selesai'));

        $currentDateTime = new \DateTime();
        $dibuatTgl = new \DateTime($tanggal . ' ' . $waktu_mulai);
        if($dibuatTgl->format('Y-m-d') < $currentDateTime->format('Y-m-d')) {
            $pesan = [
                'pesan' => 'Tanggal yang di pilih telah berlalu!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        }
        
        $data = [
            'id_jadwal' => $id_jadwal,
            'kode_matkul' => $kode_matkul,
            'id_kelas'=> $id_kelas,
            'tanggal' => $tanggal,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesai
        ];

        $cekData = $this->mjadwal->find($id_jadwal);
        $this->mjadwal->save($data);

        if(!$cekData && $this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Data jadwal gagal diubah!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Data jadwal berhasil diubah!',
                'alert' => 'success'
            ];
            session()->setFlashData('sweet', 'success');
            session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
    public function hapusJadwal($id_jadwal)
    {
        if($id_jadwal && $this->mjadwal->find($id_jadwal)) {
            $this->mjadwal->delete($id_jadwal);
            if($this->db->affectedRows() == 0) {
                $pesan = [
                    'pesan' => 'Jadwal gagal dihapus!',
                    'alert' => 'danger'
                ]; 
                session()->setFlashData('sweet_text', 'Permintaan Gagal!');
                session()->setFlashData('sweet', 'error');
                return redirect()->back()->with('pesan', $pesan);
            } else {
                $pesan = [
                    'pesan' => 'Jadwal berhasil dihapus!',
                    'alert' => 'success'
                ]; 
                session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
                session()->setFlashData('sweet', 'success');
                return redirect()->back()->with('pesan', $pesan);
            }
        } else {
            $pesan = [
                'pesan' => 'Jadwal tidak dipilih atau tidak ada!',
                'alert' => 'danger'
            ]; 
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            session()->setFlashData('sweet', 'error!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
}
