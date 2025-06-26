<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Un admin « super‐utilisateur »
        User::firstOrCreate(
            ['email' => 'admin@nobesick.com'],
            [
              'name'     => 'Admin NOBESICK',
              'password' => Hash::make('Qwerty123'), // changez au besoin
            ]
        );

        // Quelques users factices (via factory si vous l'avez configurée)
        User::factory()->count(5)->create();
    }
}
