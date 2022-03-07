@extends('layouts.panel')

@section('title')
    Panel | Armentia Propiedades
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/web/panel.css')}}">
@endsection

@section('tab-menu-list')
    <li id="tab-categorias" class="tab panel-tab-menu">
        <a href="#categorias" class="tab-button sidebar-link Work-Sans">
            <span>Categorías</span>
        </a>
    </li>
    <li id="tab-propiedades" class="tab panel-tab-menu">
        <a href="#propiedades" class="tab-button sidebar-link Work-Sans">
            <span>Propiedades</span>
        </a>
    </li>
    <li id="tab-ubicaciones" class="tab panel-tab-menu">
        <a href="#ubicaciones" class="tab-button sidebar-link Work-Sans">
            <span>Ubicaciónes</span>
        </a>
    </li>
@endsection

@section('tab-content-list')
    @component('components.category.table', [
        'categories' => $categories,
    ])@endcomponent
    @component('components.category.form')@endcomponent
    
    @component('components.property.table', [
        'properties' => $properties,
    ])@endcomponent
    @component('components.property.form', [
        'categories' => $categories,
        'locations' => $locations,
    ])@endcomponent

    @component('components.location.table', [
        'locations' => $locations,
    ])@endcomponent
    @component('components.location.form')@endcomponent
    
    <aside class="panel floating-menu bottom right">
        <a href="#" title="Agregar" class="tab panel-tab-menu tab-button add-data floating-button btn btn-red btn-background round">
            <i class="fas fa-plus"></i>
        </a>
    </aside>
@endsection

@section('js')
    <script>
        const categories = @json($categories);
        const locations = @json($locations);
        const properties = @json($properties);
        const validation = @json([
            'categories' => \App\Models\Category::$validation,
            'locations' => \App\Models\Location::$validation,
            'properties' => \App\Models\Property::$validation,
        ]);
    </script>
    <script type="module" src="{{asset('js/web/panel.js')}}"></script>
@endsection