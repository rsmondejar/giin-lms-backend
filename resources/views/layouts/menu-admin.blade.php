@hasrole('super-admin')
<li><hr/></li><!-- //NOSONAR -->

<li class="nav-item"><!-- //NOSONAR -->
    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <em class="nav-icon fas fa-user-cog"></em>
        <p>Roles</p>
    </a>
</li>

<li class="nav-item"><!-- //NOSONAR -->
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
    <a href="{{ route('io_generator_builder') }}" class="nav-link" target="_blank" rel="noopener">
        <em class="nav-icon fas fa-cogs"></em>
        <p>Builder Generator</p>
    </a>
</li>
@endhasrole

@hasrole('super-admin')
<li class="nav-item">{{--<!-- //NOSONAR -->--}}
    <a href="/{!! Config::get('log-viewer.route_path') !!}" class="nav-link" target="_blank" rel="noopener">
        <em class="nav-icon fa fa-file-alt"></em>
        <span>Log Viewer</span>
    </a>
</li>
@endhasrole

@hasrole('super-admin')
<li class="nav-item"><!-- //NOSONAR -->
    <a href="{{ route('audit.index') }}" class="nav-link {{ Request::is('audit*') ? 'active' : '' }}">
        <em class="nav-icon fas fa-shoe-prints"></em>
        <p>Audit Log</p>
    </a>
</li>
@endhasrole
