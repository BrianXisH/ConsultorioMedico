<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('idconsultas'); // Cambiado a increments para autoincrement
            $table->string('receta', 255);
            $table->string('diagnostico', 255);
            $table->foreignId('user_id')->constrained()->onDelete('no action')->onUpdate('no action'); 
            $table->integer('enfermedades_idenfermedades'); // int, alineado con la tabla `enfermedades`
            $table->unsignedInteger('fic_ident_idfi')->nullable();
            $table->foreign('fic_ident_idfi')
                  ->references('idfi')
                  ->on('fic_ident')
                  ->onDelete('set null');

            // Indices adicionales
            $table->index('enfermedades_idenfermedades', 'fk_consultas_enfermedades1_idx');
            // Claves foráneas
            $table->foreign('enfermedades_idenfermedades', 'fk_consultas_enfermedades1')
                  ->references('idenfermedades')->on('enfermedades')
                  ->onDelete('no action')
                  ->onUpdate('no action');
            
            $table->timestamps(); // Para tener created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
