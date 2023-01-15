@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listado de <strong>Empresas</strong></h1>
                </div>
                @can('create businesss')
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('businesses.create') }}">
                        Agregar
                    </a>
                </div>
                @endcan
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('common.table')
        </div>
    </div>

@endsection
