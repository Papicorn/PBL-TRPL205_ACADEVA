<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table            = 'dosen';
    protected $primaryKey       = 'nidn';
    protected $protectFields    = true;

    public function ambilDataDosen($nama_pengguna)
    {
        $data = $this->db->table($this->table)
                ->where('nama_pengguna', $nama_pengguna)
                ->get()
                ->getRowArray();

        return $data;
    }

}