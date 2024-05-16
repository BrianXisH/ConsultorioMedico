<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColoniasTable extends Migration
{
    public function up()
    {
        Schema::create('colonias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->unsignedBigInteger('municipio_id');
            $table->timestamps();

            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('colonias');
    }
}