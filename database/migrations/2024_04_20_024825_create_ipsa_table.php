<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpsaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipsa', function (Blueprint $table) {
            $table->increments('idipsa');
            $table->unsignedInteger('fic_ident_idfi')->nullable();
            $table->string('interrogatorio_aparato_digestivo', 255)->nullable();
            $table->string('interrogatorio_aparato_respiratorio', 255)->nullable();
            $table->string('interrogatorio_cardiovascular', 255)->nullable();
            $table->string('interrogatorio_aparato_genitourinario', 255)->nullable();
            $table->string('interrogatorio_sistema_endocrino', 255)->nullable();
            $table->string('interrogatorio_sistema_hemepoyetico', 255)->nullable();
            $table->string('interrogatorio_sistema_nervioso', 255)->nullable();
            $table->string('interrogatorio_sistema_musculoesqueletico', 255)->nullable();
            $table->string('interrogatorio_sistema_tegumentario', 255)->nullable();
            $table->string('interrogatorio_aparato_tegumentario', 255)->nullable();
            $table->string('habitus_exterior', 255)->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('talla', 5, 2)->nullable();
            $table->string('complexion', 45)->nullable();
            $table->integer('frecuencia_cardiaca')->nullable();
            $table->integer('sistolica')->nullable();
            $table->integer('diastolica')->nullable();
            $table->integer('frecuencia_respiratoria')->nullable();
            $table->decimal('temperatura', 4, 2)->nullable();
            $table->foreign('fic_ident_idfi')
                  ->references('idfi')
                  ->on('fic_ident')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ipsa');
    }
}
