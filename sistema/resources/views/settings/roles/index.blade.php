@extends('template.administrador')

@section('title', 'ROLES')
@section('name-section', 'ROLES')
@section('description', 'Listado de roles')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Roles')
@section('module-breadcrumb', 'Configuraciones')

@section('content')
<div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-12 col-md-3">
                <a href="{{ route('roles.create') }}" class="btn btn-primary rounded-3 text-uppercase text-white w-100">
                    <i class="bi bi-plus-lg me-2"></i>
                    <span class="small fw-medium">Nuevo rol</span>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if(session('ok'))
            <div class="alert alert-success small" role="alert">{{ session('ok') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger small" role="alert">{{ session('error') }}</div>
        @endif

        <h6 class="text-uppercase small text-muted mb-3">
            Total de registros encontrados: {{ $roles->count() }}
        </h6>

        <div class="table-responsive">
            <table class="table table-sm table-hover w-100 bg-white">
                <thead>
                    <tr>
                        <th class="text-center align-middle text-uppercase small">Nº</th>
                        <th class="text-center align-middle text-uppercase small">Nombre</th>
                        <th class="text-center align-middle text-uppercase small">Descripción</th>
                        <th class="text-center align-middle text-uppercase small">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $index => $role)
                        <tr>
                            <td class="text-center align-middle">{{ $index + 1 }}</td>
                            <td class="text-start align-middle">{{ $role->name }}</td>
                            <td class="text-start align-middle">{{ $role->description ?? '-' }}</td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('roles.edit', $role) }}">Editar</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('roles.destroy', $role) }}" method="POST" onsubmit="return confirm('¿Eliminar este rol?')">
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
                            <td colspan="4" class="text-center text-secondary py-4">No hay roles registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
