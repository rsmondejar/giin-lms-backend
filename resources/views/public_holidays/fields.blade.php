<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre del festivo:') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'required' => true,
        'maxlength' => \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH,
        'placeHolder' => 'Año Nuevo',
        'aria-describedby' => "nameHelpBlock",
    ]) !!}
    <small id="nameHelpBlock" class="form-text text-muted">
        Longitud máxima: {!! \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH !!} caracteres
    </small>
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Día:') !!}
    {!! Form::text(
        'datePreview',
         isset($publicHoliday) ? $publicHoliday->date->format('d/m/Y') : null,
         [
            'class' => 'form-control',
            'id' => 'datePreview'
        ]
    ) !!}
{!! Form::hidden('date', null, []) !!}
</div>

@push('page_scripts')
<script type="module">
    $('#datePreview').datepicker({
        dateFormat: 'dd/m/yy',
        dafaultDate: true,
        regional: 'es',
        altField: "#date",
        altFormat: "yy-mm-dd",
    })
</script>
@endpush
