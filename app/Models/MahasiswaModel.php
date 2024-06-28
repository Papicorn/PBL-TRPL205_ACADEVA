<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'nim';
    protected $protectFields    = true;
    protected $allowedFields    = ['nim','nama_pengguna','email','nama_lengkap','kata_sandi','alamat','no_telpon','tanggal_lahir','id_kelas','kelamin','semester'];

    public function ambilDataMahasiswa($nama_pengguna)
    {
        $data = $this->db->table($this->table)
                ->where('nama_pengguna', $nama_pengguna)
                ->get()
                ->getRowArray();

        return $data;
    }
    public function ambilMhsJoinKelasJoinProdi()
    {
        $data = $this->db->table($this->table)
                    ->select('mahasiswa.*, kelas.nama_kelas, prodi.kode_prodi')
                    ->join('kelas', 'kelas.id_kelas = mahasiswa.id_kelas')
                    ->join('prodi', 'prodi.kode_prodi = kelas.kode_prodi')
                    ->get()
                    ->getResultArray();

        return $data;
    }
    public function dataMhsKelasProdi($nim)
    {
        $data = $this->db->table($this->table)
                    ->select('mahasiswa.*, kelas.nama_kelas, prodi.nama_prodi')
                    ->join('kelas', 'kelas.id_kelas = mahasiswa.id_kelas')
                    ->join('prodi', 'prodi.kode_prodi = kelas.kode_prodi')
                    ->where('mahasiswa.nim', $nim)
                    ->get()
                    ->getRowArray();
        return $data;
    }
    public function ambilMhsDiampuDosen($nidn)
    {
        $data = $this->db->table($this->table)
                    ->select('mahasiswa.*')
                    ->join('rekapitulasi', 'rekapitulasi.nim = mahasiswa.nim')
                    ->join('matakuliah', 'matakuliah.kode_matkul = rekapitulasi.kode_matkul')
                    ->where('matakuliah.nidn', $nidn)
                    ->groupBy('mahasiswa.nim')
                    ->get()
                    ->getResultArray();
        return $data;
    }
}
