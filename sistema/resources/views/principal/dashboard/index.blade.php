@extends('template.administrador')

@section('title', 'DASHBOARD')
@section('name-section', 'DASHBOARD')
@section('description', 'Graficos y KPIs')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Dashboard')
@section('module-breadcrumb', 'Principal')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3"><div class="card border-0 shadow-sm"><div class="card-body"><div class="text-secondary small">Ventas registradas</div><div class="h3 mb-0">{{ $salesCount }}</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="card border-0 shadow-sm"><div class="card-body"><div class="text-secondary small">Ingresos totales</div><div class="h3 mb-0">S/ {{ number_format((float) $salesTotal, 2) }}</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="card border-0 shadow-sm"><div class="card-body"><div class="text-secondary small">Clientes</div><div class="h3 mb-0">{{ $customersCount }}</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="card border-0 shadow-sm"><div class="card-body"><div class="text-secondary small">Stock bajo</div><div class="h3 mb-0">{{ $lowStockCount }}</div></div></div></div>
</div>

<div class="row g-3">
    <div class="col-xl-8"><div class="card border-0 shadow-sm"><div class="card-header bg-white">Ventas de los ultimos 7 dias</div><div class="card-body"><canvas id="salesChart"></canvas></div></div></div>
    <div class="col-xl-4"><div class="card border-0 shadow-sm"><div class="card-header bg-white">Top medicamentos</div><div class="card-body"><canvas id="medicineChart"></canvas></div></div></div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/chart.umd.min.js') }}"></script>
<script>
const salesLabels = @json($salesByDay->pluck('day')->values());
const salesData = @json($salesByDay->pluck('total')->values());
const medicineLabels = @json($topMedicines->pluck('name')->values());
const medicineData = @json($topMedicines->pluck('amount')->values());

if (typeof Chart !== 'undefined') {
    new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: { labels: salesLabels, datasets: [{ label: 'Ventas (S/)', data: salesData, borderColor: '#0d6efd', backgroundColor: 'rgba(13,110,253,.12)', fill: true, tension: .3 }] },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
    new Chart(document.getElementById('medicineChart'), {
        type: 'bar',
        data: { labels: medicineLabels, datasets: [{ label: 'Unidades', data: medicineData, backgroundColor: '#198754' }] },
        options: { responsive: true, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });
}
</script>
@endpush