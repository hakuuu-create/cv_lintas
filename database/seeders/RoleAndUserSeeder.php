<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        $media = User::updateOrCreate(
            [
                'name' => 'Admin',
                'email' => 'test@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('12345678'),
            ]
        );
    }
}