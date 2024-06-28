<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DosenModel;
use App\Models\SoalUjianModel;
use App\Models\SesiModel;
use App\Models\MahasiswaModel;
use App\Models\PilihanModel;
use App\Models\JadwalUjianModel;
use App\Models\RekapitulasiModel;

class SoalUjianController extends BaseController
{
    protected $db;
    protected $mdosen;
    protected $mmhs;
    protected $mrekap;
    protected $mpilihan;
    protected $mjadwal;
    protected $msoal;
    protected $msesi;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->mpilihan = new PilihanModel();
        $this->mjadwal = new JadwalUjianModel();
        $this->mdosen = new DosenModel();
        $this->mrekap = new RekapitulasiModel();
        $this->mmhs = new MahasiswaModel();
        $this->msesi = new SesiModel();
        $this->msoal = new SoalUjianModel();
    }
    public function halamanSoal()
    {
        if(session()->get('role') === 'dosen') {
            $nama_pengguna = session()->get('nama_pengguna');
            $dosen = $this->mdosen->ambilDataDosen($nama_pengguna);
            $nidn = $dosen['nidn'];
            $soal_diampu = $this->msoal->ambilSoalPengampu($nidn);
            $sesi_diampu = $this->msesi->ambilSesiPengampuJoinMatkul($nidn);

            $data['soal_diampu'] = $soal_diampu;
            $data['sesi_diampu'] = $sesi_diampu;
            $data['dosen'] = $dosen;
            $data['title'] = 'Bank Soal';
            return view('beranda/dosen/soal_ujian', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
    public function halamanDaftarSoal($id_sesi)
    {
        if(session()->get('role') === 'dosen') {
            $nama_pengguna = session()->get('nama_pengguna');
            $dosen = $this->mdosen->ambilDataDosen($nama_pengguna);
            $nidn = $dosen['nidn'];

            $sesi_diampu = $this->msesi->ambilSesiDariId($id_sesi);
            $soal_ujian = $this->msoal->ambilSoalDariIdSesi($id_sesi);
            $pilihan_soal = $this->mpilihan->findAll();
            $pilihan_ubah = $this->mpilihan->ambilPilihanUbah();
            shuffle($pilihan_soal);
            $jumlah_soal = $this->msoal->jumlahSoalDariSesi($id_sesi);
            $jumlah_poin = $this->msoal->jumlahPoinDariSesi($id_sesi);

            $data['dosen'] = $dosen;
            $data['jumlah_soal'] = $jumlah_soal;
            $data['jumlah_poin'] = $jumlah_poin;
            $data['soal_ujian'] = $soal_ujian;
            $data['pilihan_soal'] = $pilihan_soal;
            $data['pilihan_ubah'] = $pilihan_ubah;
            $data['sesi_diampu'] = $sesi_diampu;
            $data['title'] = 'Daftar Soal';
            return view('beranda/dosen/daftar_soal', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
    public function halamanAsesmenAwal($id_jadwal)
    {
        if(session()->get('role') === "mahasiswa") {
            $nama_pengguna = session()->get('nama_pengguna');
            $mhs = $this->mmhs->ambilDataMahasiswa($nama_pengguna);
            $nim = $mhs['nim'];
            $cek_rekap = $this->mrekap->cekAmbilSudahMengerjakan($nim, $id_jadwal);
            if($cek_rekap) {
                $pesan = [
                    'pesan' => 'Anda sudah mengerjakan asesmen ini!',
                    'alert' => 'danger'
                ];
                session()->setFlashData('sweet', 'error');
                session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
                return redirect()->to(route_to('beranda.mahasiswa'))->with('pesan', $pesan);
            } else {
                $jadwal = $this->mjadwal->ambilJadwalDariIdJadwal($id_jadwal);
                $currentDateTime = new \DateTime();

                $ujianSelesai = new \DateTime($jadwal['tanggal'] . ' ' . $jadwal['waktu_selesai']);
                $ujianMulai = new \DateTime($jadwal['tanggal'] . ' ' . $jadwal['waktu_mulai']);
                if($currentDateTime <= $ujianMulai){
                    $checking = 0;
                } elseif ($currentDateTime <= $ujianSelesai && $currentDateTime >= $ujianMulai) {
                    $checking = 1;
                } else {
                    $checking = 0;
                }

                if($checking == 1) {
                    if($this->mjadwal->cekJadwalDenganMahasiswa($id_jadwal, $nim)) {
                        $data['mhs'] = $mhs;
                        $data['id_jadwal'] = $id_jadwal;
                        $data['title'] = 'Asesmen';
                        return view('beranda/mahasiswa/halaman_asesmen_awal', $data);
                    } else {
                        $pesan = [
                            'pesan' => 'Jadwal yang anda pilih bukan lah mata kuliah yang anda ambil!',
                            'alert' => 'danger'
                        ];
                        session()->setFlashData('sweet', 'error');
                        session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
                        return redirect()->to(base_url(route_to('beranda.mahasiswa')));
                    }
                } else {
                    $pesan = [
                        'pesan' => 'Jadwal yang anda pilih telah berakhir atau belum dimulai!',
                        'alert' => 'danger'
                    ];
                    session()->setFlashData('sweet', 'error');
                    session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
                    return redirect()->to(base_url(route_to('beranda.mahasiswa')))->with('pesan', $pesan);
                }
            }
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
    public function halamanAsesmen($id_jadwal)
    {
        if(session()->get('role') === 'mahasiswa') {
            $nama_pengguna = session()->get('nama_pengguna');
            $mhs = $this->mmhs->ambilDataMahasiswa($nama_pengguna);
            $nim = $mhs['nim'];
            $total_soal = $this->msoal->hitungSoalDariJadwal($id_jadwal);
            $sesi_sekarang = $this->msesi->ambilSesiDariJadwal($id_jadwal);
            $jadwal = $this->mjadwal->ambilJadwalDariIdJadwal($id_jadwal);

            if(!session()->get('acak_soal') && !session()->get('acak_pilihan') && !session()->get('id_jadwal')) {
                $soal_sekarang = $this->msoal->ambilSoalDariJadwal($id_jadwal);
                $pilihan_sekarang = $this->mpilihan->findAll();
                shuffle($soal_sekarang);
                shuffle($pilihan_sekarang);
                session()->set('id_jadwal', $id_jadwal);
                session()->set('acak_soal', $soal_sekarang);
                session()->set('acak_pilihan', $pilihan_sekarang);
            } elseif(session()->get('id_jadwal') != $id_jadwal) {
                session()->remove('acak_pilihan');
                session()->remove('acak_soal');

                $soal_sekarang = $this->msoal->ambilSoalDariJadwal($id_jadwal);
                $pilihan_sekarang = $this->mpilihan->findAll();
                shuffle($soal_sekarang);
                shuffle($pilihan_sekarang);
                session()->set('id_jadwal', $id_jadwal);
                session()->set('acak_soal', $soal_sekarang);
                session()->set('acak_pilihan', $pilihan_sekarang);
            } else {
                $soal_sekarang = session()->get('acak_soal');
                $pilihan_sekarang = session()->get('acak_pilihan');
            }

            $currentDateTime = new \DateTime();

            $ujianSelesai = new \DateTime($jadwal['tanggal'] . ' ' . $jadwal['waktu_selesai']);
            $ujianMulai = new \DateTime($jadwal['tanggal'] . ' ' . $jadwal['waktu_mulai']);
            if($currentDateTime <= $ujianMulai){
                $checking = 0;
            } elseif ($currentDateTime <= $ujianSelesai && $currentDateTime >= $ujianMulai) {
                $checking = 1;
            } else {
                $checking = 0;
            }

            if($this->mjadwal->cekJadwalDenganMahasiswa($id_jadwal, $nim)) {
                if($checking == 1) {
                    $data['title'] = 'Pengerjaan Asesmen';
                    $data['mhs'] = $mhs;
                    $data['total_soal'] = $total_soal;
                    $data['jadwal'] = $jadwal;
                    $data['sesi_sekarang'] = $sesi_sekarang;
                    $data['soal_sekarang'] = $soal_sekarang;
                    $data['pilihan_sekarang'] = $pilihan_sekarang;
                    return view('beranda/mahasiswa/mengerjakan_asesmen', $data);
                } else {
                    $pesan = [
                        'pesan' => 'Jadwal yang anda pilih telah berakhir atau belum dimulai!',
                        'alert' => 'danger'
                    ];
                    session()->setFlashData('sweet', 'error');
                    session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
                    return redirect()->to(base_url(route_to('beranda.mahasiswa')))->with('pesan', $pesan);
                }
            } else {
                $pesan = [
                    'pesan' => 'Jadwal yang anda pilih bukan lah mata kuliah yang anda ambil!',
                    'alert' => 'danger'
                ];
                session()->setFlashData('sweet', 'error');
                session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
                return redirect()->to(base_url(route_to('beranda.mahasiswa')))->with('pesan', $pesan);
            }
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
    public function tambahSoal($id_sesi)
    {
        $validationRules = [
            'soal' => 'required',
            'poin' => 'required|numeric|max_length[10]',
            'pilihan' => 'required',
            'pilihan_benar' => 'required|max_length[100]',
            'pilihan.*' => 'required|max_length[100]'
        ];

        if(!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan');
            return redirect()->back()->with('gagal', $gagal);
        }

        $soal = esc($this->request->getPost('soal'));
        $poin = esc($this->request->getPost('poin'));
        $pilihan = esc($this->request->getPost('pilihan'));
        $pilihan_benar = esc($this->request->getPost('pilihan_benar'));

        $data_soal = [
            'soal' => $soal,
            'poin' => $poin,
            'id_sesi' => $id_sesi
        ];

        $idSoal = $this->msoal->insert($data_soal);
        if($this->db->affectedRows() == 0) {
            $pesan = [
                'pesan' => 'Soal Ujian gagal ditambahkan!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $data_pilihan_benar = [
                'ktrngan_pilihan' => $pilihan_benar,
                'benar_salah' => 'Benar',
                'id_soal' => $idSoal
            ];
            $this->mpilihan->insert($data_pilihan_benar);
            if($this->db->affectedRows() == 0) {
                $pesan = [
                    'pesan' => 'Pilihan gagal ditambahkan!',
                    'alert' => 'danger'
                ];
                session()->setFlashData('sweet', 'error');
                session()->setFlashData('sweet_text', 'Permintaan Gagal!');
                return redirect()->back()->with('pesan', $pesan);
            } else {
                foreach($pilihan as $pil) {
                    $data_pilihan = [
                        'ktrngan_pilihan' => $pil,
                        'benar_salah' => 'Salah',
                        'id_soal' => $idSoal
                    ];
                    $this->mpilihan->insert($data_pilihan);
                }
                if($this->db->affectedRows() == 0) {
                    $pesan = [
                        'pesan' => 'Pilihan gagal ditambahkan!',
                        'alert' => 'danger'
                    ];
                    session()->setFlashData('sweet', 'error');
                    session()->setFlashData('sweet_text', 'Permintaan Gagal!');
                    return redirect()->back()->with('pesan', $pesan);
                } else {
                    $pesan = [
                        'pesan' => 'Soal ujian dan pilihan berhasil ditambahkan!',
                        'alert' => 'success'
                    ];
                    session()->setFlashData('sweet', 'success');
                    session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
                    return redirect()->back()->with('pesan', $pesan);
                }
            }
        }
    }
    public function ubahSoal($id_soal)
    {
        $validationRules = [
            'soal' => 'required',
            'poin' => 'required|numeric|max_length[10]',
            'pilihan' => 'required',
            'pilihan_benar' => 'required|max_length[100]',
            'pilihan.*' => 'required|max_length[100]'
        ];

        if(!$this->validate($validationRules)) {
            $gagal = $this->validator->getErrors();
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan');
            return redirect()->back()->with('gagal', $gagal);
        }

        $soal = esc($this->request->getPost('soal'));
        $poin = esc($this->request->getPost('poin'));
        $pilihan = esc($this->request->getPost('pilihan'));
        $pilihan_benar = esc($this->request->getPost('pilihan_benar'));
        $id_pilihan_benar = esc($this->request->getPost('id_pilihan_benar'));
        $id_pilihan_salah = esc($this->request->getPost('id_pilihan_salah'));

        $data_soal = [
            'soal' => $soal,
            'poin' => $poin,
            'id_soal' => $id_soal
        ];

        $ubahSoal = $this->msoal->save($data_soal);
        if(!$ubahSoal) {
            $pesan = [
                'pesan' => 'Soal Ujian gagal diubah!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->back()->with('pesan', $pesan);
        } else {
            $data_pilihan_benar = [
                'ktrngan_pilihan' => $pilihan_benar,
                'benar_salah' => 'Benar',
                'id_pilihan' => $id_pilihan_benar
            ];
            $ubahPilihanBenar = $this->mpilihan->save($data_pilihan_benar);
            if(!$ubahPilihanBenar) {
                $pesan = [
                    'pesan' => 'Pilihan gagal diubah!',
                    'alert' => 'danger'
                ];
                session()->setFlashData('sweet', 'error');
                session()->setFlashData('sweet_text', 'Permintaan Gagal!');
                return redirect()->back()->with('pesan', $pesan);
            } else {
                foreach($pilihan as $index => $pil) {
                    $data_pilihan = [
                        'ktrngan_pilihan' => $pil,
                        'benar_salah' => 'Salah',
                        'id_pilihan' => $id_pilihan_salah[$index]
                    ];
                    $ubahPilihanSalah = $this->mpilihan->save($data_pilihan);
                }
                if(!$ubahPilihanSalah) {
                    $pesan = [
                        'pesan' => 'Pilihan gagal diubah!',
                        'alert' => 'danger'
                    ];
                    session()->setFlashData('sweet', 'error');
                    session()->setFlashData('sweet_text', 'Permintaan Gagal!');
                    return redirect()->back()->with('pesan', $pesan);
                } else {
                    $pesan = [
                        'pesan' => 'Soal ujian dan pilihan berhasil diubah!',
                        'alert' => 'success'
                    ];
                    session()->setFlashData('sweet', 'success');
                    session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
                    return redirect()->back()->with('pesan', $pesan);
                }
            }
        }
    }
    public function hapusSoal($id_soal)
    {
        if($id_soal && $this->msoal->find($id_soal)) {
            if($this->msoal->delete($id_soal)) {
                $pesan = [
                    'pesan' => 'Soal ujian berhasil dihapus!',
                    'alert' => 'success'
                ];
                session()->setFlashData('sweet', 'success');
                session()->setFlashData('sweet_text', 'Permintaan Berhasil!');
                return redirect()->back()->with('pesan', $pesan);
            } else {
                $pesan = [
                    'pesan' => 'Soal ujian gagal dihapus!',
                    'alert' => 'danger'
                ];
                session()->setFlashData('sweet', 'error');
                session()->setFlashData('sweet_text', 'Permintaan Gagal!');
                return redirect()->back()->with('pesan', $pesan);
            }
        } else {
            $pesan = [
                'pesan' => 'Sal ujian tidak dipilih atau tidak ada!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Terjadi Kesalahan!');
            return redirect()->back()->with('pesan', $pesan);
        }
    }
}
