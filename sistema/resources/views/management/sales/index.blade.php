@extends('template.administrador')

@section('title', 'VENTAS')
@section('name-section', 'VENTAS')
@section('description', 'Gestión de ventas')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Ventas')
@section('module-breadcrumb', 'Gestión')

@section('content')
<div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-12 col-md-3">
                <a href="{{ route('sales.create') }}" class="btn btn-primary rounded-3 text-uppercase text-white w-100">
                    <i class="bi bi-plus-lg me-2"></i>
                    <span class="small fw-medium">Nueva venta</span>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if(session('ok'))
            <div class="alert alert-success small" role="alert">{{ session('ok') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-sm table-hover w-100 bg-white">
                <thead>
                    <tr>
                        <th class="text-center align-middle text-uppercase small">Nº</th>
                        <th class="text-center align-middle text-uppercase small">Cliente</th>
                        <th class="text-center align-middle text-uppercase small">Vendedor</th>
                        <th class="text-center align-middle text-uppercase small">Total</th>
                        <th class="text-center align-middle text-uppercase small">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr>
                            <td class="text-center align-middle">{{ $sale->id }}</td>
                            <td class="text-start align-middle">{{ $sale->customer_name ?? '-' }}</td>
                            <td class="text-start align-middle">{{ $sale->user_name ?? '-' }}</td>
                            <td class="text-center align-middle">S/ {{ number_format($sale->total, 2) }}</td>
                            <td class="text-center align-middle">
                                @if (auth()->user()->hasRole('Administrador'))
                                    <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('¿Anular esta venta?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Anular</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-4">No hay ventas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
