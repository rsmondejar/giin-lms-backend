<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Nombre:') !!}
    <p tabindex="1">{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'E-mail:') !!}
    <p tabindex="2">{{ $user->email }}</p>
</div>

<!-- Department Id Field -->
<div class="col-sm-12">
    {!! Form::label('department_id', 'Departmento:') !!}
    <p tabindex="3">{{ $user->department->department_name }}</p>
</div>

<!-- Business Id Field -->
<div class="col-sm-12">
    {!! Form::label('department_id', 'Empresa:') !!}
    <p tabindex="4">{{ $user->business->business_name }}</p>
</div>
