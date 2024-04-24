<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadisticasTable extends Migration
{
    public function up()
    {
        Schema::create('estadisticas', function (Blueprint $table) {
            $table->integer('idestadisticas')->primary();
            $table->dateTime('fecha');
            $table->decimal('porcentaje', 5, 2)->nullable();
            $table->unsignedInteger('visitantes_idvisitantes'); // Cambiado a unsignedInteger para ser compatible

            // Índice para la clave foránea
            $table->index('visitantes_idvisitantes', 'fk_estadisticas_visitantes1_idx');

            // Clave foránea
            $table->foreign('visitantes_idvisitantes', 'fk_estadisticas_visitantes1')
                  ->references('idvisitantes')->on('visitantes')
                  ->onDelete('no action')
                  ->onUpdate('no action');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estadisticas');
    }
}
