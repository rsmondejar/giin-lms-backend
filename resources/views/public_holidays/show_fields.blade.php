<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Nombre del festivo:') !!}
    <p tabindex="1">{{ $publicHoliday->name }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Día:') !!}
    <p tabindex="2">{{ $publicHoliday->date }}</p>
</div>

<!-- Year Field -->
<div class="col-sm-12">
    {!! Form::label('year', 'Año:') !!}
    <p tabindex="3">{{ $publicHoliday->year }}</p>
</div>
