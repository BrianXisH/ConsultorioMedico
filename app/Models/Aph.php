<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aph extends Model
{
    use HasFactory;


    public $timestamps = false;
    protected $table = 'aph';  // Asegurando que Laravel use el nombre correcto de la tabla.

    protected $fillable = [
        'fic_ident_idfi',
        'madre',
        'padre',
        'hermanos',
        'hijos',
        'esposo_a',
        'tios',
        'abuelos'
    ];

    /**
     * Relación uno a uno con Paciente.
     */
    public function ficIdent()
    {
        return $this->belongsTo(FicIdent::class, 'fic_ident_idfi', 'idfi');
    }
}
