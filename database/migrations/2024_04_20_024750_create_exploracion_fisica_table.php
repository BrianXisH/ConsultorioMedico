<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExploracionFisicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exploracion_fisica', function (Blueprint $table) {
            $table->increments('idexploracion_fisica')->primary();
            $table->unsignedInteger('fic_ident_idfi')->nullable();
            $table->boolean('cabeza_exostosis')->nullable();
            $table->boolean('cabeza_endostosis')->nullable();
            $table->boolean('craneo_dolicocefalico')->nullable();
            $table->boolean('craneo_mesocefalico')->nullable();
            $table->boolean('craneo_braquicefalico')->nullable();
            $table->boolean('cara_asimetrias_transversales')->nullable();
            $table->boolean('cara_asimetrias_longitudinales')->nullable();
            $table->boolean('perfil_concavo')->nullable();
            $table->boolean('perfil_convexo')->nullable();
            $table->boolean('perfil_recto')->nullable();
            $table->boolean('piel_normal')->nullable();
            $table->boolean('piel_palida')->nullable();
            $table->boolean('piel_cianotica')->nullable();
            $table->boolean('piel_enrojecida')->nullable();
            $table->boolean('musculos_hipotonicos')->nullable();
            $table->boolean('musculos_hipertonicos')->nullable();
            $table->boolean('musculos_espasticos')->nullable();
            $table->boolean('cuello_palpa_cadena_ganglionar')->nullable();
            $table->string('otros', 255)->nullable();
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
        Schema::dropIfExists('exploracion_fisica');
    }
}
