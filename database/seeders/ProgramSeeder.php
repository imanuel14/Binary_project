<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        // Program Ibadah
        Program::create([
            'title' => 'Ibadah Minggu Pagi',
            'description' => 'Ibadah minggu pagi dengan tema "Kasih yang Mempersatukan". Dilayani oleh Pdt. Dr. Johannes Wibowo.',
            'category' => 'ibadah',
            'schedule_date' => now()->addDays(7),
            'schedule_time' => '07:00:00',
            'location' => 'Gedung Utama Gereja'
        ]);

        Program::create([
            'title' => 'Ibadah Minggu Sore',
            'description' => 'Ibadah minggu sore dengan tema "Iman yang Bekerja". Dilayani oleh Pdt. Maria Tanjung.',
            'category' => 'ibadah',
            'schedule_date' => now()->addDays(7),
            'schedule_time' => '17:00:00',
            'location' => 'Gedung Utama Gereja'
        ]);

        Program::create([
            'title' => 'Doa Pagi Bersama',
            'description' => 'Persekutuan doa pagi setiap hari Selasa. Mari bersama-sama mencari wajah Tuhan.',
            'category' => 'ibadah',
            'schedule_date' => now()->addDays(2),
            'schedule_time' => '05:00:00',
            'location' => 'Ruang Doa Gereja'
        ]);

        // Program Pendidikan
        Program::create([
            'title' => 'Sekolah Minggu',
            'description' => 'Pendidikan agama untuk anak-anak usia 3-12 tahun dengan metode yang menyenangkan dan interaktif.',
            'category' => 'pendidikan',
            'schedule_date' => now()->addDays(7),
            'schedule_time' => '08:00:00',
            'location' => 'Ruang Sekolah Minggu'
        ]);

        Program::create([
            'title' => 'PA Remaja',
            'description' => 'Persekutuan remaja dengan tema "Youth on Fire". Membangun karakter Kristiani pada generasi muda.',
            'category' => 'pendidikan',
            'schedule_date' => now()->addDays(5),
            'schedule_time' => '19:00:00',
            'location' => 'Ruang Serba Guna'
        ]);

        Program::create([
            'title' => 'Kursus Pra Nikah',
            'description' => 'Kursus persiapan pernikahan untuk calon pengantin. Mempersiapkan pondasi rumah tangga yang kokoh.',
            'category' => 'pendidikan',
            'schedule_date' => now()->addDays(14),
            'schedule_time' => '09:00:00',
            'location' => 'Ruang Meeting'
        ]);
    }
}