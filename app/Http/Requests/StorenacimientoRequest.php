<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorenacimientoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombres' => ['required', 'string', 'max:255'], // Obligatorio, texto y longitud máxima de 255
            'apellidos' => ['required', 'string', 'max:255'], // Obligatorio, texto y longitud máxima de 255
            'f_nacimiento' => ['required', 'date_format:d/m/Y', 'before:today'], // Fecha válida en formato d/m/Y y antes de hoy
            'ruta_doc' => ['required', 'file', 'mimes:pdf', 'max:10240'], // Obligatorio, archivo PDF, tamaño máximo de 2MB
        ];
    }

    public function messages()
    {
        return [
            'nombres.required' => 'El campo "Nombres" es obligatorio.',
            'nombres.string' => 'El campo "Nombres" debe contener texto válido.',
            'nombres.max' => 'El campo "Nombres" no debe exceder los 255 caracteres.',

            'apellidos.required' => 'El campo "Apellidos" es obligatorio.',
            'apellidos.string' => 'El campo "Apellidos" debe contener texto válido.',
            'apellidos.max' => 'El campo "Apellidos" no debe exceder los 255 caracteres.',

            'f_nacimiento.required' => 'El campo "Fecha de Nacimiento" es obligatorio.',
            'f_nacimiento.date_format' => 'El campo "Fecha de Nacimiento" debe tener el formato dd/mm/yyyy.',
            'f_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy.',

            'ruta_doc.required' => 'El archivo PDF es obligatorio.',
            'ruta_doc.file' => 'El archivo proporcionado no es válido.',
            'ruta_doc.mimes' => 'Solo se permiten archivos en formato PDF.',
            'ruta_doc.max' => 'El archivo no debe superar los 2MB.',
        ];
    }
}
