<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">LMS</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')

                @hasrole('super-admin')
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                        <em class="nav-icon fas fa-user-cog"></em>
                        <p>Roles</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('permissions.index') }}"
                        class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}"
                    >
                        <em class="nav-icon fas fa-user-cog"></em>
                        <p>Permisos</p>
                    </a>
                </li>
                @endhasrole

                @hasrole('super-admin')
                <li class="nav-item"><!-- //NOSONAR -->
                    <a href="{{ route('io_generator_builder') }}" class="nav-link" target="_blanl" rel="noopener">
                        <em class="nav-icon fas fa-cogs"></em>
                        <p>Builder Generator</p>
                    </a>
                </li>
                @endhasrole
            </ul>
        </nav>
    </div>

</aside>
