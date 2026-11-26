@extends('template.administrador')

@section('title', 'VENTAS')
@section('name-section', 'VENTAS')
@section('description', 'Registrar venta')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Ventas')
@section('module-breadcrumb', 'Gestión')

@section('content')
<div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger small">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sales.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Cliente</label>
                    <select name="customer_id" class="form-select" required>
                        <option value="">Selecciona un cliente</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                                {{ $customer->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Vendedor</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                </div>

                <div class="col-md-8">
                    <label class="form-label small fw-semibold">Medicamento</label>
                    <select name="medicine_id" class="form-select" required>
                        <option value="">Selecciona un medicamento</option>
                        @foreach ($medicines as $medicine)
                            <option value="{{ $medicine->id }}" @selected(old('medicine_id') == $medicine->id)>
                                {{ $medicine->name }} - S/ {{ number_format($medicine->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Cantidad</label>
                    <input type="number" name="amount" value="{{ old('amount', 1) }}" class="form-control" min="1" required>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i>Registrar venta
                </button>
                <a href="{{ route('sales.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection
