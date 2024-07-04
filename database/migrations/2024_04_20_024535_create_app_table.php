<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTable extends Migration
{
    public function up()
    {
        Schema::create('app', function (Blueprint $table) {
            $table->increments('idapp');
            $table->unsignedBigInteger('ficha_nueva_id')->nullable();
            $table->string('enfermedades_inflamatorias_infecciosas_no_trasmisibles', 255)->nullable();
            $table->string('enfermedades_trasmision_sexual', 255)->nullable();
            $table->string('enfermedades_degenerativas', 255)->nullable();
            $table->string('enfermedades_neoplasicas', 255)->nullable();
            $table->string('enfermedades_congenitas', 255)->nullable();
            $table->string('otras', 255)->nullable();
            

            // Definición correcta de la clave foránea
            $table->foreign('ficha_nueva_id')
                  ->references('id')
                  ->on('fichas_nuevas')
                  ->onDelete('set null'); // Ajusta según tus necesidades
        });
    }

    public function down()
    {
        Schema::dropIfExists('app');
    }
}
