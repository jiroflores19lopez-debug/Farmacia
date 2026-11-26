@extends('template.administrador')
@section('title', 'NUEVO CLIENTE')
@section('name-section', 'Nuevo cliente')
@section('description', 'Registra los datos del cliente')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Clientes')
@section('module-breadcrumb', 'Nuevo')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body"><form method="POST" action="{{ route('customers.store') }}">@csrf @include('management.customers._form')</form></div></div>
@endsection
