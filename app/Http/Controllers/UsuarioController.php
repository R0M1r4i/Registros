<?php

namespace App\Http\Controllers;

use App\Models\usuario;

use App\Http\Requests\StoreusuarioRequest;
use App\Http\Requests\UpdateusuarioRequest;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreusuarioRequest $request)
    {
        $usuario = new Usuario();

        // Sanitización y asignación de datos
        $usuario->usuario = trim($request->usuario); // Eliminar espacios extra
        $usuario->nombres = filter_var($request->nombres);
        $usuario->apellidos = filter_var($request->apellidos);
        $usuario->rol = $request->rol;
        $usuario->contrasena = Hash::make($request->contrasena);

        // Guardar usuario
        $usuario->save();

        return redirect()->route('usuario.index')->with('success', 'Usuario creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateusuarioRequest $request, $id_usuario)
    {
        $usuario = Usuario::findOrFail($id_usuario);

        // Sanitización y actualización de datos
        $usuario->usuario = trim($request->usuario);
        $usuario->nombres = filter_var($request->nombres);
        $usuario->apellidos = filter_var($request->apellidos);
        $usuario->rol = $request->rol;

        // Actualizar contraseña solo si se envió una nueva
        if ($request->filled('contrasena')) {
            $usuario->contrasena = Hash::make($request->contrasena);
        }

        // Guardar cambios
        $usuario->save();

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado exitosamente.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(usuario $usuario)
    {
        //
    }
}
