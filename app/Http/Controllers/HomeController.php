<?php

namespace App\Http\Controllers;

use App\Models\ChurchProfile;
use App\Models\Program;
use App\Models\Gallery;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
{
    // Mengambil SEMUA program dan diurutkan dari yang terbaru diinput
    $upcomingPrograms = Program::orderBy('created_at', 'desc')->get();
    
    // Jika tetap ingin memisah berdasarkan kategori (pastikan scope sudah ada di Model)
    $ibadahPrograms = Program::ibadah()->get();
    $pendidikanPrograms = Program::pendidikan()->get();
    // TAMBAHKAN INI: Mengambil data galeri terbaru
    $galleries = Gallery::latest()->get();
    
    return view('home', compact('upcomingPrograms', 'ibadahPrograms', 'pendidikanPrograms', 'galleries'));
}
}