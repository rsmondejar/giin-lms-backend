<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Nombre del Role:') !!}
    <p tabindex="1">{{ $role->name }}</p>
</div>

<!-- Guard Name Field -->
<div class="col-sm-12">
    {!! Form::label('guard_name', 'Nombre del Guard:') !!}
    <p tabindex="2">{{ $role->guard_name }}</p>
</div>

