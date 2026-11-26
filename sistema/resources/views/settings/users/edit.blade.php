@extends('template.administrador')
@section('title', 'EDITAR USUARIO')
@section('name-section', 'Editar usuario')
@section('description', 'Actualiza los datos de acceso')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Usuarios')
@section('module-breadcrumb', 'Editar')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body"><form method="POST" action="{{ route('users.update', $user) }}">@csrf @method('PUT') @include('settings.users._form')</form></div></div>
@endsection
