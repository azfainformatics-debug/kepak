<?php

namespace App\Controllers\Web;

use CodeIgniter\Controller;

class WireframeController extends Controller
{
    public function index()
    {
        return view('wireframes/dashboard');
    }
}
