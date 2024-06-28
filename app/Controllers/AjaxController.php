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
    public function simpanJawabanMahasiswa()
    {
            $soal_id = $this->request->getPost('soal_id');
            $pilihan_id = $this->request->getPost('pilihan_id');

            // Pastikan data yang diterima valid
            if($soal_id && $pilihan_id) {
                // Simpan jawaban ke dalam sesi
                $jawaban = session()->get('jawaban') ?? [];
                $jawaban[$soal_id] = $pilihan_id;
                session()->set('jawaban', $jawaban);

                return $this->response->setStatusCode(200);
            } else {
                // Jika data tidak valid, kirim respon error
                return $this->response->setStatusCode(400);
            }
    }
}
