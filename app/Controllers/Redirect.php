<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Redirect extends BaseController
{
    public function home()
    {
        return redirect()->to(base_url("/home"));
    }
}
