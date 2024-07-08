<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaNueva extends Model
{
    use HasFactory;

    protected $table = 'fichas_nuevas';

    protected $fillable = [
        'paciente_id',
        'fecha_consulta',
        'tipo_consulta',
        'motivo_consulta',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'idpacientes');
    }
}
