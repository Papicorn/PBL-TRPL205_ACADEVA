<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapitulasiModel extends Model
{
    protected $table            = 'rekapitulasi';
    protected $primaryKey       = 'id_rekapitulasi';
    protected $protectFields    = true;
    protected $allowedFields    = ['total_nilai', 'nim', 'id_sesi', 'kode_matkul'];
    public function ambilRekapDariMatkul($nidn)
    {
        $data = $this->db->table($this->table)
                    ->select('matakuliah.nama_matkul, COUNT(rekapitulasi.id_rekapitulasi) AS jumlah_data')
                    ->join('matakuliah', 'matakuliah.kode_matkul = rekapitulasi.kode_matkul')
                    ->where('matakuliah.nidn', $nidn)
                    ->groupBy('matakuliah.nama_matkul, rekapitulasi.kode_matkul')
                    ->get()
                    ->getResultArray();

        $result = array();
        foreach ($data as $row) {
            $result[$row['nama_matkul']] = $row['jumlah_data'];
        }

        return $result;
    }
    public function dataRekapitulasi($nidn)
    {
        $data = $this->db->table($this->table)
                    ->select('rekapitulasi.*, mahasiswa.nama_lengkap, sesi.nama_sesi, sesi.passing_grade, matakuliah.nama_matkul, kelas.nama_kelas')
                    ->join('mahasiswa', 'mahasiswa.nim = rekapitulasi.nim')
                    ->join('kelas', 'kelas.id_kelas = mahasiswa.id_kelas')
                    ->join('sesi', 'sesi.id_sesi = rekapitulasi.id_sesi')
                    ->join('matakuliah', 'matakuliah.kode_matkul = rekapitulasi.kode_matkul')
                    ->where('matakuliah.nidn', $nidn)
                    ->orderBy('mahasiswa.nim', 'ASC')
                    ->orderBy('kelas.nama_kelas', 'ASC')
                    ->orderBy('matakuliah.nama_matkul', 'ASC')
                    ->orderBy('sesi.nama_sesi', 'ASC')
                    ->get()
                    ->getResultArray();
        return $data;
    }
    public function rekapMahasiswa($nim, $kode_matkul)
    {
        // Query untuk mendapatkan data rekapitulasi
        $data = $this->db->table($this->table)
                    ->select('matakuliah.kode_matkul, matakuliah.nama_matkul, rekapitulasi.id_sesi, sesi.nama_sesi, sesi.passing_grade, rekapitulasi.total_nilai')
                    ->join('matakuliah', 'matakuliah.kode_matkul = rekapitulasi.kode_matkul')
                    ->join('sesi', 'sesi.id_sesi = rekapitulasi.id_sesi')
                    ->where('rekapitulasi.nim', $nim)
                    ->where('rekapitulasi.kode_matkul', $kode_matkul)
                    ->orderBy('sesi.id_sesi', 'ASC')
                    ->get()
                    ->getResultArray();

        // Query untuk menghitung total nilai keseluruhan
        $totalNilai = $this->db->table($this->table)
                    ->selectSum('rekapitulasi.total_nilai', 'keseluruhan')
                    ->where('rekapitulasi.nim', $nim)
                    ->where('rekapitulasi.kode_matkul', $kode_matkul)
                    ->get()
                    ->getRow()
                    ->keseluruhan;

        return ['data' => $data, 'keseluruhan' => $totalNilai];
    }
    public function hasilAsesmenMahasiswa($nim)
    {
        $data = $this->db->table($this->table)
                    ->select('rekapitulasi.*, jadwal_ujian.id_jadwal, matakuliah.nama_matkul, jadwal_ujian.tanggal, jadwal_ujian.waktu_mulai, SUM(rekapitulasi.total_nilai) as keseluruhan')
                    ->join('matakuliah', 'matakuliah.kode_matkul = rekapitulasi.kode_matkul')
                    ->join('sesi', 'sesi.id_sesi = rekapitulasi.id_sesi')
                    ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal = sesi.id_jadwal')
                    ->where('rekapitulasi.nim', $nim)
                    ->groupBy('jadwal_ujian.id_jadwal')
                    ->orderBy('keseluruhan', 'DESC')
                    ->get()
                    ->getResultArray();
        
        return $data;
    }
    public function nilaiRataRata($nim)
    {
        $data = $this->db->table($this->table)
                    ->selectAvg('rekapitulasi.total_nilai', 'rata_rata')
                    ->where('rekapitulasi.nim', $nim)
                    ->get()
                    ->getRow()
                    ->rata_rata;

        return $data;
    }
    public function hitungUjianDiikuti($nim)
    {
        $data = $this->db->table($this->table)
                    ->select('rekapitulasi.*')
                    ->join('sesi', 'sesi.id_sesi = rekapitulasi.id_sesi')
                    ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal = sesi.id_jadwal')
                    ->where('nim', $nim)
                    ->groupBy('jadwal_ujian.id_jadwal')
                    ->countAllResults();
        return $data;
    }
    public function cekAmbilSudahMengerjakan($nim, $id_jadwal)
    {
        $data = $this->db->table($this->table)
                    ->select('rekapitulasi.id_rekapitulasi')
                    ->join('sesi', 'sesi.id_sesi = rekapitulasi.id_sesi')
                    ->where('rekapitulasi.nim', $nim)
                    ->where('sesi.id_jadwal', $id_jadwal)
                    ->get()
                    ->getFirstRow();
        return $data;
    }

}

