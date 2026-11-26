@extends('template.administrador')

@section('title', 'REPORTES')
@section('name-section', 'REPORTES')
@section('description', 'Reportes y estadísticas del sistema')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Reportes')
@section('module-breadcrumb', 'Principal')

@section('content')
<div class="row g-4">
    <div class="col-12 col-xl-4">
        <div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary h-100">
            <div class="card-header bg-white"><h6 class="mb-0">Ventas por categoría</h6></div>
            <div class="card-body"><canvas id="categoryChart"></canvas></div>
        </div>
    </div>

    <div class="col-12 col-xl-8">
        <div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary h-100">
            <div class="card-header bg-white"><h6 class="mb-0">Ventas de los últimos 7 días</h6></div>
            <div class="card-body"><canvas id="dailyChart"></canvas></div>
        </div>
    </div>

    <div class="col-12">
        <div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary">
            <div class="card-header bg-white"><h6 class="mb-0">Medicamentos más vendidos</h6></div>
            <div class="card-body"><canvas id="medicineChart"></canvas></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/chart.umd.min.js') }}"></script>
<script>
    // Convierte los datos recopilados por el controlador para JavaScript.
    const categoryLabels = @json($salesByCategory->pluck('name')->values()->all());
    const categoryData = @json($salesByCategory->pluck('total')->values()->all());
    const dailyLabels = @json($dailySales->pluck('label')->values()->all());
    const dailyData = @json($dailySales->pluck('total')->values()->all());
    const medicineLabels = @json($topMedicines->pluck('name')->values()->all());
    const medicineData = @json($topMedicines->pluck('amount')->values()->all());

    if (typeof Chart !== 'undefined') {
        new Chart(document.getElementById('categoryChart'), {
            type: 'doughnut',
            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryData,
                    backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1', '#20c997']
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });

        new Chart(document.getElementById('dailyChart'), {
            type: 'line',
            data: {
                labels: dailyLabels,
                datasets: [{
                    label: 'Ventas (S/) ',
                    data: dailyData,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.15)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true } }
            }
        });

        new Chart(document.getElementById('medicineChart'), {
            type: 'bar',
            data: {
                labels: medicineLabels,
                datasets: [{
                    label: 'Unidades vendidas',
                    data: medicineData,
                    backgroundColor: '#198754'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
            }
        });
    } else {
        console.error('No se pudo cargar Chart.js desde public/js/chart.umd.min.js');
    }
</script>
@endpush
