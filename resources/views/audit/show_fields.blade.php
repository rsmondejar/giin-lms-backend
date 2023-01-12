<!-- Event Field -->
<div class="col-sm-12">
    {!! Form::label('event', 'Evento:') !!}
    <p tabindex="1">{{ $audit->event }}</p>
</div>

<!-- Model Field -->
<div class="col-sm-12">
    {!! Form::label('model', 'Modelo:') !!}
    <p tabindex="2">{{ $audit->model }}</p>
</div>

<!-- Data Field -->
<div class="col-sm-12">
    {!! Form::label('data', 'Info:') !!}
    <p tabindex="3">{!! \App\Traits\PrintPreatyJson::print(json_encode($audit->data)) !!}</p>
</div>
