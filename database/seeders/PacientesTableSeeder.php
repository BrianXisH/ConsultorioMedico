<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class PacientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 50) as $index) {
            DB::table('pacientes')->insert([
                'curp' => strtoupper($faker->bothify('????######????????')),
                'nombre_apellido_paterno' => $faker->lastName,
                'nombre_apellido_materno' => $faker->lastName,
                'nombre_nombres' => $faker->firstName,
                'edad_anios' => $faker->numberBetween(1, 100),
                'genero_masculino' => $faker->boolean,
                'genero_femenino' => $faker->boolean,
                'lugar_nacimiento_estado' => $faker->state,
                'lugar_nacimiento_ciudad' => $faker->city,
                'fecha_nacimiento' => $faker->dateTimeBetween('-100 years', '-1 year'),
                'ocupacion' => $faker->jobTitle,
                'escolaridad' => $faker->randomElement(['Primaria', 'Secundaria', 'Preparatoria', 'Universidad', 'Posgrado']),
                'estado_civil' => $faker->randomElement(['Soltero', 'Casado', 'Divorciado', 'Viudo']),
                'domicilio_calle' => $faker->streetName,
                'domicilio_num_exterior' => $faker->buildingNumber,
                'domicilio_num_interior' => $faker->randomNumber(3, false),
                'domicilio_colonia' => $faker->secondaryAddress,
                'domicilio_estado' => $faker->state,
                'domicilio_mpio' => $faker->city,
                'domicilio_delegacion' => $faker->citySuffix,
                'telefono' => $faker->phoneNumber,
                'telefono_oficina' => $faker->phoneNumber,
                'tipo_usuario' => $faker->randomElement(['Paciente', 'Consulta Externa', 'Urgencias']),
            ]);
        }
    }
}
