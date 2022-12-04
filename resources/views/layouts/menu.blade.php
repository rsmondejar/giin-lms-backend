<li class="nav-item"><!-- //NOSONAR -->
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <em class="nav-icon fas fa-home"></em>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item"><!-- //NOSONAR -->
    <a href="{{ route('businesses.index') }}" class="nav-link {{ Request::is('businesses*') ? 'active' : '' }}">
        <em class="nav-icon fas fa-building"></em>
        <p>Empresas</p>
    </a>
</li>

<li class="nav-item"><!-- //NOSONAR -->
    <a href="{{ route('departments.index') }}" class="nav-link {{ Request::is('departments*') ? 'active' : '' }}">
        <em class="nav-icon fas fa-columns"></em>
        <p>Departamentos</p>
    </a>
</li>
