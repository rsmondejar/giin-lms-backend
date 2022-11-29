<!-- Business Name Field -->
<div class="form-group col-sm-6 col-lg-3">
    {!! Form::label('business_name', 'Nombre empresa:') !!}
    {!! Form::text('business_name', null, [
        'class' => 'form-control',
        'required' => true,
        'maxlength' => '60',
        'placeHolder' => 'Nombre de la empresa',
        'aria-describedby' => "business_nameHelpBlock",
    ]) !!}
    <small id="business_nameHelpBlock" class="form-text text-muted">Longitud máxima: 60 caracteres</small>
</div>

<!-- Address Field -->
<div class="form-group col-sm-6 col-lg-9">
    {!! Form::label('address', 'Dirección:') !!}
    {!! Form::text('address', null, [
        'class' => 'form-control',
        'required' => true,
        'maxlength' => \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH,
        'placeHolder' => 'c/Direccíon nº10',
        'aria-describedby' => "addressHelpBlock",
    ]) !!}
    <small id="addressHelpBlock" class="form-text text-muted">
        Longitud máxima: {!! \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH !!} caracteres
    </small>
</div>

<!-- City Field -->
<div class="form-group col-sm-6 col-lg-3">
    {!! Form::label('city', 'Ciudad:') !!}
    {!! Form::text('city', null, [
        'class' => 'form-control',
        'required' => true,
        'maxlength' => '60',
        'placeHolder' => 'Madrid',
        'aria-describedby' => "cityHelpBlock",
    ]) !!}
    <small id="cityHelpBlock" class="form-text text-muted">Longitud máxima: 60 caracteres</small>
</div>

<!-- Postal Code Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('postal_code', 'Código Postal:') !!}
    {!! Form::text('postal_code', null, [
        'class' => 'form-control',
        'required' => true,
        'maxlength' => '10',
        'placeHolder' => '00000',
        'aria-describedby' => "postal_codeHelpBlock",
    ]) !!}
    <small id="postal_codeHelpBlock" class="form-text text-muted">Longitud máxima: 10 caracteres</small>
</div>

<!-- Country Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('country', 'País:') !!}
    {!! Form::text('country', null, [
        'class' => 'form-control',
        'required' => true,
        'maxlength' => '60',
        'placeHolder' => 'España',
        'aria-describedby' => "countryHelpBlock",
    ]) !!}
    <small id="countryHelpBlock" class="form-text text-muted">Longitud máxima: 60 caracteres</small>
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('phone', 'Teléfono físico:') !!}
    {!! Form::text('phone', null, [
        'class' => 'form-control',
        'required' => true,
        'maxlength' => '20',
        'placeHolder' => '+34 91 000 00 00',
        'aria-describedby' => "phoneHelpBlock",
    ]) !!}
    <small id="phoneHelpBlock" class="form-text text-muted">Longitud máxima: 20 caracteres</small>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6 col-lg-3">
    {!! Form::label('email', 'E-mail:') !!}
    {!! Form::email('email', null, [
        'class' => 'form-control',
        'required' => true,
        'maxlength' => '100',
        'placeHolder' => 'email@example.com',
        'aria-describedby' => "emailHelpBlock",
    ]) !!}
    <small id="emailHelpBlock" class="form-text text-muted">Longitud máxima: 100 caracteres</small>
</div>

<!-- Website Field -->
<div class="form-group col-sm-6 col-lg-3">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, [
        'class' => 'form-control',
        'maxlength' => 100,
        'placeHolder' => 'https://www.example.com',
        'aria-describedby' => "websiteHelpBlock",
    ]) !!}
    <small id="websiteHelpBlock" class="form-text text-muted">
        Opcional. Longitud máxima: 100 caracteres
    </small>
</div>

<!-- Logo Field -->
<div class="form-group col-sm-6 col-lg-3">
    {!! Form::label('logo', 'Logo:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('logo', [
                'class' => 'custom-file-input',
                'accept' => "image/png, image/jpeg",
                'aria-describedby' => "logoHelpBlock",
            ]) !!}
            {!! Form::label('logo', 'Seleccionar logo', [
                'class' => 'custom-file-label',
            ]) !!}
        </div>
    </div>

    <small id="logoHelpBlock" class="form-text text-muted">
        Opcional. Solo se aceptan imagenes en formato PNG ó JPG
    </small>

    <div class='img-thumb-container'>
        <a
            href='{{ (isset($business->logo) && (strlen($business->logo) > 3))
                ? '/files/' . $business->logo
                : '/img/no-image.png' }}'
            target='_blank' title='Zoom'
        >
            <img
                src="{{ (isset($business?->logo) && (strlen($business->logo) > 3))
                    ? '/files/' . $business?->logo
                    : '/img/no-image.png' }}"
                class='img-thumb'
                width="200"
                alt="Image"
            />
        </a>
    </div>
</div>
<div class="clearfix"></div>
