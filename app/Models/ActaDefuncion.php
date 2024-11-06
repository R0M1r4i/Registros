<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActaDefuncion extends Model
{
    use HasFactory;

    protected $table = 'acta_defuncion';

    protected $fillable = [
        'nombres', 'apellidos', 'f_defuncion', 'ruta_doc', 'id_usuario'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Registrar logs de creación y actualización
    protected static function boot()
    {
        parent::boot();

        static::created(function ($actaDefuncion) {
            $actaDefuncion->crearLog('crear');
        });

        static::updated(function ($actaDefuncion) {
            $actaDefuncion->crearLog('actualizar');
        });
    }

    public function crearLog($accion)
    {
        $cambios = $accion === 'crear' ? json_encode($this->getAttributes()) : json_encode($this->getChanges());

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
