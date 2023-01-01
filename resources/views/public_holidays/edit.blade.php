@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Editar Festivo: <strong>{!! $publicHoliday->name !!}</strong></h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($publicHoliday, [
                'route' => ['public-holidays.update', $publicHoliday->id],
                'method' => 'patch'
            ]) !!}

            <div class="card-body">
                <div class="row">
                    @include('public_holidays.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('public-holidays.index') }}" class="btn btn-default"> Volver </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
