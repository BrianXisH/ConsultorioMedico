<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PacientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pacientes')->insert([
            'nombre_apellido_paterno' => Str::random(10),
            'nombre_apellido_materno' => Str::random(10),
            'nombre_nombres' => Str::random(10),
            'edad_anios' => rand(1, 100),
            'genero_masculino' => rand(0, 1) == 1,
            'genero_femenino' => rand(0, 1) == 1,
            'ugar_nacimiento_estado' => Str::random(10),
            'lugar_nacimiento_ciudad' => Str::random(10),
            'fecha_nacimiento' => now()->subYears(rand(1, 100)),
            'ocupacion' => Str::random(10),
            'escolaridad' => Str::random(10),
            'estado_civil' => Str::random(10),
            'domicilio_calle' => Str::random(10),
            'domicilio_num_exterior' => rand(1, 1000),
            'domicilio_num_interior' => rand(1, 100),
            'domicilio_colonia' => Str::random(10),
            'domicilio_estado' => Str::random(10),
            'domicilio_mpio' => Str::random(10),
            'domicilio_delegacion' => Str::random(10),
            'telefono' => Str::random(10),
            'telefono_oficina' => Str::random(10),
        ]);
    }
}
