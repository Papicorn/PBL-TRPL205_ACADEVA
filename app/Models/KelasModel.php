<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'id_kelas';
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_kelas', 'kode_prodi'];
    public function ambilKelasDariNamaKelas($kelas)
    {
        $data = $this->db->table($this->table)
                    ->where('nama_kelas', $kelas)
                    ->get()
                    ->getRowArray();

        return $data;
    }
    public function ambilKelasJoinProdi()
    {
        $data = $this->db->table($this->table)
                    ->select('kelas.*, prodi.nama_prodi')
                    ->join('prodi', 'prodi.kode_prodi = kelas.kode_prodi')
                    ->get()
                    ->getResultArray();
        return $data;
    }
}
