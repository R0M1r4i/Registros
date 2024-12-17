<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActaDefuncion;
use App\Models\Matrimonio;
use App\Models\nacimiento;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function getActasMensuales()
    {
        // Obtener actas de defunción por mes
        $defuncionPorMes = ActaDefuncion::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->get();

        // Obtener actas de nacimiento por mes
        $nacimientoPorMes = nacimiento::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->get();

        // Obtener actas de matrimonio por mes
        $matrimonioPorMes = Matrimonio::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->get();

        // Combinamos los datos en un solo array para cada mes
        $actasPorMes = [];
        foreach (range(1, 12) as $month) {
            $actasPorMes[] = [
                'year' => now()->year,
                'month' => $month,
                'defuncion' => $defuncionPorMes->firstWhere('month', $month)->count ?? 0,
                'nacimiento' => $nacimientoPorMes->firstWhere('month', $month)->count ?? 0,
                'matrimonio' => $matrimonioPorMes->firstWhere('month', $month)->count ?? 0,
            ];
        }

        return response()->json($actasPorMes);
    }

    public function getTotalesPorCategoria()
    {
        $totalDefuncion = ActaDefuncion::count();
        $totalNacimiento = nacimiento::count();
        $totalMatrimonio = Matrimonio::count();

        return response()->json([
            'defuncion' => $totalDefuncion,
            'nacimiento' => $totalNacimiento,
            'matrimonio' => $totalMatrimonio,
        ]);
    }
}
