<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';
    protected $primaryKey = 'idconsultas';

    protected $fillable = [
        'receta',
        'diagnostico',
        'user_id',
        'ficha_nueva_id',
    ];

    /**
     * Relación con User.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Relación con FichaNueva.
     */
    public function fichaNueva()
    {
        return $this->belongsTo('App\Models\FichaNueva', 'ficha_nueva_id', 'id');
    }
}
