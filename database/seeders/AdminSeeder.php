<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phone = env('ADMIN_PHONE');
        $password = env('ADMIN_PASSWORD');

        if (empty($phone) || empty($password)) {
            throw new RuntimeException('ADMIN_PHONE dan ADMIN_PASSWORD wajib diatur di file .env sebelum menjalankan seeder.');
        }

        User::updateOrCreate(
            ['phone' => $phone],
            [
                'name' => 'Admin',
                'address' => 'Kantor DuREN',
                'password' => Hash::make($password),
                'role' => 'admin',
            ]
        );
    }
}
