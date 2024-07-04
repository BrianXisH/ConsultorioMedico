<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfermedadesTable extends Migration
{
    public function up()
    {
        Schema::create('enfermedades', function (Blueprint $table) {
            $table->unsignedInteger('idenfermedades')->autoIncrement(); // Debe ser 'unsignedInteger'
            $table->string('nombre', 100);
            $table->string('descripcion', 45);
            $table->primary('idenfermedades');
        });
    }

    public function down()
    {
        Schema::dropIfExists('enfermedades');
    }
}
