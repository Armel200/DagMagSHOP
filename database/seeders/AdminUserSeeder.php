<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Crée ou met à jour l'utilisateur admin avec email fixe
        User::updateOrCreate(
            ['email' => 'degaulrich@gmail.com'], // email fixe admin
            [
                'name' => 'Administrator',
                'password' => Hash::make('Darelle.13'), // mot de passe fixe
                'is_admin' => true,
            ]
        );
    }
}
