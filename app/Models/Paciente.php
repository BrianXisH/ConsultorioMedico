<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pacientes';  // Asegurando que Laravel use el nombre correcto de la tabla.
    protected $primaryKey = 'idpacientes'; // Ajustando la clave primaria.

    protected $fillable = [
        'curp',
        'tipo_consulta',
        'nombre_apellido_paterno',
        'nombre_apellido_materno',
        'nombre_nombres',
        'edad_anios',
        'genero_masculino',
        'genero_femenino',
        'lugar_nacimiento_estado',
        'lugar_nacimiento_ciudad',
        'fecha_nacimiento',
        'ocupacion',
        'escolaridad',
        'estado_civil',
        'domicilio_calle',
        'domicilio_num_exterior',
        'domicilio_num_interior',
        'domicilio_colonia',
        'domicilio_estado',
        'domicilio_mpio',
        'domicilio_delegacion',
        'telefono',
        'telefono_oficina'
    ];

    
    public function fichasIdentificacion()
    {
        return $this->hasMany(FicIdent::class, 'pacientes_idpacientes', 'idpacientes');
    }

    
}
