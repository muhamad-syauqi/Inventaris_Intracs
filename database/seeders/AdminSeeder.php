<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Suparman',
                'email' => 'Suparman@gmail.com',
                'password' => 'admin909',
            ],
            [
                'name' => 'hadian',
                'email' => 'hadianmustofa@gmail.com',
                'password' => 'admin321',
            ],
            [
                'name' => 'sandi',
                'email' => 'sandigunawan@gmail.com',
                'password' => 'admin555',
            ],
            [
                'name' => 'ujang',
                'email' => 'ujanghasanudin@gmail.com',
                'password' => 'admin123',
            ],
            [
                'name' => 'adang',
                'email' => 'adangpermana@gmail.com',
                'password' => 'admin231',
            ],
        ];

        foreach ($admins as $data) {

            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                    'role' => 'admin',
                ]
            );

        }
    }
}