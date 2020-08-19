<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('admin.index') }}" class="nav-link {{ request()->is('escritorio') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Escritorio
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview {{ request()->is('admin/errores*') ? 'menu-open' : '' }}">
            <a href="" class="nav-link {{ request()->is('admin/errores*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-bug"></i>
                <p>
                    Errores
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->is('admin/errores') ? 'active' : '' }}">
                        <i class="{{ request()->is('admin/errores') ? 'fa' : 'far' }} fa-circle nav-icon"></i>
                        <p>Ver Errores</p>
                    </a>
                </li>
                @if(request()->is('admin/errores/show*'))
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->is('admin/errores/show*') ? 'active' : '' }}">
                        <i class="{{ request()->is('admin/errores/show*') ? 'fa' : 'far' }} fa-circle nav-icon"></i>
                        <p>Atender Error</p>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        <li class="nav-item mt-4">
            <a href="{{ route('logout') }}" class="nav-link salirAlerta">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                    Cerrar Sesión
                </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->