<!-- Department Name Field -->
<div class="col-sm-12">
    {!! Form::label('department_name', 'Nombre del departamento:') !!}
    <p>{{ $department->department_name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado el:') !!}
    <p>{{ $department->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado el:') !!}
    <p>{{ $department->updated_at }}</p>
</div>
