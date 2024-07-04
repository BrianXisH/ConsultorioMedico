<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploracionFisica extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'exploracion_fisica';  // Asegurando que Laravel use el nombre correcto de la tabla.
    protected $primaryKey = 'idexploracion_fisica'; // Ajustando la clave primaria.


    protected $fillable = [
        'ficha_nueva_id',
        'cabeza_exostosis',
        'cabeza_endostosis',
        'craneo_dolicocefalico',
        'craneo_mesocefalico',
        'craneo_braquicefalico',
        'cara_asimetrias_transversales',
        'cara_asimetrias_longitudinales',
        'perfil_concavo',
        'perfil_convexo',
        'perfil_recto',
        'piel_normal',
        'piel_palida',
        'piel_cianotica',
        'piel_enrojecida',
        'musculos_hipotonicos',
        'musculos_hipertonicos',
        'musculos_espasticos',
        'cuello_palpa_cadena_ganglionar',
        'otros'
    ];

    /**
     * Relación uno a uno con FichaNueva.
     */
    public function fichaNueva()
    {
        return $this->belongsTo(FichaNueva::class, 'ficha_nueva_id', 'id');
    }
}
