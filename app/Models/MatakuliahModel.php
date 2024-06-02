<?php

namespace App\Models;

use CodeIgniter\Model;

class MatakuliahModel extends Model
{
    protected $table            = 'matakuliah';
    protected $primaryKey       = 'kode_matkul';
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_matkul', 'nama_matkul', 'nidn', 'kode_prodi'];
    public function ambilMatkulJoinDosenProdi()
    {
        $data = $this->db->table($this->table)
                    ->select('matakuliah.*, prodi.nama_prodi, dosen.nama_lengkap')
                    ->join('dosen', 'dosen.nidn = matakuliah.nidn')
                    ->join('prodi', 'prodi.kode_prodi = matakuliah.kode_prodi')
                    ->get()
                    ->getResultArray();
        return $data;
    }
    // public function insertAndCheck($data)
    // {
    //     $this->insert($data);
    //     return $this->db->affectedRows();
    // }
}
