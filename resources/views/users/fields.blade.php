<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'required' => true,
        'maxlength' => \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH,
        'placeHolder' => 'Nombre del usuario',
        'aria-describedby' => "nameHelpBlock",
    ]) !!}
    <small id="nameHelpBlock" class="form-text text-muted">
        Longitud máxima: {!! \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH !!} caracteres
    </small>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'E-mail:') !!}
    {!! Form::email('email', null, [
        'class' => 'form-control',
        'required' => true,
        'maxlength' => \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH,
        'placeHolder' => 'E-mai del usuario',
        'aria-describedby' => "emailHelpBlock",
    ]) !!}
    <small id="emailHelpBlock" class="form-text text-muted">
        Longitud máxima: {!! \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH !!} caracteres
    </small>
</div>

<!-- password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Contraseña:') !!}
    {!! Form::password('password', [
        'class' => 'form-control',
        'autocomplete' => 'off',
    ]) !!}
</div>

<!-- Business Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('business_id', 'Empresa:') !!}
    {!! Form::select('business_id', $businesses, null, ['class' => 'form-control js-select2']) !!}
</div>

<!-- Department Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department_id', 'Departamento:') !!}
    {!! Form::select('department_id', $departments, null, ['class' => 'form-control js-select2']) !!}
</div>
