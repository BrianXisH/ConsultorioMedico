<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apnp extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'apnp';  // Asegurando que Laravel use el nombre correcto de la tabla.

    protected $fillable = [
        'habitos_higienicos_vestuario',
        'habitos_higienicos_lavado_dientes_frecuencia',
        'habitos_higienicos_utiliza_auxiliares_higiene_bucal',
        'habitos_higienicos_auxiliares_higiene_bucal_cuales',
        'habitos_higienicos_consume_golosinas_otros_alimentos_comidas',
        'grupo_sanguineo',
        'factor_rh',
        'cuenta_cartilla_vacunacion',
        'esquema_completo',
        'esquema_falta',
        'adicciones_tabaco',
        'adicciones_alcohol',
        'antecedentes_alergicos',
        'antecedentes_alergicos_antibioticos',
        'antecedentes_alergicos_analgesicos',
        'antecedentes_alergicos_anestesicos',
        'antecedentes_alergicos_alimentos',
        'antecedentes_alergicos_especifique',
        'hospitalizado',
        'hospitalizado_fecha',
        'hospitalizado_motivo',
        'padecimiento_actual'
    ];

    /**
     * Relación uno a uno con Paciente.
     */
    public function ficIdent()
    {
        return $this->belongsTo(FicIdent::class, 'fic_ident_idfi', 'idfi');
    }
}
