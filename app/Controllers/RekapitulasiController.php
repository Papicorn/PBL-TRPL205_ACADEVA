<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RekapitulasiModel;
use App\Models\MatakuliahModel;
use App\Models\MahasiswaModel;
use App\Models\KelasModel;
use App\Models\JadwalUjianModel;
use App\Models\ProdiModel;
use App\Models\SesiModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;

class RekapitulasiController extends BaseController
{
    protected $mdosen;
    protected $msesi;
    protected $mmhs;
    protected $mjadwal;
    protected $mkelas;
    protected $mprodi;
    protected $mmatkul;
    protected $mrekap;
    protected $db;
    public function __construct()
    {
        helper(['persentase_poin']);
        $this->db = \Config\Database::connect();
        $this->mdosen =  new DosenModel();
        $this->mjadwal =  new JadwalUjianModel();
        $this->msesi =  new SesiModel();
        $this->mprodi =  new ProdiModel();
        $this->mkelas =  new KelasModel();
        $this->mmhs =  new MahasiswaModel();
        $this->mmatkul =  new MatakuliahModel();
        $this->mrekap =  new RekapitulasiModel();
    }
    public function halamanRekapitulasi()
    {
        if(session()->get('role') === "dosen") {
            $nama_pengguna = session()->get('nama_pengguna');
            $dosen = $this->mdosen->ambilDataDosen($nama_pengguna);
            $nidn = $dosen['nidn'];
            $data_rekap = $this->mrekap->dataRekapitulasi($nidn);
            $rekap_diampu = $this->mrekap->ambilRekapDariMatkul($nidn);
            $matkul_diampu = $this->mmatkul->ambilMatkulDariDiampu($nidn);
            $mahasiswa_diampu = $this->mmhs->ambilMhsDiampuDosen($nidn);

            $data['dosen'] = $dosen;
            $data['mahasiswa_diampu'] = $mahasiswa_diampu;
            $data['rekap_diampu'] = $rekap_diampu;
            $data['matkul_diampu'] = $matkul_diampu;
            $data['data_rekap'] = $data_rekap;
            $data['title'] = 'Rekapitulasi';
            return view('beranda/dosen/rekapitulasi', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
    public function halamanHasilAsesmen()
    {
        if(session()->get('role') === "mahasiswa") {
            $nama_pengguna = session()->get('nama_pengguna');
            $mhs = $this->mmhs->ambilDataMahasiswa($nama_pengguna);
            $hasil_asesmen = $this->mrekap->hasilAsesmenMahasiswa($mhs['nim']);
            $sesi = $this->msesi->findAll();

            $data['hasil_asesmen'] = $hasil_asesmen;
            $data['sesi'] = $sesi;
            $data['mhs'] = $mhs;
            $data['title'] = 'Hasil Asesmen';
            return view('beranda/mahasiswa/hasil_asesmen', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
    public function cetakMahasiswa()
    {
        if (session()->get('role') === "dosen") {
            try {
                // Set up Dompdf options
                $options = new Options();
                $options->set('defaultFont', 'Times-Roman');
                $dompdf = new Dompdf($options);

                // HTML content for the PDF
                $nim = esc($this->request->getPost('nim'));
                $kode_matkul = esc($this->request->getPost('kode_matkul'));
                $rekap_mahasiswa = $this->mrekap->rekapMahasiswa($nim, $kode_matkul);
                $data_mhs = $this->mmhs->dataMhsKelasProdi($nim);

                $html = '<h1 style="text-align:center;">Rekapitulasi Mahasiswa</h1>
                    <p><font style="font-weight:bold;">Nama: </font>' . $data_mhs['nama_lengkap'] . '</p>
                    <p><font style="font-weight:bold;">NIM: </font>' . $data_mhs['nim'] . '</p>
                    <p><font style="font-weight:bold;">Kelas: </font>' . $data_mhs['nama_kelas'] . '</p>
                    <p><font style="font-weight:bold;">Program Studi: </font>' . $data_mhs['nama_prodi'] . '</p>
                    <h2 style="text-align:center;">Tabel Nilai</h2>';

                $html .= '<table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black; padding: 5px; text-align: center;">Kode</th>
                                <th style="border: 1px solid black; padding: 5px; text-align: center;">Matakuliah</th>
                                <th style="border: 1px solid black; padding: 5px; text-align: center;">Sesi</th>
                                <th style="border: 1px solid black; padding: 5px; text-align: center;">Total Nilai</th>
                                <th style="border: 1px solid black; padding: 5px; text-align: center;">Passing Grade</th>
                            </tr>
                        </thead>
                        <tbody>';

                foreach ($rekap_mahasiswa['data'] as $item) {
                    $html .= '<tr>
                            <td style="border: 1px solid black; padding: 5px; text-align: center;">' . $item['kode_matkul'] . '</td>
                            <td style="border: 1px solid black; padding: 5px; text-align: center;">' . $item['nama_matkul'] . '</td>
                            <td style="border: 1px solid black; padding: 5px; text-align: center;">' . $item['nama_sesi'] . '</td>
                            <td style="border: 1px solid black; padding: 5px; text-align: center;">' . $item['total_nilai'] . '</td>
                            <td style="border: 1px solid black; padding: 5px; text-align: center;">' . $item['passing_grade'] . '</td>
                        </tr>';
                };

                $html .= '<tr>
                    <td></td>
                    <td></td>
                    <td style="border: 1px solid black; padding: 5px; text-align: center; font-weight: bold;">Keseluruhan:</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: center; font-weight: bold;">' . $rekap_mahasiswa['keseluruhan'] . '</td>
                    <td></td>
                </tr>';

                $html .= '</tbody></table>';

                // Load HTML content into Dompdf
                $dompdf->loadHtml($html);

                // Set paper size and orientation (optional)
                $dompdf->setPaper('A4', 'portrait');

                // Render HTML as PDF
                $dompdf->render();

                // Generate and output PDF
                $dompdf->stream($data_mhs['nim']."_".$data_mhs['nama_lengkap'].".pdf", ["Attachment" => 1]);
            } catch (Exception $e) {
                // Handle any errors that occur during PDF generation
                echo 'Error generating PDF: ' . $e->getMessage();
            }
            exit();
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
    public function kirimAsesmen($id_jadwal)
    {
        if(session()->get('nama_pengguna') === 'demo.1234') {
            $pesan = [
                'pesan' => 'Anda sedang menggunakan akun demo, tidak dapat melakukan perubahan maupun pengiriman. Anda dapat melihat hasil asesmen pada menu hasil asesmen!',
                'alert' => 'danger'
            ];
            session()->setFlashData('sweet', 'error');
            session()->setFlashData('sweet_text', 'Permintaan Gagal!');
            return redirect()->to(base_url(route_to('beranda.mahasiswa')))->with('pesan', $pesan);
        } else {
            if(session()->get('role') === 'mahasiswa') {
                $nama_pengguna = session()->get('nama_pengguna');
                $mhs = $this->mmhs->ambilDataMahasiswa($nama_pengguna);
                $sesi_sekarang = $this->msesi->ambilSesiDariJadwal($id_jadwal);
                $jadwal = $this->mjadwal->ambilJadwalDariIdJadwal($id_jadwal);
                $kode_matkul = $jadwal['kode_matkul'];
    
                // $validationRules = [
    
                // ]
    
                $pilihan = $this->request->getPost('pilihan');
    
                $acak_soal = session()->get('acak_soal');
                $acak_pilihan = session()->get('acak_pilihan');
    
                foreach($sesi_sekarang as $sesi) {
                    $poin = 0;
                    foreach($acak_soal as $soal) {
                        if($soal['id_sesi'] == $sesi['id_sesi']) {
                            $id_soal = $soal['id_soal'];
                            $jawaban_diisi = $pilihan[$id_soal] ?? null;
    
                            foreach($acak_pilihan as $pil) {
                                if($pil['id_soal'] == $id_soal && $pil['id_pilihan'] == $jawaban_diisi && $pil['benar_salah'] === 'Benar') {
                                    $poin += $soal['poin'];
                                }
                            }
                        }
                    }
    
                    $data = [
                        'total_nilai' => $poin,
                        'nim' => $mhs['nim'],
                        'id_sesi' => $sesi['id_sesi'],
                        'kode_matkul' => $kode_matkul
                    ];
    
                    $this->mrekap->insert($data);
                }
                if($this->db->affectedRows() == 0) {
                    $pesan = [
                        'pesan' => 'Gagal mengirimkan asesmen!',
                        'alert' => 'danger'
                    ];
                    session()->setFlashData('sweet', 'error');
                    session()->setFlashData('sweet_text', 'Permintaan gagal!');
                    return redirect()->to(base_url(route_to('beranda.mahasiswa')))->with('pesan', $pesan);
                } else {
                    $pesan = [
                        'pesan' => 'Berhasil mengirimkan asesmen, berikut adalah hasil asesmen anda!',
                        'alert' => 'success'
                    ];
                    session()->setFlashData('sweet', 'success');
                    session()->setFlashData('sweet_text', 'Permintaan berhasil!');
                    session()->remove('jawaban');
                    return redirect()->to(base_url(route_to('setelah.asesmen', $id_jadwal)))->with('pesan', $pesan);
                }
            } else {
                return redirect()->to(base_url('/home'));
            }
        }
    }
    public function setelahAsesmen($id_jadwal) {
        if(session()->get('role') === 'mahasiswa') {
            $nama_pengguna = session()->get('nama_pengguna');
            $mhs = $this->mmhs->ambilDataMahasiswa($nama_pengguna);
            $nim = $mhs['nim'];
            $sesi_sekarang = $this->msesi->ambilSesiDariJadwal($id_jadwal);
            $jadwal = $this->mjadwal->ambilJadwalDariIdJadwal($id_jadwal);
            $kode_matkul = $jadwal['kode_matkul'];
            $matakuliah = $this->mmatkul->find($kode_matkul);
            $rekap = $this->mrekap->rekapMahasiswa($nim, $kode_matkul);

            $total_pg = 0;
            foreach($sesi_sekarang as $sesi) {
                $total_pg = $total_pg + $sesi['passing_grade'];
            };

            $persenPG = calculatePercentage($rekap['keseluruhan'], $total_pg);
            $grade = determineGrade($persenPG);

            $data['mhs'] = $mhs;
            $data['rekapitulasi'] = $rekap['data'];
            $data['grade'] = $grade;
            $data['nilai_seluruh'] = $rekap['keseluruhan'];
            $data['sesi_sekarang'] = $sesi_sekarang;
            $data['nama_matkul'] = $matakuliah['nama_matkul'];
            $data['title'] = 'Rekapitulasi Hasil';
            return view('beranda/mahasiswa/setelah_asesmen', $data);
        } else {
            return redirect()->to(base_url('/home'));
        }
    }
}
