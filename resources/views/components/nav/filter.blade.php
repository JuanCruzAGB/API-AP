<nav id="nav-filter" class="nav-menu p-0">
    <div class="nav-row">
        <a href="#menu" class="sidebar-menu sidebar-button open">
            <i class="sidebar-icon fas fa-bars"></i>
        </a>
        
        <a href="/inicio" class="nav-title logo">
            <picture>
                <source srcset="{{asset('img/resources/logo/01-regular.png')}}"
                    media="(min-width: 768px)"/>
                <img src="{{asset('img/resources/logo/03-small.png')}}" 
                    alt="Armentia Propiedades Logo"/>
            </picture>
            <h1>Armentia Propiedades</h1>
        </a>
        
        <a href="#filters" class="filters sidebar-button open">
            <i class="sidebar-icon fas fa-filter"></i>
        </a>
    </div>

    <div class="nav-row">
        <ul class="nav-menu-list">
            <li><a href="/inicio" class="nav-link p-0">
                Inicio
            </a></li>
            <li><a href="/propiedades" class="nav-link p-0">
                Propiedades
            </a></li>
            @if (Auth::check())
                <li><a href="/panel" class="nav-link p-0">
                    Panel
                </a></li>
                <li><a href="/cerrar-sesion" class="nav-link p-0">
                    <i class="link-icon left fas fa-sign-out-alt"></i>
                    <span class="link-text">Cerrar Sesión</span>
                </a></li>
            @endif
        </ul>
    </div>

    {{-- <div class="nav-row">
        <ul class="nav-menu-list">
            <li id="dropdown-tipo_propiedades" class="dropdown closed">
                <a href="#" class="nav-link dropdown-header">
                    <span class="link-text">Tipo de Propiedad</span>
                    <button class="dropdown-button">
                        <i class="dropdown-icon fas fa-sort-down"></i>
                    </button>
                </a>
                <ul class="dropdown-menu-list p-0">
                    @foreach ($categories as $category)
                        <li class="m-0"><a href="#filter?category={{ $category->slug }}" data-target="{{ $category->id_category }}" class="filter filter-select nav-link dropdown-link">
                            {{ $category->name }}
                        </a></li>
                    @endforeach
                </ul>
            </li>
            <li id="dropdown-ciudad" class="dropdown closed m-0">
                <a href="#" class="nav-link dropdown-header">
                    <span class="link-text">Ciudad</span>
                    <button class="dropdown-button">
                        <i class="dropdown-icon fas fa-sort-down"></i>
                    </button>
                </a>
                <ul class="dropdown-menu-list p-0">
                    @foreach ($locations as $location)
                        <li class="m-0"><a href="#filter?location={{ $location->slug }}" data-target="{{ $location->id_location }}" class="filter filter-select nav-link dropdown-link">
                            {{ $location->name }}
                        </a></li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div> --}}

    @component('components.nav.sidebar_left')
    @endcomponent
    @component('components.nav.sidebar_right')
    @endcomponent
</nav>