<section id="sidebar-menu" class="sidebar left closed">
    <main class="sidebar-body">
        <header class="sidebar-header">
            <section class="sidebar-title">
                <img src="{{asset('img/resources/logo/03-small.png')}}" alt="Armentia Propiedades Logo"/>

                <h2 class="none">Armentia Propiedades</h2>
            </section>

            <a href="#_" class="sidebar-menu sidebar-button close">
                <i class="fas fa-times"></i>
            </a>
        </header>

        <nav class="sidebar-content">
            <ul class="sidebar-menu-list">
                <li>
                    <a href="/properties" class="sidebar-link nav-link Work-Sans">
                        <span>Propiedades</span>
                    </a>
                </li>

                <li>
                    <a href="#contacto" class="sidebar-link nav-link Work-Sans">
                        <span>Contacto</span>
                    </a>
                </li>

                @if (Auth::check())
                    <li>
                        <a href="/panel" class="sidebar-link nav-link Work-Sans">
                            <span>Panel</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="/logout" class="sidebar-link nav-link Work-Sans">
                            <span>Cerrar Sesión</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </main>
</section>