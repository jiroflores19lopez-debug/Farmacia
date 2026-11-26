@extends('template.administrador')
@section('title', 'EDITAR MEDICAMENTO')
@section('name-section', 'Editar medicamento')
@section('description', 'Actualiza el inventario')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Medicamentos')
@section('module-breadcrumb', 'Editar')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body"><form method="POST" action="{{ route('medicines.update', $medicine) }}">@csrf @method('PUT') @include('management.medicines._form')</form></div></div>
@endsection
