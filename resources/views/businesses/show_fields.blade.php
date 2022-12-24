<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p tabindex="1">{{ $business->id }}</p>
</div>

<!-- Business Name Field -->
<div class="col-sm-12">
    {!! Form::label('business_name', 'Nombre empresa:') !!}
    <p tabindex="2">{{ $business->business_name }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', 'Dirección:') !!}
    <p tabindex="3">{{ $business->address }}</p>
</div>

<!-- City Field -->
<div class="col-sm-12">
    {!! Form::label('city', 'Ciudad:') !!}
    <p tabindex="4">{{ $business->city }}</p>
</div>

<!-- Postal Code Field -->
<div class="col-sm-12">
    {!! Form::label('postal_code', 'Código Postal:') !!}
    <p tabindex="5">{{ $business->postal_code }}</p>
</div>

<!-- Country Field -->
<div class="col-sm-12">
    {!! Form::label('country', 'País:') !!}
    <p tabindex="6">{{ $business->country }}</p>
</div>

<!-- Phone Field -->
<div class="col-sm-12">
    {!! Form::label('phone', 'Teléfono físico:') !!}
    <p tabindex="7">{{ $business->phone }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'E-mail:') !!}
    <p tabindex="8">{{ $business->email }}</p>
</div>

<!-- Website Field -->
<div class="col-sm-12">
    {!! Form::label('website', 'Website:') !!}
    <p tabindex="9">{{ $business->website }}</p>
</div>

<!-- Logo Field -->
<div class="col-sm-12">
    {!! Form::label('logo', 'Logo:') !!}
    <p tabindex="10">{{ $business->logo }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado el:') !!}
    <p tabindex="11">{{ $business->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado el:') !!}
    <p tabindex="12">{{ $business->updated_at }}</p>
</div>
