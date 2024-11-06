<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model implements AuthenticatableContract
{
    use Authenticatable;  // Incluimos el trait para obtener las funciones de autenticación

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    protected $fillable = ['usuario', 'nombres', 'apellidos', 'rol', 'contrasena'];

    // Laravel usa 'password' por defecto, asegúrate de que la columna se llama 'contrasena'
    protected $hidden = ['contrasena'];


    // Relación: Un usuario tiene muchos registros

    public function nacimiento()
    {
        return $this->hasMany(nacimiento::class, 'id_usuario', 'id_usuario');
    }

    //  columna de contraseña se llama 'contrasena',
    public function getAuthPassword()
    {
        return $this->contrasena;  // Retornamos la contraseña almacenada
    }


}

