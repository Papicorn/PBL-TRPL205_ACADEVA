<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalUjianModel extends Model
{
    protected $table            = 'jadwal_ujian';
    protected $primaryKey       = 'id_jadwal';
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_matkul','id_kelas','tanggal','waktu_mulai','waktu_selesai'];

    public function joinJadwalMatkulKelasProdi(){
        $tabel = $this->select('jadwal_ujian.*, matakuliah.kode_matkul, matakuliah.nama_matkul, matakuliah.nidn, kelas.nama_kelas, prodi.kode_prodi')
                        ->join('matakuliah', 'matakuliah.kode_matkul = jadwal_ujian.kode_matkul')
                        ->join('kelas', 'kelas.id_kelas = jadwal_ujian.id_kelas')
                        ->join('prodi', 'prodi.kode_prodi = kelas.kode_prodi')
                        ->orderBy('jadwal_ujian.tanggal', 'DESC')
                        ->orderBy('jadwal_ujian.waktu_mulai', 'DESC')
                        ->get()
                        ->getResultArray();

        return $tabel;
    }
    public function ambilJadwalPengampu($nidn)
    {
        $data = $this->db->table($this->table)
                    ->select('jadwal_ujian.*, matakuliah.nama_matkul, kelas.nama_kelas')
                    ->join('matakuliah', 'matakuliah.kode_matkul = jadwal_ujian.kode_matkul')
                    ->join('kelas', 'kelas.id_kelas = jadwal_ujian.id_kelas')
                    ->where('matakuliah.nidn', $nidn)
                    ->get()
                    ->getResultArray();
        return $data;
    }
    public function ambilJadwalDariKelas($id_kelas)
    {
        $data = $this->db->table($this->table)
                    ->select('jadwal_ujian.*, kelas.nama_kelas, matakuliah.nama_matkul')
                    ->join('kelas', 'kelas.id_kelas = jadwal_ujian.id_kelas')
                    ->join('matakuliah', 'matakuliah.kode_matkul = jadwal_ujian.kode_matkul')
                    ->where('jadwal_ujian.id_kelas', $id_kelas)
                    ->orderBy('jadwal_ujian.tanggal', 'DESC')
                    ->orderBy('jadwal_ujian.waktu_mulai', 'DESC')
                    ->get()
                    ->getResultArray();
        return $data;
    }
    public function ambilJadwalDariIdJadwal($id_jadwal)
    {
        $data = $this->db->table($this->table)
                    ->select('jadwal_ujian.*, matakuliah.nama_matkul')
                    ->join('matakuliah', 'matakuliah.kode_matkul = jadwal_ujian.kode_matkul')
                    ->where('id_jadwal', $id_jadwal)
                    ->get()
                    ->getRowArray();
        return $data;
    }
    public function cekJadwalDenganMahasiswa($id_jadwal, $nim)
    {
        $data = $this->db->table($this->table)
                    ->select('jadwal_ujian.*')
                    ->join('kelas', 'kelas.id_kelas = jadwal_ujian.id_kelas')
                    ->join('mahasiswa', 'mahasiswa.id_kelas = kelas.id_kelas')
                    ->where('mahasiswa.nim', $nim )
                    ->where('jadwal_ujian.id_jadwal', $id_jadwal)
                    ->get()
                    ->getRow();
        return $data;
    }
}