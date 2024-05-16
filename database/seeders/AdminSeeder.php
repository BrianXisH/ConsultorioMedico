<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Name',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Asegúrate de usar una contraseña segura
            'role' => 'admin',
        ]);
    }
}
