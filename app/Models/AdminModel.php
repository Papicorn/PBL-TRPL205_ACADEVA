<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;

    public function ambilDataAdmin($email)
    {
        $admin = $this->db->table($this->table)
                    ->where('email', $email)
                    ->get()
                    ->getRowArray();

        return $admin;
    }

}
