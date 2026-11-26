@extends('template.administrador')

@section('title', 'ROLES')
@section('name-section', 'ROLES')
@section('description', 'Registrar nuevo rol')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Roles')
@section('module-breadcrumb', 'Configuraciones')

@section('content')
<div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger small" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label small fw-semibold">Nombre</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label small fw-semibold">Descripción</label>
                    <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i>Registrar rol
                </button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection
