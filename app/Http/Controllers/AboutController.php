<?php

namespace App\Http\Controllers;

use App\Models\ChurchProfile;
use Illuminate\Routing\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $profile = ChurchProfile::first();
        
        if (!$profile) {
            $profile = new ChurchProfile([
                'church_name' => 'Yayasan Mutiara Kasih Karunia',
                'vision' => 'Menjadi gereja yang berdampak bagi kemuliaan Tuhan.',
                'mission' => "1. Membangun iman jemaat\n2. Melayani sesama",
                'history' => 'Yayasan Mutiara Kasih Karuniaini didirikan dengan visi mulia.',
                'address' => 'Jl. Gereja No. 1',
                'phone' => '08123456789',
                'email' => 'info@gereja.com',
                'pastor_name' => 'Pdt. Contoh Nama'
            ]);
        }
        
        return view('about', compact('profile'));
    }
}