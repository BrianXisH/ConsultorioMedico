<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicIdent extends Model
{
    use HasFactory;

    protected $table = 'fic_ident';  // Asegurando que Laravel use el nombre correcto de la tabla.
    protected $primaryKey = 'idfi'; // Ajustando la clave primaria.

    protected $fillable = [
        'fecha_consulta',
        'fecha_ultima_consulta',
        'motivo_ultima_consulta',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_idpacientes', 'idpacientes');
    }


    public function app()
    {
        return $this->hasOne(App::class, 'fic_ident_idfi', 'idfi');
    }

    public function aph()
    {
        return $this->hasOne(Aph::class, 'fic_ident_idfi', 'idfi');
    }

    public function apnp()
    {
        return $this->hasOne(Apnp::class, 'fic_ident_idfi', 'idfi');
    }

    public function exploracion_fisica()
    {
        return $this->hasOne(ExploracionFisica::class, 'fic_ident_idfi', 'idfi');
    }

    public function ipsa()
    {
        return $this->hasOne(Ipsa::class, 'fic_ident_idfi', 'idfi');
    }
}
