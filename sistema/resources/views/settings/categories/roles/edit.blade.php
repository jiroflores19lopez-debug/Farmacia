@extends('template.administrador')

@section('title', 'CATEGORIAS')
@section('name-section', 'CATEGORIAS')

@section('description', 'actualizar registro de categoria')
@section('item-breadcrumb', 'actualizar')
@section('section-breadcrumb', 'Categorías')
@section('module-breadcrumb', 'Configuraciones')


@section('content')
<div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary">
                <div class="card-body">
                    <form action="{{route('categories.update', $category->id)}}" method="POS1">
                    
                    @csrf
                    @method('put')
                    @include('settings.categories._form')
                    </form>
                </div>
            </div>


@endsection