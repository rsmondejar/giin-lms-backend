<li class="nav-item"><!-- //NOSONAR -->
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <em class="nav-icon fas fa-home"></em>
        <p>Dashboard</p>
    </a>
</li>

@can('list users')
<li class="nav-item"><!-- //NOSONAR -->
    <a
        href="{{ route('team-holidays.index') }}"
        class="nav-link {{ Request::is('team-holidays.index') ? 'active' : '' }}"
    >
        <em class="nav-icon fas fa-calendar"></em>
        <p>Vacaciones del equipo</p>
    </a>
</li>
@endcan

@can('list users')
<li class="nav-item"><!-- //NOSONAR -->
    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <em class="nav-icon fas fa-users"></em>
        <p>Usuarios</p>
    </a>
</li>
@endcan

@can('list businesses')
<li class="nav-item"><!-- //NOSONAR -->
    <a href="{{ route('businesses.index') }}" class="nav-link {{ Request::is('businesses*') ? 'active' : '' }}">
        <em class="nav-icon fas fa-building"></em>
        <p>Empresas</p>
    </a>
</li>
@endcan

@can('list departments')
<li class="nav-item"><!-- //NOSONAR -->
    <a href="{{ route('departments.index') }}" class="nav-link {{ Request::is('departments*') ? 'active' : '' }}">
        <em class="nav-icon fas fa-columns"></em>
        <p>Departamentos</p>
    </a>
</li>
@endcan

@can('list public holidays')
<li class="nav-item"><!-- //NOSONAR -->
    <a
        href="{{ route('public-holidays.index') }}"
        class="nav-link {{ Request::is('public-holidays*') ? 'active' : '' }}"
    >
        <em class="nav-icon fas fa-calendar"></em>
        <p>Dias Festivos</p>
    </a>
</li>
@endcan
