<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusquedaController extends Controller
{

    public function index()
    {
        // Contar el total de actas de nacimiento

        // Mostrar los primeros 10 registros con paginación
        $nacimientos = DB::table('acta_nacimiento')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('nacimiento.index', compact('nacimientos'));
    }
    public function buscarActaNacimiento(Request $request)
    {
        $query = $request->input('query');
        $baseQuery = DB::table('acta_nacimiento')
            ->select('id', 'nombres', 'apellidos', 'f_nacimiento as fecha');

        if ($query) {
            $terminos = array_filter(explode(' ', trim($query)));

            if (count($terminos) > 1) {
                // Uso de whereRaw para mejor uso del índice
                $baseQuery->whereRaw('LOWER(nombres) LIKE ?', ['%' . strtolower($terminos[0]) . '%'])
                    ->whereRaw('LOWER(apellidos) LIKE ?', ['%' . strtolower($terminos[1]) . '%']);
            } else {
                $terminoBusqueda = strtolower($terminos[0]);
                $baseQuery->where(function($q) use ($terminoBusqueda) {
                    $q->whereRaw('LOWER(nombres) LIKE ?', ['%' . $terminoBusqueda . '%'])
                        ->orWhereRaw('LOWER(apellidos) LIKE ?', ['%' . $terminoBusqueda . '%']);
                });
            }
        } else {
            $baseQuery->latest('id');
        }

        $resultados = $baseQuery->paginate(10);

        return response()->json($resultados->through(function ($item) {
            $item->fecha = \Carbon\Carbon::parse($item->fecha)->format('d/m/Y');
            return $item;
        }));
    }


    public function index_matrimonio()
    {
        // Contar el total de actas de nacimiento

        // Mostrar los primeros 10 registros con paginación
        $matrimonios = DB::table('acta_matrimonio')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('matrimonio.index', compact('matrimonios'));
    }
    public function buscarActaMatrimonio(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            // Dividir el término de búsqueda en palabras (nombres y apellidos)
            $terms = explode(' ', $query);

            // Construir la consulta para combinar nombres y apellidos
            $resultadosNacimiento = DB::table('acta_matrimonio')
                ->select('id', 'nombres', 'apellidos', 'f_nacimiento as fecha')
                ->when(count($terms) > 1, function ($query) use ($terms) {
                    // Si hay dos términos, buscar como nombre y apellido
                    return $query->where('nombres', 'LIKE', "%{$terms[0]}%")
                        ->where('apellidos', 'LIKE', "%{$terms[1]}%");
                }, function ($query) use ($terms) {
                    // Si solo hay un término, buscar en ambos campos
                    return $query->where('nombres', 'LIKE', "%{$terms[0]}%")
                        ->orWhere('apellidos', 'LIKE', "%{$terms[0]}%");
                })
                ->paginate(10);
        } else {
            // Mostrar los primeros 10 registros cuando no hay búsqueda
            $resultadosNacimiento = DB::table('acta_matrimonio')
                ->select('id', 'nombres', 'apellidos', 'f_nacimiento as fecha')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        // Formatear la fecha de nacimiento
        $resultadosNacimiento->getCollection()->transform(function ($item) {
            $item->fecha = \Carbon\Carbon::parse($item->fecha)->format('d/m/Y');
            return $item;
        });

        // Devolver resultados en formato JSON
        return response()->json($resultadosNacimiento);
    }


    public function buscarActaDefuncion(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            // Dividir el término de búsqueda en palabras (nombres y apellidos)
            $terms = explode(' ', $query);

            // Construir la consulta para combinar nombres y apellidos
            $resultadosNacimiento = DB::table('acta_defuncion')
                ->select('id', 'nombres', 'apellidos', 'f_nacimiento as fecha')
                ->when(count($terms) > 1, function ($query) use ($terms) {
                    // Si hay dos términos, buscar como nombre y apellido
                    return $query->where('nombres', 'LIKE', "%{$terms[0]}%")
                        ->where('apellidos', 'LIKE', "%{$terms[1]}%");
                }, function ($query) use ($terms) {
                    // Si solo hay un término, buscar en ambos campos
                    return $query->where('nombres', 'LIKE', "%{$terms[0]}%")
                        ->orWhere('apellidos', 'LIKE', "%{$terms[0]}%");
                })
                ->paginate(10);
        } else {
            // Mostrar los primeros 10 registros cuando no hay búsqueda
            $resultadosNacimiento = DB::table('acta_defuncion')
                ->select('id', 'nombres', 'apellidos', 'f_nacimiento as fecha')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        // Formatear la fecha de nacimiento
        $resultadosNacimiento->getCollection()->transform(function ($item) {
            $item->fecha = \Carbon\Carbon::parse($item->fecha)->format('d/m/Y');
            return $item;
        });

        // Devolver resultados en formato JSON
        return response()->json($resultadosNacimiento);
    }

}
