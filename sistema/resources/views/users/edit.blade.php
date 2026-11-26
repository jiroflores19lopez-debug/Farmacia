<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
</head>
<body>
@extends('template.administrador')

@section('title', 'USUARIOS')
@section('name-section', 'USUARIOS')
@section('description', 'Editar usuario')
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

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Nombre completo</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">DNI</label>
                    <input type="text" name="dni" maxlength="8" value="{{ old('dni', $user->dni) }}" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Teléfono</label>
                    <input type="text" name="phone" maxlength="9" value="{{ old('phone', $user->phone) }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Matrícula</label>
                    <input type="text" name="tuition" value="{{ old('tuition', $user->tuition) }}" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Nueva contraseña</label>
                    <input type="password" name="password" minlength="8" class="form-control"
                           placeholder="Dejar vacío para no cambiarla">
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Rol</label>
                    <select name="role_id" class="form-select" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id) == $role->id)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i>Guardar cambios
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
