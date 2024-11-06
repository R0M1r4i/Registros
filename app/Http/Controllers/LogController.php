<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $searchType = $request->input('search_type');

        $logs = DB::table('logs')
            ->join('usuario', 'logs.id_usuario', '=', 'usuario.id_usuario')
            ->select(
                'logs.*',
                'usuario.nombres as usuario_nombres',
                'usuario.apellidos as usuario_apellidos'
            )
            ->when($query, function ($queryBuilder) use ($query, $searchType) {
                $terms = explode(' ', $query);

                if ($searchType === 'usuario') {
                    // Búsqueda combinada en nombres y apellidos del usuario
                    $queryBuilder->where(function ($q) use ($terms) {
                        foreach ($terms as $term) {
                            $q->where('usuario.nombres', 'LIKE', "%$term%")
                                ->orWhere('usuario.apellidos', 'LIKE', "%$term%");
                        }
                    });
                } elseif ($searchType === 'registrado') {
                    // Búsqueda combinada en los cambios para nombre completo de persona registrada
                    $queryBuilder->where(function ($q) use ($terms) {
                        foreach ($terms as $term) {
                            $q->where('logs.cambios', 'LIKE', "%$term%");
                        }
                    });
                }
            })
            ->orderBy('logs.created_at', 'desc')
            ->paginate(10); // Agrega paginación

        return view('logs.index', compact('logs'));
    }

}
