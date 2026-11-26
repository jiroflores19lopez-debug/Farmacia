@extends('template.administrador')

@section('title', 'USUARIOS')
@section('name-section', 'USUARIOS')
@section('description', 'Listado de usuarios')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Usuarios')
@section('module-breadcrumb', 'Configuraciones')

@section('content')
<div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-12 col-md-3">
                <a href="{{ route('users.create') }}" class="btn btn-primary rounded-3 text-uppercase text-white w-100">
                    <i class="bi bi-plus-lg me-2"></i>
                    <span class="small fw-medium">Nuevo usuario</span>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success small" role="alert">{{ session('success') }}</div>
        @endif

        <h6 class="text-uppercase small text-muted mb-3">
            Total de registros encontrados: {{ $users->count() }}
        </h6>

        <div class="table-responsive">
            <table class="table table-sm table-hover w-100 bg-white">
                <thead>
                    <tr>
                        <th class="text-center align-middle text-uppercase small">Nº</th>
                        <th class="text-center align-middle text-uppercase small">Nombre</th>
                        <th class="text-center align-middle text-uppercase small">DNI</th>
                        <th class="text-center align-middle text-uppercase small">Teléfono</th>
                        <th class="text-center align-middle text-uppercase small">Correo</th>
                        <th class="text-center align-middle text-uppercase small">Rol</th>
                        <th class="text-center align-middle text-uppercase small">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td class="text-center align-middle">{{ $index + 1 }}</td>
                            <td class="text-start align-middle">{{ $user->name }}</td>
                            <td class="text-center align-middle">{{ $user->dni }}</td>
                            <td class="text-center align-middle">{{ $user->phone }}</td>
                            <td class="text-start align-middle">{{ $user->email }}</td>
                            <td class="text-center align-middle">{{ $user->role?->name ?? 'Sin rol' }}</td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('users.edit', $user) }}">Editar</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">Eliminar</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-secondary py-4">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
