<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 30px; }
        .card { border-radius: 10px; }
        .form-label { margin-top: 10px; font-weight: bold; }
        .btn-primary { background: #007bff; border: none; }
        .btn-secondary { background: #6c757d; border: none; }
    </style>
</head>
<body>
@extends('template.administrador')

@section('title', 'USUARIOS')
@section('name-section', 'USUARIOS')
@section('description', 'Registrar nuevo usuario')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Usuarios')
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

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nombre completo</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">DNI</label>
                    <input type="text" name="dni" maxlength="8" value="{{ old('dni') }}" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Teléfono</label>
                    <input type="text" name="phone" maxlength="9" value="{{ old('phone') }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Matrícula</label>
                    <input type="text" name="tuition" value="{{ old('tuition') }}" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Contraseña</label>
                    <input type="password" name="password" minlength="8" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Rol</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">Selecciona un rol</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i>Registrar usuario
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection
</body>
</html>
