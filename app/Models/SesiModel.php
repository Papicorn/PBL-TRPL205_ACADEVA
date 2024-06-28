<?php

namespace App\Models;

use CodeIgniter\Model;

class SesiModel extends Model
{
    protected $table = 'sesi';
    protected $primaryKey = 'id_sesi';
    protected $protectFields = true;
    protected $allowedFields = ['nama_sesi', 'keterangan_sesi', 'passing_grade', 'id_jadwal'];
    public function ambilSesiPengampuJoinMatkul($nidn)
    {
        $data = $this->db->table($this->table)
            ->select('sesi.*, matakuliah.nama_matkul, kelas.nama_kelas, matakuliah.kode_matkul, COUNT(soal_ujian.id_soal) as jumlah_soal')
            ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal = sesi.id_jadwal')
            ->join('matakuliah', 'matakuliah.kode_matkul = jadwal_ujian.kode_matkul')
            ->join('kelas', 'kelas.id_kelas = jadwal_ujian.id_kelas')
            ->join('soal_ujian', 'soal_ujian.id_sesi = sesi.id_sesi', 'left')
            ->where('matakuliah.nidn', $nidn)
            ->groupBy('sesi.id_sesi')
            ->orderBy('matakuliah.nama_matkul', 'ASC')
            ->orderBy('kelas.nama_kelas', 'ASC')
            ->get()
            ->getResultArray();
            
        return $data;
    }
    public function ambilSesiDariId($id_sesi)
    {
        $data = $this->db->table($this->table)
            ->where('id_sesi', $id_sesi)
            ->get()
            ->getRowArray();

        return $data;
    }
    public function ambilSesiDariJadwal($id_jadwal)
    {
        $data = $this->db->table($this->table)
                    ->where('id_jadwal', $id_jadwal)
                    ->get()
                    ->getResultArray();
        
        return $data;
    }
}
