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
                        ->orderBy('tanggal', 'ASC')
                        ->orderBy('waktu_mulai', 'ASC')
                        ->get()
                        ->getResultArray();

        return $tabel;
    }
}
