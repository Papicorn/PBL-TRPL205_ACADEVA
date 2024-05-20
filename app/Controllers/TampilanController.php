<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminModel;
use App\Models\MahasiswaModel;
use App\Models\DosenModel;

class TampilanController extends BaseController
{
    public function index()
    {   
        if(session()->get('role') == 'admin'){
            $madmin = new AdminModel();
            $uadmin = $madmin->where('nama_pengguna', session()->get('nama_pengguna'))
                      ->first();
            $data['data'] = $uadmin;
        } elseif(session()->get('role') == 'mahasiswa'){
            $mmhs = new MahasiswaModel();
            $umhs = $mmhs->where('nama_pengguna', session()->get('nama_pengguna'))
                    ->first();
            $data['data'] = $umhs;
        } elseif(session()->get('role') == 'dosen'){
            $mdosen = new DosenModel();
            $udosen = $mdosen->where('nama_pengguna', session()->get('nama_pengguna'))
                    ->first();
            $data['data'] = $udosen;
        };

        $data['title'] = "Home";
        return view('home/home', $data);
        
    }

    public function masuk()
    {
        $data['title'] = 'Masuk';

        if(session()->has('is_logged_in')) {
            return redirect()->to(base_url('/home'));
        } else {
            return view('autentikasi/masuk', $data);
        };
    }

    public function terms()
    {
        if(session()->get('role') == 'admin'){
            $madmin = new AdminModel();
            $uadmin = $madmin->where('nama_pengguna', session()->get('nama_pengguna'))
                      ->first();
            $data['data'] = $uadmin;
        } elseif(session()->get('role') == 'mahasiswa'){
            $mmhs = new MahasiswaModel();
            $umhs = $mmhs->where('nama_pengguna', session()->get('nama_pengguna'))
                    ->first();
            $data['data'] = $umhs;
        } elseif(session()->get('role') == 'dosen'){
            $mdosen = new DosenModel();
            $udosen = $mdosen->where('nama_pengguna', session()->get('nama_pengguna'))
                    ->first();
            $data['data'] = $udosen;
        };
        
        $data['title'] = 'Ketentuan dan Layanan';
        return view('halaman/terms', $data);
    }
}
