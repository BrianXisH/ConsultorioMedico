<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ipsa extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'ipsa';  // Asegurando que Laravel use el nombre correcto de la tabla.

    protected $fillable = [
        'fic_ident_idfi',
        'interrogatorio_aparato_digestivo',
        'interrogatorio_aparato_respiratorio',
        'interrogatorio_cardiovascular',
        'interrogatorio_aparato_genitourinario',
        'interrogatorio_sistema_endocrino',
        'interrogatorio_sistema_hemepoyetico',
        'interrogatorio_sistema_nervioso',
        'interrogatorio_sistema_musculoesqueletico',
        'interrogatorio_sistema_tegumentario',
        'interrogatorio_aparato_tegumentario',
        'habitus_exterior',
        'peso',
        'talla',
        'complexion',
        'frecuencia_cardiaca',
        'sistolica',
        'diastolica',
        'frecuencia_respiratoria',
        'temperatura'
    ];

    /**
     * Relación uno a uno con Paciente.
     */
    public function ficIdent()
    {
        return $this->belongsTo(FicIdent::class, 'fic_ident_idfi', 'idfi');
    }
}
