<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadisticas extends Model
{
    use HasFactory;

    protected $table = 'estadisticas';  // Asegurando que Laravel use el nombre correcto de la tabla.
    protected $primaryKey = 'idestadisticas'; // Ajustando la clave primaria.

    protected $fillable = [
        'fecha',
        'porcentaje',
        'visitantes_idvisitantes'
    ];

    /**
     * Relación con Visitante.
     */
    public function visitante()
    {
        return $this->belongsTo('App\Models\Visitante', 'visitantes_idvisitantes', 'idvisitantes');
    }
}
