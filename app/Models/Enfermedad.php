<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    use HasFactory;

    protected $table = 'enfermedades';  // Asegurando que Laravel use el nombre correcto de la tabla.
    protected $primaryKey = 'idenfermedades'; // Ajustando la clave primaria.

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    /**
     * Relación uno a uno con Consultas.
     */
    public function consulta()
    {
        return $this->hasOne('App\Models\Consulta', 'enfermedades_idenfermedades', 'idenfermedades');
    }
}
