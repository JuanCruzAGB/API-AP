<nav id="nav-global" class="nav-menu">
    <header class="nav-row">
        <a href="#menu" class="sidebar-menu sidebar-button open">
            <i class="fas fa-bars"></i>
        </a>
        
        <a href="/inicio" class="nav-title">
            <picture>
                <source srcset="{{ asset('img/resources/logo/01-regular.png') }}"
                    media="(min-width: 768px)"/>
                <img src="{{ asset('img/resources/logo/03-small.png') }}" 
                    alt="Armentia Propiedades Logo"/>
            </picture>
            <h1>Armentia Propiedades</h1>
        </a>
    </header>

    <section class="nav-row">
        <ul class="nav-menu-list">
            <li>
                <a href="/inicio" class="nav-link Work-Sans">
                    <span>Inicio</span>
                </a>
            </li>
            <li>
                <a href="/propiedades" class="nav-link Work-Sans">
                    <span>Propiedades</span>
                </a>
            </li>
            <li>
                <a href="#contact" class="nav-link Work-Sans">
                    <span>Contacto</span>
                </a>
            </li>
            @if (Auth::check())
                <li>
                    <a href="/panel" class="nav-link Work-Sans">
                        <span>Panel</span>
                    </a>
                </li>
                <li>
                    <a href="/cerrar-sesion" class="nav-link Work-Sans">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar Sesión</span>
                    </a>
                </li>
            @endif
        </ul>
    </section>

    @component('components.nav.sidebar_left')
    @endcomponent
</nav>