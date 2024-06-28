<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalUjianModel extends Model
{
    protected $table            = 'soal_ujian';
    protected $primaryKey       = 'id_soal';
    protected $protectFields    = true;
    protected $allowedFields    = ['soal', 'poin', 'id_sesi'];
    public function ambilSoalPengampu($nidn)
    {
        $data = $this->db->table($this->table)
                    ->select('soal_ujian.*, jadwal_ujian.tanggal, pilihan_jwb.ktrngan_pilihan, pilihan_jwb.benar_salah, sesi.nama_sesi, matakuliah.nama_matkul, matakuliah.kode_matkul')
                    ->join('sesi', 'sesi.id_sesi = soal_ujian.id_sesi')
                    ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal = sesi.id_jadwal')
                    ->join('matakuliah', 'matakuliah.kode_matkul = jadwal_ujian.kode_matkul')
                    ->join('pilihan_jwb', 'pilihan_jwb.id_soal = soal_ujian.id_soal')
                    ->where('matakuliah.nidn', $nidn)
                    ->get()
                    ->getResultArray();
        return $data;
    }
    public function ambilSoalDariIdSesi($id_sesi)
    {
        $data = $this->db->table($this->table)
                    ->select('soal_ujian.*, sesi.nama_sesi')
                    ->join('sesi', 'sesi.id_sesi = soal_ujian.id_sesi')
                    ->where('soal_ujian.id_sesi', $id_sesi)
                    ->orderBy('soal_ujian.id_soal', 'ASC')
                    ->get()
                    ->getResultArray();
        return $data;
    }
    public function jumlahSoalDariSesi($id_sesi)
    {
        $data = $this->db->table($this->table)
                    ->where('id_sesi', $id_sesi)
                    ->countAllResults();
        return $data;
    }
    public function jumlahPoinDariSesi($id_sesi)
    {
        $data = $this->db->table($this->table)
                    ->selectSum('poin')
                    ->where('id_sesi', $id_sesi)
                    ->get()
                    ->getRow()->poin;
        return $data;
    }
    public function hitungSoalDariJadwal($id_jadwal)
    {
        $data = $this->db->table($this->table)
                    ->select('soal_ujian.*')
                    ->join('sesi', 'sesi.id_sesi = soal_ujian.id_sesi')
                    ->where('sesi.id_jadwal', $id_jadwal)
                    ->countAllResults();
        return $data;
    }
    public function ambilSoalDariJadwal($id_jadwal)
    {
        $data = $this->db->table($this->table)
                    ->select('soal_ujian.*')
                    ->join('sesi', 'sesi.id_sesi = soal_ujian.id_sesi')
                    ->where('sesi.id_jadwal', $id_jadwal)
                    ->get()
                    ->getResultArray();
        return $data;
    }

}
