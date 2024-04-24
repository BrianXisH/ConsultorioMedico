<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'app';  // Asegurando que Laravel use el nombre correcto de la tabla.

    protected $fillable = [
        'fic_ident_idfi',
        'enfermedades_inflamatorias_infecciosas_no_trasmisibles',
        'enfermedades_trasmision_sexual',
        'enfermedades_degenerativas',
        'enfermedades_neoplasicas',
        'enfermedades_congenitas',
        'otras'
    ];

    /**
     * Relación uno a uno con Paciente.
     */
    public function ficIdent()
    {
        return $this->belongsTo(FicIdent::class, 'fic_ident_idfi', 'idfi');
    }
}
