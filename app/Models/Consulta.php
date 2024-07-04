<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';  // Asegurando que Laravel use el nombre correcto de la tabla.
    protected $primaryKey = 'idconsultas'; // Ajustando la clave primaria.

    protected $fillable = [
        'receta',
        'diagnostico',
        'user_id',  // Asegúrate de que este campo esté en la tabla
        'enfermedades_idenfermedades',
        'ficha_nueva_id' // Cambiado para apuntar a la nueva ficha
    ];

    /**
     * Relación con User.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id'); // Cambiado a 'user_id' y 'id'
    }

    /**
     * Relación con Enfermedad.
     */
    public function enfermedad()
    {
        return $this->belongsTo('App\Models\Enfermedad', 'enfermedades_idenfermedades', 'idenfermedades');
    }

    /**
     * Relación con FichaNueva.
     */
    public function fichaNueva()
    {
        return $this->belongsTo('App\Models\FichaNueva', 'ficha_nueva_id', 'id'); // Cambiado para apuntar a la nueva ficha
    }
}
