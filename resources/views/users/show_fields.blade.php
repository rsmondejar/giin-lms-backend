<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Nombre:') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'E-mail:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Department Id Field -->
<div class="col-sm-12">
    {!! Form::label('department_id', 'Departmento:') !!}
    <p>{{ $user->department->department_name }}</p>
</div>

<!-- Business Id Field -->
<div class="col-sm-12">
    {!! Form::label('department_id', 'Empresa:') !!}
    <p>{{ $user->business->business_name }}</p>
</div>
