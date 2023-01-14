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
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="far fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Vacaciones {!! today()->subYear()->year !!}</span>
                        <span class="info-box-number">
                            {!! $metrics['last_year_vacations_days'] !!}
                            /
                            {!! $metrics['last_year_vacations_per_year_days'] !!}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="far fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Vacaciones {!! today()->year !!}</span>
                        <span class="info-box-number">
                            {!! $metrics['vacations_days'] !!} / {!! $metrics['vacations_per_year_days'] !!}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="info-box bg-indigo">
                    <span class="info-box-icon"><i class="far fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Dias Antigüedad {!! today()->year !!}</span>
                        <span class="info-box-number">
                            {!! $metrics['seniority_days'] !!} / {!! $metrics['seniority_per_year_days'] !!}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="info-box bg-olive">
                    <span class="info-box-icon"><i class="far fa-hospital"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Dias Enfermedad {!! today()->year !!}</span>
                        <span class="info-box-number">
                            {!! $metrics['sickness_days'] !!}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="info-box bg-lime">
                    <span class="info-box-icon"><i class="far fa-hospital"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Dias Ausencia {!! today()->year !!}</span>
                        <span class="info-box-number">
                            {!! $metrics['sickness_days'] !!}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="info-box bg-maroon">
                    <span class="info-box-icon"><i class="far fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Dias Permiso {!! today()->year !!}</span>
                        <span class="info-box-number">
                            {!! $metrics['leaves_of_absence_days'] !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.request-holidays')
        @include('partials.requested-holidays')
    </div>
@endsection
