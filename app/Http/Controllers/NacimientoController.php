<?php

namespace App\Http\Controllers;

use App\Models\libro;
use App\Models\nacimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorenacimientoRequest;
use App\Http\Requests\UpdatenacimientoRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class NacimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $totalNacimientos = DB::table('acta_nacimiento')->count();

        $libros = libro::all();
        $nacimientos = nacimiento::take(10)->get();

        return view('nacimiento.index', compact('nacimientos','totalNacimientos', 'libros'));
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
    public function store(StorenacimientoRequest $request)
    {
        // Convertir la fecha al formato correcto
        $fechaNacimiento = Carbon::createFromFormat('d/m/Y', $request->f_nacimiento)->format('Y-m-d');

        // Definir la carpeta del tipo de acta (acta_nacimiento)
        $actaType = 'acta_nacimiento';

        // Crear el nombre de la carpeta basado en nombre y apellidos
        $folderName = $request->nombres . '_' . $request->apellidos;

        // Crear el path completo dentro de acta_nacimiento para almacenar el archivo
        $folderPath = "$actaType/$folderName/pdf";

        // Subir el archivo PDF y obtener la ruta
        if ($request->hasFile('ruta_doc')) {
            $file = $request->file('ruta_doc');

            // Crear un nombre único para el archivo: nombres_apellidos_identificador.pdf
            $uniqueIdentifier = uniqid(); // O usar Str::uuid() para mayor unicidad
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = "{$request->nombres}_{$request->apellidos}_{$uniqueIdentifier}.{$fileExtension}";

            $filePath = $file->storeAs($folderPath, $fileName, 'public');
        }

        // Crear el nuevo registro
        $registro = new nacimiento();
        $registro->nombres = $request->nombres;
        $registro->apellidos = $request->apellidos;
        $registro->f_nacimiento = $fechaNacimiento; // Almacenar la fecha convertida
        $registro->ruta_doc = $filePath; // Almacenar solo la ruta en la BD
        $registro->id_usuario = auth()->user()->id_usuario;
        $registro->id_libro = $request->id_libro; // Relacionar el acta con el libro
        $registro->save();

        return redirect()->route('nacimiento.index')->with('success', 'Registro creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(nacimiento $nacimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $nacimiento = nacimiento::findOrFail($id);  // Obtener el registro
        $libros = libro::all();

        return view('nacimiento.update', compact('nacimiento','libros' ));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatenacimientoRequest $request, $id)
    {
        // Encontrar el registro por ID
        $registro = nacimiento::findOrFail($id);

        // Convertir la fecha al formato correcto
        $fechaNacimiento = Carbon::createFromFormat('d/m/Y', $request->f_nacimiento)->format('Y-m-d');

        // Definir la carpeta del tipo de acta (acta_nacimiento)
        $actaType = 'acta_nacimiento';

        // Crear el nombre de la carpeta basado en nombre y apellidos
        $folderName = $request->nombres . '_' . $request->apellidos;
        $folderPath = "$actaType/$folderName/pdf";

        // Subir el archivo PDF y obtener la ruta si se ha subido un nuevo archivo
        if ($request->hasFile('ruta_doc')) {
            // Eliminar el archivo anterior si existe
            if ($registro->ruta_doc) {
                Storage::disk('public')->delete($registro->ruta_doc);
            }

            $file = $request->file('ruta_doc');

            // Crear un nombre único para el archivo: nombres_apellidos_identificador.pdf
            $uniqueIdentifier = uniqid(); // O usar Str::uuid() para mayor unicidad
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = "{$request->nombres}_{$request->apellidos}_{$uniqueIdentifier}.{$fileExtension}";

            $filePath = $file->storeAs($folderPath, $fileName, 'public');
            $registro->ruta_doc = $filePath; // Guardar la nueva ruta del archivo
        }

        // Actualizar los campos del registro
        $registro->nombres = $request->nombres;
        $registro->apellidos = $request->apellidos;
        $registro->f_nacimiento = $fechaNacimiento;
        $registro->id_usuario = auth()->user()->id_usuario; // ID del usuario que hizo la actualización
        $registro->id_libro = $request->id_libro; // Relacionar el acta con el libro

        $registro->save();

        return redirect()->route('nacimiento.edit', ['nacimiento' => $id])
            ->with('success', 'Registro actualizado exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(nacimiento $nacimiento)
    {
        //
    }
}
