@extends('template.administrador')
@section('title', 'NUEVO MEDICAMENTO')
@section('name-section', 'Nuevo medicamento')
@section('description', 'Registra un producto en inventario')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Medicamentos')
@section('module-breadcrumb', 'Nuevo')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
@if ($categories->isEmpty())<div class="alert alert-warning">Primero necesitas <a href="{{ route('categories.create') }}">crear una categoría</a>.</div>@endif
<form method="POST" action="{{ route('medicines.store') }}">@csrf @include('management.medicines._form')</form></div></div>
@endsection
