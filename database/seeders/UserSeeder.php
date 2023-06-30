<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'Admin',
            'email' => 'admin@mailinator.com',
            'password' => bcrypt('P@ssw0rd'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        $existUser = User::where('email', $data['email'])->first();

        if (!$existUser) {
            User::create($data);
        }
    }
}
