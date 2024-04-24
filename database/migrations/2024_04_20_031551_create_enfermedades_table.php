<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfermedadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfermedades', function (Blueprint $table) {
            $table->integer('idenfermedades')->autoIncrement(); // Si necesitas que sea autoincrementable
            // $table->integer('idenfermedades'); // Usa esta línea en lugar de la anterior si no deseas autoincremento
            $table->string('nombre', 100);
            $table->string('descripcion', 45);
            $table->primary('idenfermedades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enfermedades');
    }
}
