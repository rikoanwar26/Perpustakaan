<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        Petugas::create([
            'nama'     => 'Admin Perpustakaan',
            'email'    => 'admin@perpus.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}