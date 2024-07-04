<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aph extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'aph';  // Asegurando que Laravel use el nombre correcto de la tabla.
    protected $primaryKey = 'idaph'; // Ajustando la clave primaria.

    protected $fillable = [
        'ficha_nueva_id',
        'madre',
        'padre',
        'hermanos',
        'hijos',
        'esposo_a',
        'tios',
        'abuelos'
    ];

    /**
     * Relación uno a uno con FichaNueva.
     */
    public function fichaNueva()
    {
        return $this->belongsTo(FichaNueva::class, 'ficha_nueva_id', 'id');
    }
}
