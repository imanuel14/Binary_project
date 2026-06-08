<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@gereja.local'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Admin@1234'),
                'is_active' => true,
                'role' => 'admin',
            ]
        );
    }
}
