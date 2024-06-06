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
        'fic_ident_idfi'
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
     * Relación con FicIdent.
     */
    public function ficIdent()
    {
        return $this->belongsTo('App\Models\FicIdent', 'fic_ident_idfi', 'idfi');
    }
}
