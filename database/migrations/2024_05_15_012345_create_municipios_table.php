<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_municipios_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosTable extends Migration
{
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->unsignedBigInteger('estado_id');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('municipios');
    }
}
