<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // すでに同じメールがあるなら作らない（重複防止）
        User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
