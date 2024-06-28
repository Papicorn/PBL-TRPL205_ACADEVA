<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MahasiswaModel;
use App\Models\JadwalUjianModel;
use App\Models\KelasModel;
use App\Models\ProdiModel;
use App\Models\RekapitulasiModel;

class MahasiswaController extends BaseController
{
    protected $db;
    protected $mprodi;
    protected $mrekap;
    protected $mmhs;
    protected $mjadwal;
    protected $mkelas;
    public function __construct()
    {
        $this->mmhs = new MahasiswaModel();
        $this->mrekap = new RekapitulasiModel();
        $this->mjadwal = new JadwalUjianModel();
        $this->mkelas = new KelasModel();
        $this->mprodi = new ProdiModel();
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

        $cek = $this->mmhs->ambilDataMahasiswa($nama_pengguna);

        if($cek && password_verify($kata_sandi, $cek['kata_sandi'])) {
            $sessionData = [
                'nama_pengguna' => $cek['nama_pengguna'],
                'is_logged_in' => true,
                'role' => 'mahasiswa'
            ];

            session()->set($sessionData);
            session()->regenerate();

            session()->setFlashdata('title', 'Berhasil masuk!');
            session()->setFlashdata('success', 'Anda berhasil masuk ke aplikasi!');
            session()->setFlashdata('link', route_to('beranda.mahasiswa'));

            return redirect()->to(base_url('/home'));
        } else {
            $gagal = [
                'Email atau kata sandi tidak cocok!'
            ];
            return redirect()->to(base_url('masuk'))->with('gagal', $gagal);
        }
    }

    public function beranda()
    {
        if(session()->get('role') === "mahasiswa") {
            $nama_pengguna = session()->get('nama_pengguna');
            $mhs = $this->mmhs->ambilDataMahasiswa($nama_pengguna);
            $jadwal = $this->mjadwal->ambilJadwalDariKelas($mhs['id_kelas']);
            $kelas = $this->mkelas->find($mhs['id_kelas']);
            $rekap = $this->mrekap->nilaiRataRata($mhs['nim']);
            $ujian_diikuti = $this->mrekap->hitungUjianDiikuti($mhs['nim']);

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

            $data['data_beranda'] = [
                'nama_kelas' => $kelas['nama_kelas'],
                'kode_prodi' => $kelas['kode_prodi'],
                'ratanilai' => number_format($rekap, 2),
                'ujian_diikuti' => $ujian_diikuti
            ];
            $data['mhs'] = $mhs;
            $data['jadwal'] = $jadwal;
            $data['title'] = 'Beranda';
            return view('beranda/mahasiswa/beranda', $data);
        } else {
            return redirect()->to(base_url('/masuk'));
        }
    }
    public function daftar()
    {
        $id_kelasList = array_column($this->mkelas->findAll(), 'id_kelas');
        $kode_prodiList = array_column($this->mprodi->findAll(), 'kode_prodi');
        $validationRules = [
            'nim' => 'required|min_length[3]|max_length[15]|numeric|is_unique[mahasiswa.nim]',
            'nama_depan' => 'required|min_length[3]|max_length[40]|alpha_numeric',
            'nama_belakang' => 'max_length[40]',
            'email' => 'required|min_length[3]|max_length[50]|valid_email|is_unique[dosen.email]',
            'kata_sandi' => 'required|min_length[6]',
            'kelamin' => 'required|in_list[pria,wanita]',
            'no_telpon' => 'required|min_length[8]|max_length[20]',
            'alamat' => 'max_length[100]',
            'kode_prodi' => 'required|in_list['.implode(',', $kode_prodiList).']',
            'id_kelas' => 'required|in_list['.implode(',', $id_kelasList).']',
            'semester' => 'required|numeric'
        ];

        if (!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->withInput()->with('gagal', $gagal);
        };

        $nim = $this->request->getPost('nim');
        $nama_pengguna = strtolower($this->request->getPost('nama_depan')). '.'.$nim;
        $email = $this->request->getPost('email');
        $nama_lengkap = $this->request->getPost('nama_depan')." ".$this->request->getPost('nama_belakang');
        $kata_sandi = password_hash($this->request->getPost('kata_sandi'), PASSWORD_DEFAULT);
        $alamat = $this->request->getPost('alamat');
        $no_telpon = $this->request->getPost('no_telpon');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $id_kelas = $this->request->getPost('id_kelas');
        $kelamin = $this->request->getPost('kelamin');
        $semester = $this->request->getPost('semester');

        $data = [
            'nim' => $nim,
            'nama_pengguna' => $nama_pengguna,
            'email' => $email,
            'nama_lengkap' => $nama_lengkap,
            'kata_sandi' => $kata_sandi,
            'alamat' => $alamat,
            'no_telpon' => $no_telpon,
            'tanggal_lahir' => $tanggal_lahir,
            'id_kelas' => $id_kelas,
            'kelamin' => $kelamin,
            'semester' => $semester
        ];

        $this->mmhs->insert($data);

        if($this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Data mahasiswa gagal didaftarkan!',
                'alert' => 'danger'
            ];
            session()->setFlashdata('sweet', 'error');
            session()->setFlashdata('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Data mahasiswa berhasil didaftarkan!',
                'alert' => 'success'
            ];
            session()->setFlashdata('sweet', 'success');
            session()->setFlashdata('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);
        };
    }
    public function hapusDataMahasiswa($nim)
    {
        if($nim && $this->mmhs->find($nim)) {
            if($this->mmhs->delete($nim)) {
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
                session()->setFlashdata('sweet', 'error');
                session()->setFlashdata('sweet_text', 'Permintaan Gagal!');
                return redirect()->back()->with('pesan', $pesan);
            };
        } else {
            $pesan = [
                'pesan' => 'Data mahasiswa tidak dipilih atau tidak ada!',
                'alert' => 'danger'
            ];
            session()->setFlashdata('sweet', 'error');
            session()->setFlashdata('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
    public function ubahDataMahasiswa($nim)
    {
        $id_kelasList = array_column($this->mkelas->findAll(), 'id_kelas');
        $validationRules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[80]|alpha_numeric_space',
            'email' => 'required|min_length[3]|max_length[50]|valid_email',
            'kelamin' => 'required|in_list[pria,wanita]',
            'no_telpon' => 'required|min_length[8]|max_length[20]',
            'alamat' => 'max_length[100]',
            'id_kelas' => 'required|in_list['.implode(',', $id_kelasList).']',
            'semester' => 'required|numeric'
        ];

        if (!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->withInput()->with('gagal', $gagal);
        };

        if($this->request->getPost('kata_sandi') == NULL) {
            $cariMhs = $this->mmhs->find($nim);
            $kata_sandi = $cariMhs['kata_sandi'];
        } else {
            $kata_sandi = password_hash($this->request->getPost('kata_sandi'), PASSWORD_DEFAULT);
        }

        $nama_pengguna = $this->request->getPost('nama_pengguna');
        $email = $this->request->getPost('email');
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $alamat = $this->request->getPost('alamat');
        $no_telpon = $this->request->getPost('no_telpon');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $id_kelas = $this->request->getPost('id_kelas');
        $kelamin = $this->request->getPost('kelamin');
        $semester = $this->request->getPost('semester');

        $data = [
            'nim' => $nim,
            'nama_pengguna' => $nama_pengguna,
            'email' => $email,
            'nama_lengkap' => $nama_lengkap,
            'kata_sandi' => $kata_sandi,
            'alamat' => $alamat,
            'no_telpon' => $no_telpon,
            'tanggal_lahir' => $tanggal_lahir,
            'id_kelas' => $id_kelas,
            'kelamin' => $kelamin,
            'semester' => $semester
        ];

        $cekData = $this->mmhs->find($nim);
        $this->mmhs->save($data);

        if(!$cekData && $this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Data mahasiswa gagal diubah!',
                'alert' => 'danger'
            ];
            session()->setFlashdata('sweet', 'error');
            session()->setFlashdata('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $pesan = [
                'pesan' => 'Data Mahasiswa berhasil diubah!',
                'alert' => 'success'
            ];
            session()->setFlashdata('sweet', 'success');
            session()->setFlashdata('sweet_text', 'Permintaan Berhasil!');
            return redirect()->back()->with('pesan', $pesan);
        };
    }
}
