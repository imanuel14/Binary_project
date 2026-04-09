<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChurchProfile;

class ChurchProfileSeeder extends Seeder
{
    public function run(): void
    {
        ChurchProfile::create([
            'church_name' => 'Yayasan Mutiara Kasih Karunia',
            'vision' => 'Menjadi gereja yang berdampak bagi kemuliaan Tuhan dan menjadi berkat bagi sesama.',
            'mission' => "1. Membangun iman jemaat melalui firman Tuhan\n2. Melayani sesama dengan kasih Kristus\n3. Mengembangkan potensi jemaat untuk pelayanan\n4. Menjadi saksi Kristus di tengah masyarakat",
            'history' => "Yayasan Mutiara Kasih Karuniadidirikan pada tahun 1950 oleh sekelompok hamba Tuhan yang memiliki visi untuk membawa kabar baik ke seluruh pelosok negeri.\n\nDengan bermodalkan iman dan tekad yang kuat, gereja ini mulai berkembang dari sebuah rumah pertemuan sederhana menjadi sebuah gereja yang memiliki gedung sendiri dan melayani ribuan jemaat.\n\nSeiring berjalannya waktu, gereja ini terus berkembang dan meluncurkan berbagai program pelayanan termasuk program pendidikan, sosial, dan pembinaan jemaat.",
            'address' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220',
            'phone' => '(021) 1234-5678',
            'email' => 'info@gerejakristen.id',
            'pastor_name' => 'Pdt. Dr. Johannes Wibowo, M.Th'
        ]);
    }
}