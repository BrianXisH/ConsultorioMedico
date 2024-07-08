<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichasNuevasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas_nuevas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('paciente_id'); // Cambia a unsignedInteger
            $table->date('fecha_consulta');
            $table->string('tipo_consulta', 50);
            $table->string('motivo_consulta', 50);
            $table->timestamps();

            $table->foreign('paciente_id')->references('idpacientes')->on('pacientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichas_nuevas');
    }
}
