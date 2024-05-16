<?php



// app/Models/Municipio.php
// app/Models/Municipio.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $fillable = ['nombre', 'estado_id'];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function colonias()
    {
        return $this->hasMany(Colonia::class);
    }
}
