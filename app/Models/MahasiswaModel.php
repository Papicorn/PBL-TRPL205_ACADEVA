<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'nim';
    protected $protectFields    = true;

    public function ambilDataMahasiswa($nama_pengguna)
    {
        $data = $this->db->table($this->table)
                ->where('nama_pengguna', $nama_pengguna)
                ->get()
                ->getRowArray();

        return $data;
    }

}
