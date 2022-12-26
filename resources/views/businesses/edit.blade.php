@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Editar empresa: <strong>{!! $business->business_name !!}</strong></h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($business, [
                'route' => ['businesses.update', $business->id],
                'method' => 'patch',
                'files' => true,
            ]) !!}

            <div class="card-body">
                <div class="row">
                    @include('businesses.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('businesses.index') }}" class="btn btn-default"> Volver </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
