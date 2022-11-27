<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $business->id }}</p>
</div>

<!-- Business Name Field -->
<div class="col-sm-12">
    {!! Form::label('business_name', 'Business Name:') !!}
    <p>{{ $business->business_name }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', 'Address:') !!}
    <p>{{ $business->address }}</p>
</div>

<!-- City Field -->
<div class="col-sm-12">
    {!! Form::label('city', 'City:') !!}
    <p>{{ $business->city }}</p>
</div>

<!-- Postal Code Field -->
<div class="col-sm-12">
    {!! Form::label('postal_code', 'Postal Code:') !!}
    <p>{{ $business->postal_code }}</p>
</div>

<!-- Country Field -->
<div class="col-sm-12">
    {!! Form::label('country', 'Country:') !!}
    <p>{{ $business->country }}</p>
</div>

<!-- Phone Field -->
<div class="col-sm-12">
    {!! Form::label('phone', 'Phone:') !!}
    <p>{{ $business->phone }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
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
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $business->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $business->updated_at }}</p>
</div>

