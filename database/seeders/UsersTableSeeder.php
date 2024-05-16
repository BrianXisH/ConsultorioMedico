<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $role = $i % 2 == 0 ? 'medico' : 'admin'; // Alternar entre 'medico' y 'admin'

            $user = [
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => $role,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ];

            if ($role == 'medico') {
                $user['cedula_profesional'] = Str::random(10);
                $user['escuela_de_procedencia'] = Str::random(10);
            }

            DB::table('users')->insert($user);
        }
    }
}