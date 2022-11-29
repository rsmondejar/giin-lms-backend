<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $business->id }}</p>
</div>

<!-- Business Name Field -->
<div class="col-sm-12">
    {!! Form::label('business_name', 'Nombre empresa:') !!}
    <p>{{ $business->business_name }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', 'Dirección:') !!}
    <p>{{ $business->address }}</p>
</div>

<!-- City Field -->
<div class="col-sm-12">
    {!! Form::label('city', 'Ciudad:') !!}
    <p>{{ $business->city }}</p>
</div>

<!-- Postal Code Field -->
<div class="col-sm-12">
    {!! Form::label('postal_code', 'Código Postal:') !!}
    <p>{{ $business->postal_code }}</p>
</div>

<!-- Country Field -->
<div class="col-sm-12">
    {!! Form::label('country', 'País:') !!}
    <p>{{ $business->country }}</p>
</div>

<!-- Phone Field -->
<div class="col-sm-12">
    {!! Form::label('phone', 'Teléfono físico:') !!}
    <p>{{ $business->phone }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'E-mail:') !!}
    <p>{{ $business->email }}</p>
</div>

<!-- Website Field -->
<div class="col-sm-12">
    {!! Form::label('website', 'Website:') !!}
    <p>{{ $business->website }}</p>
</div>

<!-- Logo Field -->
<div class="col-sm-12">
    {!! Form::label('logo', 'Logo:') !!}
    <p>{{ $business->logo }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado el:') !!}
    <p>{{ $business->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado el:') !!}
    <p>{{ $business->updated_at }}</p>
</div>

