@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listado de <strong>Departamentos</strong></h1>
                </div>
                @can('create departments')
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('departments.create') }}">
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
            <div class="card-body">
                @include('common.table')
            </div>
        </div>
    </div>

@endsection
