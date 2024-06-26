<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFicIdentTable extends Migration
{
    public function up()
    {
        Schema::create('fic_ident', function (Blueprint $table) {
            $table->increments('idfi');
            $table->unsignedInteger('pacientes_idpacientes')->nullable();
            $table->dateTime('fecha_consulta');
            $table->dateTime('fecha_ultima_consulta');
            $table->string('motivo_ultima_consulta', 45);
            $table->string('tipo_consulta', 45)->nullable();

            $table->foreign('pacientes_idpacientes')
                  ->references('idpacientes')
                  ->on('pacientes')
                  ->onDelete('set null');  // O el comportamiento que prefieras
        });
    }

    public function down()
    {
        Schema::dropIfExists('fic_ident');
    }
}
