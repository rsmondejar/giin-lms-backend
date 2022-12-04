<!-- Department Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department_name', 'Nombre del departamento:') !!}
    {!! Form::text('department_name', null, [
        'class' => 'form-control',
        'required' => true,
        'maxlength' => '60',
        'placeHolder' => 'Nombre de la empresa',
        'aria-describedby' => "department_nameHelpBlock",
    ]) !!}
    <small id="department_nameHelpBlock" class="form-text text-muted">Longitud máxima: 60 caracteres</small>
</div>
