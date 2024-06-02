<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MatakuliahModel;
use App\Models\KelasModel;

class AjaxController extends BaseController
{
    protected $mmatkul;
    protected $mkelas;
    public function __construct()
    {
        $this->mmatkul = new MatakuliahModel();
        $this->mkelas = new KelasModel();
    }
    public function ambilMatkulProdi()
    {
        if ($this->request->isAJAX()) {
            $kode_prodi = $this->request->getPost('kode_prodi');
            $matkul = $this->mmatkul->where('kode_prodi', $kode_prodi)->findAll();

            return $this->response->setJSON(['options' => $matkul]);
        }

        return $this->response->setStatusCode(403)->setBody('Forbidden');
    }
    public function ambilKelasProdi()
    {
        if ($this->request->isAJAX()) {
            $kode_prodi = $this->request->getPost('kode_prodi');
            $kelas = $this->mkelas->where('kode_prodi', $kode_prodi)->findAll();

            return $this->response->setJSON(['options' => $kelas]);
        }

        return $this->response->setStatusCode(403)->setBody('Forbidden');
    }
}
