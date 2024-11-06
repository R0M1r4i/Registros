<?php

namespace Database\Factories;

use App\Models\ActaDefuncion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActaDefuncion>
 */
class ActaDefuncionFactory extends Factory
{
    protected $model = ActaDefuncion::class;

    public function definition()
    {
        // Crear una fecha de defunción aleatoria
        $f_defuncion = Carbon::now()->subYears(rand(1, 100))->format('Y-m-d');

        // Generar un archivo PDF de prueba
        $filePath = 'acta_defuncion/fake_files/pdf/';
        $fileName = time() . '_fake_' . $this->faker->lastName . '.pdf';

        if (!Storage::exists("public/$filePath")) {
            Storage::makeDirectory("public/$filePath");
        }

        Storage::disk('public')->put("{$filePath}{$fileName}", 'Contenido del archivo PDF falso');

        return [
            'nombres' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'f_nacimiento' => $f_defuncion,
            'ruta_doc' => "$filePath$fileName",
            'id_usuario' => 1, // Suponiendo que tienes al menos 10 usuarios
        ];
    }
}
