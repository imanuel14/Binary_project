<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class JemaatController extends Controller
{
    public function index()
    {
        return view('admin.jemaat.index');
    }
}