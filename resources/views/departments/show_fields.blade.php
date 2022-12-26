<!-- Department Name Field -->
<div class="col-sm-12">
    {!! Form::label('department_name', 'Nombre del departamento:') !!}
    <p tabindex="1">{{ $department->department_name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado el:') !!}
    <p tabindex="2">{{ $department->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado el:') !!}
    <p tabindex="3">{{ $department->updated_at }}</p>
</div>
