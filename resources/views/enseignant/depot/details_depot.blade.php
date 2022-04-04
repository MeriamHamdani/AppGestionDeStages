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
                            Détails de demande de dépôt de : l'etudiant
                        </h5>
                            </div>
                            <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2" data-parent="#accordion">
                                <div class="card-body filter-cards-view">
                                    <h6 style="text-align: center">
                                       Les commentaires de l'enseignant
                                    </h6>
                                    <div class="filter-view-group">
                                        <span class="f-w-600" style="color: #2b786a">Nom de l'enseignant </span>
                                <p style="color: #0c0c0c">
                                    J'espere que vous corrigez la partie 1 de chapitre1
                                </p>
                            </div>
                            <div class="filter-view-group">
                                <span class="f-w-600" style="color: #2b786a">Nom de l'enseignant </span>
                                <p style="color: #0c0c0c">
                                    Bien recu c bien le mémoire est bien corrigé
                                </p>
                            </div>
                            <div class="form theme-form">
                                <form action="">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label style="color: #8a6d3b">Ajoutez un commentaire en cas de refus de dépôt</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea4" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-end">
                                                <a class="btn btn-success me-3" href="#">Accepter le dépôt</a><a class="btn btn-danger" href="#">Mettre à jour le dépôt</a></div>
                                        </div>
                                    </div>
                                </form>
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

