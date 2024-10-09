<style>
    .chart-container {
        position: relative;
        width: 900px; /* Ajusta el ancho aquí */
        height: 700px; /* Ajusta la altura aquí */
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('') }}
        </h2>        
    </x-slot>  
    <br>
    <div class="container mt-4">
        <h4>Resumen de Fuentes</h4>
        <br>
        <canvas id="fuentesChart" width="600" height="300"></canvas>
        <br><br>
        <h4 style="float:right">Total de Fuentes: {{ $total }}</h4>

        <script>            
            const ctx = document.getElementById('fuentesChart').getContext('2d');
            const fuentesChart = new Chart(ctx, {
                type: 'bar', // Tipo de gráfico
                data: {
                    labels: ['Activas', 'De Baja','totalUso','totalNoCalibrada','Sin Estado Definido', 'A', 'B', 'C'], // Etiquetas para el eje X
                    datasets: [{
                        label: 'Total de Fuentes',
                        data: [
                            {{ $totalActivas }},
                            {{ $totalBajas }},
                            {{ $totalUso }},
                            {{ $totalNoCalibrada }},
                            {{ $totalSinEstado }},
                            {{ $totalA }},
                            {{ $totalB }},
                            {{ $totalC }}
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',   
                            'rgba(100, 100, 100, 0.2)',  
                            'rgba(75, 192, 75, 0.2)'     
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(100, 100, 100, 0.2)',    
                            'rgba(75, 192, 75, 0.2)'     
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true // Iniciar el eje Y en cero
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Desactivar la leyenda
                        }
                    }
                }
            });
        </script>
</x-app-layout>