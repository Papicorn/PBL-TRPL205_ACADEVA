<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DosenModel;
use App\Models\JadwalUjianModel;
use App\Models\MatakuliahModel;
use App\Models\RekapitulasiModel;

class DosenController extends BaseController
{
    protected $db;
    protected $mmatkul;
    protected $mrekap;
    protected $mdosen;
    protected $mjadwal;
    public function __construct()
    {
        $this->mdosen = new DosenModel();
        $this->mrekap = new RekapitulasiModel();
        $this->mmatkul = new MatakuliahModel();
        $this->mjadwal = new JadwalUjianModel();
        $this->db = \Config\Database::connect();
    }
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

        $nama_pengguna = $this->request->getPost('nama_pengguna');
        $kata_sandi = $this->request->getPost('kata_sandi');

        $cek = $this->mdosen->ambilDataDosen($nama_pengguna);

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
            session()->setFlashdata('link', route_to('beranda.dosen'));

            return redirect()->to(base_url('/home'));
        } else {
            $gagal = [
                'Email atau kata sandi tidak cocok!'
            ];
            return redirect()->to(base_url('masuk'))->with('gagal', $gagal);
        }
    }
    public function daftar()
    {
        $validationRules = [
            'nidn' => 'required|min_length[3]|max_length[15]|numeric|is_unique[dosen.nidn]',
            'nama_depan' => 'required|min_length[3]|max_length[40]|alpha_numeric_space',
            'nama_belakang' => 'max_length[40]',
            'email' => 'required|min_length[3]|max_length[50]|valid_email|is_unique[dosen.email]',
            'kata_sandi' => 'required|min_length[6]',
            'kelamin' => 'required|in_list[pria,wanita]',
            'no_telpon' => 'required|min_length[8]|max_length[20]',
            'alamat' => 'max_length[100]'
        ];

        if (!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi kesalahan!');
            return redirect()->back()->withInput()->with('gagal', $gagal);
        }

        $nidn = $this->request->getPost('nidn');
        $nama_lengkap = $this->request->getPost('nama_depan') . " " . $this->request->getPost('nama_belakang');
        $nama_pengguna = strtolower($this->request->getPost('nama_depan')) . "." . $this->request->getPost('nidn');
        $email = $this->request->getPost('email');
        $kata_sandi = password_hash($this->request->getPost('kata_sandi'), PASSWORD_DEFAULT);
        $kelamin = $this->request->getPost('kelamin');
        $no_telpon = $this->request->getPost('no_telpon');
        $alamat = $this->request->getPost('alamat');

        $datadosen = [
            'nidn' => $nidn,
            'nama_pengguna' => $nama_pengguna,
            'nama_lengkap' => $nama_lengkap,
            'email' => $email,
            'kata_sandi' => $kata_sandi,
            'kelamin' => $kelamin,
            'alamat' => $alamat,
            'no_telpon' => $no_telpon
        ];

        $this->mdosen->insert($datadosen);

        if ($this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Data dosen gagal ditambahkan!',
                'alert' => 'danger'
            ];
            session()->setFlashdata('sweet', 'error');
            session()->setFlashdata('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Data dosen berhasil ditambahkan!',
                'alert' => 'success'
            ];
            session()->setFlashdata('sweet', 'success');
            session()->setFlashdata('sweet_text', 'Permintaan Berhasil!');
            return redirect()->to(base_url(route_to('hal.data_akun')))->with('pesan', $pesan);
        }
    }
    public function hapusDataDosen($nidn)
    {
        if($nidn && $this->mdosen->find($nidn)) {
            if($this->mdosen->delete($nidn)) {
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
    public function ubahDataDosen($nidnRequest)
    {
        $validationRules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[80]|alpha_numeric_space',
            'email' => 'required|min_length[3]|max_length[50]|valid_email',
            'kelamin' => 'required|in_list[pria,wanita]',
            'no_telpon' => 'required|min_length[8]|max_length[20]',
            'alamat' => 'max_length[100]'
        ];

        if (!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            return redirect()->back()->withInput()->with('gagal', $gagal);
        }

        if($this->request->getPost('kata_sandi') == NULL) {
            $cariDosen = $this->mdosen->find($nidnRequest);
            $kata_sandi = $cariDosen['kata_sandi'];
        } else {
            $kata_sandi = password_hash($this->request->getPost('kata_sandi'), PASSWORD_DEFAULT);
        }

        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $nama_pengguna = $this->request->getPost('nama_pengguna');
        $email = $this->request->getPost('email');
        $kelamin = $this->request->getPost('kelamin');
        $no_telpon = $this->request->getPost('no_telpon');
        $alamat = $this->request->getPost('alamat');

        $datadosen = [
            'nidn' => $nidnRequest,
            'nama_pengguna' => $nama_pengguna,
            'nama_lengkap' => $nama_lengkap,
            'email' => $email,
            'kata_sandi' => $kata_sandi,
            'kelamin' => $kelamin,
            'alamat' => $alamat,
            'no_telpon' => $no_telpon
        ];

        $cekData = $this->mdosen->find($nidnRequest);
        $this->mdosen->save($datadosen);

        if (!$cekData && $this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Data dosen gagal diubah, ada kesalahan input atau data tidak ada!',
                'alert' => 'danger'
            ];
            session()->setFlashdata('sweet', 'success');
            session()->setFlashdata('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);            
        } else {
            $pesan = [
                'pesan' => 'Data dosen berhasil diubah!',
                'alert' => 'success'
            ];
            session()->setFlashdata('sweet', 'success');
            session()->setFlashdata('sweet_text', 'Permintaan Berhasil!');
            return redirect()->to(base_url(route_to('hal.data_akun')))->with('pesan', $pesan);
        }
    }
    public function beranda()
    {
        if(session()->get('role') === 'dosen') {
            $semua_jadwal = $this->mjadwal->joinJadwalMatkulKelasProdi();
            $nama_pengguna = session()->get('nama_pengguna');
            $dosen = $this->mdosen->ambilDataDosen($nama_pengguna);
            $nidn = $dosen['nidn'];

            $matkul_diampu = $this->mmatkul->ambilMatkulDariDiampu($nidn);
            $rekap_diampu = $this->mrekap->ambilRekapDariMatkul($nidn);
            $currentDateTime = new \DateTime();

            foreach ($semua_jadwal as &$jadwal) {
                $ujianSelesai = new \DateTime($jadwal['tanggal'] . ' ' . $jadwal['waktu_selesai']);
                $ujianMulai = new \DateTime($jadwal['tanggal'] . ' ' . $jadwal['waktu_mulai']);
                if($currentDateTime <= $ujianMulai) {
                    $jadwal['status'] = "Belum Dimulai";
                    $jadwal['badge'] = "warning";
                } else if ($currentDateTime <= $ujianSelesai && $currentDateTime >= $ujianMulai) {
                    $jadwal['status'] = '<i class="fa-solid fa-file-pen fa-bounce"></i> Berlangsung';
                    $jadwal['badge'] = "secondary";
                } else {
                    $jadwal['status'] = "Selesai";
                    $jadwal['badge'] = "primary";                    
                };
            };

            $data['dosen'] = $dosen;
            $data['matkul_diampu'] = $matkul_diampu;
            $data['rekap_diampu'] = $rekap_diampu;
            $data['semua_jadwal'] = $semua_jadwal;
            $data['title'] = 'Beranda';
            return view('beranda/dosen/beranda', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }

}