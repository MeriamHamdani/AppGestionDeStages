@extends('layouts.enseignant.master')

@section('title')Cahier de stage
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/scrollable.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/timepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/photoswipe.css')}}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Détails de stage de : l'etudiant</h3>
        @endslot
        <li class="breadcrumb-item">Enacdrement</li>
        <li class="breadcrumb-item active">Détails de stage de : l'etudiant</li>
    @endcomponent
    <div class="container-fluid">
        <div class="user-profile social-app-profile">
            <div class="col-md-6 col-sm-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Détails de stage de : l'etudiant
                        </h5>
                    </div>
                    <div class="collapse show" id="collapseicon1" data-parent="#accordion" aria-labelledby="collapseicon1">
                        <div class="card-body social-status filter-cards-view">
                            <div class="media">
                                <div class="media-body">
                                    <span class="d-block">Nom et prénom</span>
                                    <span class="f-w-600 d-block" style="color:#bf9168  ">Meriam Hamdani</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <span class="d-block">Sujet</span>
                                    <input class="form-control" placeholder="Taper votre sujet..." type="text" value="Dev app gestion des stages"/>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <span class="d-block">Type de Stage</span>
                                    <span class="f-w-600 d-block" style="color:#bf9168">2eme licence info oblig</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <span class="d-block">Date début</span>
                                    <span class="f-w-600 d-block" style="color:#bf9168">01-02-2022</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <span class="d-block">Date fin</span>
                                    <span class="f-w-600 d-block" style="color:#bf9168">01-06-2022</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
        <script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
        <script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>
    @endpush

@endsection

