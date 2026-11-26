@extends('template.administrador')
@section('title', 'EDITAR CLIENTE')
@section('name-section', 'Editar cliente')
@section('description', 'Actualiza los datos del cliente')
@section('item-breadcrumb', 'Inicio')
@section('section-breadcrumb', 'Clientes')
@section('module-breadcrumb', 'Editar')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body"><form method="POST" action="{{ route('customers.update', $customer) }}">@csrf @method('PUT') @include('management.customers._form')</form></div></div>
@endsection
