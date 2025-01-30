<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class libro extends Model
{
    use HasFactory;

    protected $table = 'libro';
    protected $primaryKey = 'id_libro';
    public $timestamps = false;

    // Relación con ActaDefuncion
    public function actasDefuncion()
    {
        return $this->hasMany(ActaDefuncion::class, 'id_libro', 'id_libro');
    }

    // Relación con ActaMatrimonio
    public function actasMatrimonio()
    {
        return $this->hasMany(Matrimonio::class, 'id_libro', 'id_libro');
    }

    // Relación con ActaNacimiento
    public function actasNacimiento()
    {
        return $this->hasMany(nacimiento::class, 'id_libro', 'id_libro');
    }
}
