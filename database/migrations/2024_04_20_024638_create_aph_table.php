<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAphTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aph', function (Blueprint $table) {
            $table->increments('idaph');
            $table->unsignedInteger('fic_ident_idfi')->nullable();
            $table->string('madre', 255)->nullable();
            $table->string('padre', 255)->nullable();
            $table->string('hermanos', 255)->nullable();
            $table->string('hijos', 255)->nullable();
            $table->string('esposo_a', 255)->nullable();
            $table->string('tios', 255)->nullable();
            $table->string('abuelos', 255)->nullable();
            

            // Definición correcta de la clave foránea
            $table->foreign('fic_ident_idfi')
                  ->references('idfi')
                  ->on('fic_ident')
                  ->onDelete('set null'); // Ajusta según tus necesidades
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aph');
    }
}
