@extends('backend.app')

@section('content')
<div class="container-fluid dashboard-container">
    <div class="page-inner">
        <h3 class="fw-bold mb-3">Dashboard Overview</h3>

        <!-- Kartu Statistik -->
        <div class="row">
            @php
                $cards = [
                    ['title' => 'Students', 'count' => $students, 'icon' => 'fas fa-users', 'color' => 'primary'],
                    ['title' => 'Teachers', 'count' => $teachers, 'icon' => 'fas fa-user-check', 'color' => 'info'],
                    ['title' => 'Mata Pelajaran', 'count' => $matapelajaran, 'icon' => 'fas fa-book', 'color' => 'warning']
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="col-sm-6 col-md-3 mb-3">
                    <div class="card card-stats card-{{ $card['color'] }} card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center text-light">
                                        <i class="{{ $card['icon'] }} fa-2x"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">{{ $card['title'] }}</p>
                                        <h4 class="card-title">{{ $card['count'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Grafik -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center">Data Statistik</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="chartPie"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4 class="text-center">Ranking Nilai</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="chartBar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

<!-- Tambahkan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Data untuk Pie Chart
        var ctxPie = document.getElementById("chartPie");
        if (ctxPie) {
            var chartData = {!! json_encode($chartData) !!};

            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Students', 'Teachers', 'Mata Pelajaran'],
                    datasets: [{
                        data: [chartData.students, chartData.teachers, chartData.matapelajaran],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                        borderColor: ['#ffffff', '#ffffff', '#ffffff'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Data untuk Bar Chart (Ranking Nilai)
        var ctxBar = document.getElementById("chartBar");
        if (ctxBar) {
            var nilaiRanks = {!! json_encode($nilaiRanks) !!};

            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['A (85-100)', 'B (70-84)', 'C (55-69)', 'D (40-54)', 'E (<40)'],
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: [nilaiRanks.A, nilaiRanks.B, nilaiRanks.C, nilaiRanks.D, nilaiRanks.E],
                        backgroundColor: ['#28a745', '#007bff', '#ffc107', '#fd7e14', '#dc3545'],
                        borderColor: ['#ffffff', '#ffffff', '#ffffff', '#ffffff', '#ffffff'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1, // Pastikan angka naik dalam kelipatan 1
                                precision: 0  // Hapus angka desimal
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    });
</script>

<!-- Tambahkan CSS -->
<style>
    html, body {
        height: 100%;
        overflow-y: auto;
    }

    .dashboard-container {
        min-height: 100vh;
        overflow-y: auto;
        padding-bottom: 20px;
    }

    .chart-container {
        max-height: 400px;
        overflow-y: auto;
    }
</style>
