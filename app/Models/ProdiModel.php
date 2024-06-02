<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $table            = 'prodi';
    protected $primaryKey       = 'kode_prodi';
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_prodi', 'nama_prodi'];
}
