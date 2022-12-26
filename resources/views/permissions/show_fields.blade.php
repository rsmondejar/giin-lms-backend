<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Nombre del permiso:') !!}
    <p tabindex="1">{{ $permission->name }}</p>
</div>

<!-- Guard Name Field -->
<div class="col-sm-12">
    {!! Form::label('guard_name', 'Nombre del Guard:') !!}
    <p tabindex="2">{{ $permission->guard_name }}</p>
</div>

