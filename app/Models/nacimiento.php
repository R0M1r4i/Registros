<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class nacimiento extends Model
{
    use HasFactory;

    protected $table = 'acta_nacimiento';
    protected $primaryKey = 'id';

    protected $fillable = ['nombres', 'apellidos', 'f_nacimiento','ruta_doc','id_usuario','created_at','updated_at'];

    // Relación con el usuario
    public function usuario()
    {
        return $this->belongsTo(usuario::class, 'id_usuario', 'id_usuario');
    }

    protected static function boot()
    {
        parent::boot();

        // Evento para cuando se crea un registro
        static::created(function ($nacimiento) {
            $nacimiento->crearLog('crear');
        });

        // Evento para cuando se actualiza un registro
        static::updated(function ($nacimiento) {
            $nacimiento->crearLog('actualizar');
        });

        // Evento para cuando se elimina un registro
        static::deleted(function ($nacimiento) {
            $nacimiento->crearLog('eliminar');
        });
    }

    // Función para crear el log
    public function crearLog($accion)
    {
        $cambios = null;

        if ($accion === 'crear') {
            $cambios = json_encode($this->getAttributes());  // Captura todos los atributos al crear
        } elseif ($accion === 'actualizar') {
            $cambios = json_encode($this->getChanges());  // Captura solo los cambios al actualizar
        }

        \DB::table('logs')->insert([
            'id_usuario' => Auth::id(),
            'tabla' => $this->table,
            'id_registro' => $this->id,
            'accion' => $accion,
            'cambios' => $cambios,
            'created_at' => now(),
        ]);
    }


}
