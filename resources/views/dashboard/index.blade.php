
@extends('layout.app')

@section('content')

    <style>
        .chart-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .chart-card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .chart-card canvas {
            max-width: 100%;
            max-height: 400px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Contenedor para los gráficos -->
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <!-- Gráfico de Actas Mensuales -->
                <div class="col-6">
                    <div class="card chart-card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Actas Creadas Mensualmente</h5>
                            <canvas id="actasMensualesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Gráfico de Actas por Categoría -->
                <div class="col-6">
                    <div class="card chart-card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Total de Actas por Categoría</h5>
                            <canvas id="actasPorCategoriaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



<!-- Script para cargar el gráfico -->
<script>
    fetch('/dashboard/actas-mensuales')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => `${item.month}/${item.year}`);
            const defuncionData = data.map(item => item.defuncion);
            const nacimientoData = data.map(item => item.nacimiento);
            const matrimonioData = data.map(item => item.matrimonio);

            const ctx = document.getElementById('actasMensualesChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Actas de Defunción',
                            data: defuncionData,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Actas de Nacimiento',
                            data: nacimientoData,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Actas de Matrimonio',
                            data: matrimonioData,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/dashboard/totales-por-categoria')
                .then(response => response.json())
                .then(data => {
                    // Crear el gráfico de pastel
                    const ctx = document.getElementById('actasPorCategoriaChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Defunción', 'Nacimiento', 'Matrimonio'],
                            datasets: [{
                                data: [data.defuncion, data.nacimiento, data.matrimonio],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.5)',    // Color para Defunción
                                    'rgba(54, 162, 235, 0.5)',    // Color para Nacimiento
                                    'rgba(75, 192, 192, 0.5)'     // Color para Matrimonio
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(75, 192, 192, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            label += context.raw;
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        });
    </script>

@endsection
