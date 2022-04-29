@extends('layouts.admin.master')

@section('title')Coordonnées générales
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3 style="text-align: center;">Pas de Coordonnées encore!!</h3>
        @endslot

    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 center-content">
                <div class="card">
                    <div class="col-xl-12 xl-90 col-lg-12 box-col-12">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="media faq-widgets">
                                    <div class="media-body">
                                        <h5>Pas de Coordonées à afficher!</h5>
                                        <p style="color:white">Pas de coordonnées dans la base !! <br/>
                                            Veillez remplir la base avec les coordonnées de votre établissement tout d'abord!</p>
                                    </div>
                                    <i data-feather="database"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    @endpush

@endsection

