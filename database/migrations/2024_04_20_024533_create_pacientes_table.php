<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('idpacientes');
            $table->string('curp', 18);
            $table->string('nombre_apellido_paterno', 45);
            $table->string('nombre_apellido_materno', 45);
            $table->string('nombre_nombres', 45);
            $table->integer('edad_anios');
            $table->boolean('genero_masculino')->nullable();
            $table->boolean('genero_femenino')->nullable();
            $table->string('lugar_nacimiento_estado', 45);
            $table->string('lugar_nacimiento_ciudad', 45);
            $table->dateTime('fecha_nacimiento');
            $table->string('ocupacion', 45)->nullable();
            $table->string('escolaridad', 45)->nullable();
            $table->string('estado_civil', 45)->nullable();
            $table->string('domicilio_calle', 45)->nullable();
            $table->integer('domicilio_num_exterior')->nullable();
            $table->integer('domicilio_num_interior')->nullable();
            $table->string('domicilio_colonia', 45)->nullable();
            $table->string('domicilio_estado', 45)->nullable();
            $table->string('domicilio_mpio', 45)->nullable();
            $table->string('domicilio_delegacion', 45)->nullable();
            $table->string('telefono', 45)->nullable();
            $table->string('telefono_oficina', 45)->nullable();

            
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
