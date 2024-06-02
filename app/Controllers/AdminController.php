<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminModel;
use App\Models\MahasiswaModel;
use App\Models\DosenModel;
use App\Models\SoalUjianModel;
use App\Models\JadwalUjianModel;
use App\Models\KelasModel;
use App\Models\MatakuliahModel;
use App\Models\ProdiModel;

class AdminController extends BaseController
{
    protected $mdosen;
    protected $mmhs;
    protected $mkelas;
    protected $mmatkul;
    protected $mprodi;
    public function __construct()
    {
        $this->mdosen = new DosenModel();
        $this->mmhs = new MahasiswaModel();
        $this->mkelas = new KelasModel();
        $this->mprodi = new ProdiModel();
        $this->mmatkul = new MatakuliahModel();
    }
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
            $msoal = new SoalUjianModel();
            $mjadwal = new JadwalUjianModel();

            $currentDateTime = new \DateTime();

            $mhscount = $this->mmhs->countAll();
            $dosencount = $this->mdosen->countAll();
            $soalcount = $msoal->countAll();
            $jadwalcount = $mjadwal->countAll();

            $semuajadwal = $mjadwal->joinJadwalMatkulKelasProdi();

            $data['jumlah_mhs'] = $mhscount;
            $data['jumlah_dosen'] = $dosencount;
            $data['jumlah_soal'] = $soalcount;
            $data['jumlah_jadwal'] = $jadwalcount;

            foreach ($semuajadwal as &$jadwal) {
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
            
            $data['semua_jadwal'] = $semuajadwal;

            $data['title'] = 'Beranda';
        
            return view('beranda/admin/beranda', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
    public function halamanDataAkun()
    {
        if(session()->get('role') === 'admin') {
            $dosen = $this->mdosen->findAll();
            $mhs = $this->mmhs->ambilMhsJoinKelasJoinProdi();
            $kelas = $this->mkelas->findAll();
            $prodi = $this->mprodi->findAll();

            $data['dosen'] = $dosen;
            $data['prodi'] = $prodi;
            $data['mhs'] = $mhs;
            $data['kelas'] = $kelas;
            $data['title'] = "Data Akun";
            return view('beranda/admin/data_akun', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
}
