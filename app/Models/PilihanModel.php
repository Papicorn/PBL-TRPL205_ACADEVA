<?php

namespace App\Models;

use CodeIgniter\Model;

class PilihanModel extends Model
{
    protected $table            = 'pilihan_jwb';
    protected $primaryKey       = 'id_pilihan';
    protected $protectFields    = true;
    protected $allowedFields    = ['ktrngan_pilihan', 'id_soal', 'benar_salah'];
    public function ambilPilihanUbah()
    {
        $data = $this->db->table($this->table)
                    ->orderBy('benar_salah', 'ASC')
                    ->get()
                    ->getResultArray();
        return $data;
    }
}
