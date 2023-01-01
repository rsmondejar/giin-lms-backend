@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        @include('partials.request-holidays')
        @include('partials.requested-holidays')
    </div>
@endsection
