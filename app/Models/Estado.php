<?php

// app/Models/Estado.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = ['nombre', 'abreviatura'];

    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }
}
