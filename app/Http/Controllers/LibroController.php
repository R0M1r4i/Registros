<?php

namespace App\Http\Controllers;

use App\Models\libro;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorelibroRequest;
use App\Http\Requests\UpdatelibroRequest;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = libro::all();


        return view('libro.index', compact('libros'));
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
    public function store(StorelibroRequest $request)
    {


        $libro = new libro();

        $libro->nombre_libro = $request->nombre_libro;
        $libro->save();

        return redirect()->route('libro.index')->with('success', 'Usuario creado exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(libro $libro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(libro $libro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelibroRequest $request, $id_libro)
    {
       $libro = libro::findorfail($id_libro);
       $libro->nombre_libro = $request->nombre_libro;

       $libro->save();

        return redirect()->route('libro.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(libro $libro)
    {
        //
    }
}
