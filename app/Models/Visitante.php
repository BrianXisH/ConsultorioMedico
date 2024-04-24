<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;

    protected $table = 'visitantes';  // Asegurando que Laravel use el nombre correcto de la tabla.
    protected $primaryKey = 'idvisitantes'; // Ajustando la clave primaria.

    protected $fillable = [
        'alumno',
        'profesor',
        'administrativo'
    ];

    /**
     * Relación uno a uno con Estadisticas.
     */
    public function estadisticas()
    {
        return $this->hasOne('App\Models\Estadisticas', 'visitantes_idvisitantes', 'idvisitantes');
    }
}
