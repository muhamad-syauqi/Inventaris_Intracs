<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeknisiSeeder extends Seeder
{
    public function run(): void
    {
        $teknisi = [
            [
                'name' => 'zahrul',
                'email' => 'zahrulmhasan@gmail.com',
                'password' => 'KopiMalam#26',
            ],
            [
                'name' => 'Ari lesmana',
                'email' => 'arilesmana@gmail.com',
                'password' => 'SepedaBalap!88',
            ],
             [
                'name' => 'Ruli',
                'email' => 'rulinurjaman@gmail.com',
                'password' => 'BukuTulis!99',
            ],
             [
                'name' => 'Hamzah',
                'email' => 'hamzahabdulazis@gmail.com',
                'password' => 'PantaiIndah@45',
            ],
             [
                'name' => 'Zamaludin',
                'email' => 'zamaludin@gmail.com',
                'password' => 'teknisi4444',
            ],
             [
                'name' => 'adam',
                'email' => 'adamzakariadi@gmail.com',
                'password' => 'RumahHijau#77',
            ],
             [
                'name' => 'usman',
                'email' => 'usmanjaelani5@gmail.com',
                'password' => 'teknisi4321',
            ],
             [
                'name' => 'Agung',
                'email' => 'agung@gmail.com',
                'password' => 'KipasAngin!34',
            ],
             [
                'name' => 'sigit',
                'email' => 'sigitrenaldi@gmail.com',
                'password' => 'NasiGoreng@88',
            ],
         [
                'name' => 'cep dandi',
                'email' => 'cepdandi@gmail.com',
                'password' => 'MejaKayu#15',
            ],
             [
                'name' => 'yogie',
                'email' => 'yogienugraha@gmail.com',
                'password' => 'PensilMerah!66',
            ],
             [
                'name' => 'fiqri',
                'email' => 'fiqrifauzi5@gmail.com',
                'password' => 'KameraTua@50',
            ],
             [
                'name' => 'budi',
                'email' => 'mulyanto@gmail.com',
                'password' => 'PohonRindang#21',
            ],
             [
                'name' => 'anwar',
                'email' => 'anwarnurhasan@gmail.com',
                'password' => 'GitarPetik#08',
            ],
             [
                'name' => 'Deri',
                'email' => 'derinrumanakbar@gmail.com',
                'password' => 'LampuTidur!99',
            ],
             [
                'name' => 'dede',
                'email' => 'dedeabdulrohmat@gmail.com',
                'password' => 'PintuKayu@2025',
            ],
             [
                'name' => 'Rendi',
                'email' => 'rendiakvian@gmail.com',
                'password' => 'PintuKayu@2025',
            ],
             [
                'name' => 'ivan',
                'email' => 'ivanhamzah@gmail.com',
                'password' => 'PintuKayu@2025',
            ],
             [
                'name' => 'Rahmat',
                'email' => 'tahmatsodik@gmail.com',
                'password' => 'teknisi4222',
            ],
             [
                'name' => 'sidik',
                'email' => 'sidikhidayat@gmail.com',
                'password' => 'SepatuLari#34',
            ],
             [
                'name' => 'renaldiansyah',
                'email' => 'renaldiansyah@gmail.com',
                'password' => 'HujanDeras!77',
            ],
        ];

        foreach ($teknisi as $data) {

            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                    'role' => 'teknisi',
                ]
            );

        }
    }
}