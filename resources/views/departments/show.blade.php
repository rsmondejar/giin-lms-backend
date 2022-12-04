@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detalle del <strong>Departamento</strong></h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('departments.index') }}">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('departments.show_fields')
                </div>
                <div class="row">
                    <a href="{{ route('departments.index') }}" class="btn btn-default"> Volver </a>
                </div>
            </div>
        </div>
    </div>
@endsection
