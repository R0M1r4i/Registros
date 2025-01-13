<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateusuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
     return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'usuario' => 'required|string|max:255|unique:usuario,usuario,' . $this->route('usuario') . ',id_usuario',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'rol' => 'required|in:admin,editor,viewer',
            'contrasena' => ['required', 'string', Password::min(8)
                ->mixedCase() // Requiere letras mayúsculas y minúsculas
                ->letters()   // Requiere letras
                ->numbers()   // Requiere números
                ->symbols()   // Requiere al menos un símbolo
                ->uncompromised()], // Verifica que la contraseña no esté comprometida
        ];
    }
    public function messages()
    {
        return [
            'usuario.required' => 'El nombre de usuario es obligatorio.',
            'usuario.string' => 'El nombre de usuario debe ser texto.',
            'usuario.max' => 'El nombre de usuario no puede exceder los 255 caracteres.',
            'usuario.unique' => 'Este nombre de usuario ya está registrado.',

            'nombres.required' => 'El campo nombres es obligatorio.',
            'nombres.string' => 'El campo nombres debe ser texto.',
            'nombres.max' => 'Los nombres no pueden exceder los 255 caracteres.',

            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.string' => 'El campo apellidos debe ser texto.',
            'apellidos.max' => 'Los apellidos no pueden exceder los 255 caracteres.',

            'rol.required' => 'El rol es obligatorio.',
            'rol.in' => 'El rol seleccionado no es válido. Debe ser admin, editor o viewer.',

            'contrasena.required' => 'La contraseña es obligatoria.',
            'contrasena.string' => 'La contraseña debe ser texto.',
            'contrasena.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'contrasena.mixed' => 'La contraseña debe incluir mayúsculas y minúsculas.',
            'contrasena.letters' => 'La contraseña debe incluir letras.',
            'contrasena.numbers' => 'La contraseña debe incluir números.',
            'contrasena.symbols' => 'La contraseña debe incluir al menos un símbolo.',
            'contrasena.uncompromised' => 'Esta contraseña ha aparecido en una filtración de datos. Por favor, elija una diferente.',
        ];
    }

}
