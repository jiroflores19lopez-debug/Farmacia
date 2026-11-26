@extends('template.administrador')
@section('title', 'USUARIOS')
@section('name-section', 'Usuarios')
@section('description', 'Cuentas que pueden acceder al sistema')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Configuraciones')
@section('module-breadcrumb', 'Usuarios')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-header bg-white d-flex justify-content-between align-items-center"><h2 class="h6 mb-0">Usuarios ({{ $users->count() }})</h2><a class="btn btn-primary text-white" href="{{ route('users.create') }}">Nuevo usuario</a></div><div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>Nombre</th><th>Correo</th><th>DNI</th><th>Rol</th><th>Teléfono</th><th>Acciones</th></tr></thead><tbody>
@forelse ($users as $user)
<tr><td>{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->dni }}</td><td>{{ $user->role?->name ?? '—' }}</td><td>{{ $user->phone ?: '—' }}</td><td class="d-flex gap-2"><a class="btn btn-sm btn-outline-primary" href="{{ route('users.edit', $user) }}">Editar</a><form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button></form></td></tr>
@empty
<tr><td colspan="6" class="text-center text-secondary py-4">Aún no hay usuarios registrados.</td></tr>
@endforelse
</tbody></table></div></div>
@endsection
