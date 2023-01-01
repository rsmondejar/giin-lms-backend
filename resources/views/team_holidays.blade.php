@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vacaciones del equipo</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        @include('partials.requested-holidays-manager')
    </div>
@endsection
