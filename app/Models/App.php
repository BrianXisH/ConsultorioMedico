<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'app';  // Asegurando que Laravel use el nombre correcto de la tabla.
    protected $primaryKey = 'idapp'; // Ajustando la clave primaria.


    protected $fillable = [
        'ficha_nueva_id', // Cambia este nombre a algo más adecuado si es necesario
        'enfermedades_inflamatorias_infecciosas_no_trasmisibles',
        'enfermedades_trasmision_sexual',
        'enfermedades_degenerativas',
        'enfermedades_neoplasicas',
        'enfermedades_congenitas',
        'otras'
    ];

    /**
     * Relación uno a uno con FichaNueva.
     */
    public function fichaNueva()
    {
        return $this->belongsTo(FichaNueva::class, 'ficha_nueva_id', 'id');
    }
}
