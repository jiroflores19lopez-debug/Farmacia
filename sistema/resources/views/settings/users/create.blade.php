@extends('template.administrador')
@section('title', 'NUEVO USUARIO')
@section('name-section', 'Nuevo usuario')
@section('description', 'Crea una cuenta y asigna su rol')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Usuarios')
@section('module-breadcrumb', 'Nuevo')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body"><form method="POST" action="{{ route('users.store') }}">@csrf @include('settings.users._form')</form></div></div>
@endsection
