<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('idconsultas');
            $table->text('receta')->nullable();
            $table->text('diagnostico')->nullable();
            $table->unsignedBigInteger('user_id'); // Debe ser 'unsignedBigInteger'
            $table->unsignedInteger('enfermedades_idenfermedades'); // Debe ser 'unsignedInteger'
            $table->unsignedBigInteger('ficha_nueva_id'); // Debe ser 'unsignedBigInteger'
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('enfermedades_idenfermedades')->references('idenfermedades')->on('enfermedades')->onDelete('cascade');
            $table->foreign('ficha_nueva_id')->references('id')->on('fichas_nuevas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
