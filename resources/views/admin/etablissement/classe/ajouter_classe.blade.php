@extends('layouts.admin.master')

@section('title')Ajouter classe
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter une classe</h3>
        @endslot
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Ajouter une classe</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ajouter une classe</h5>
                    </div>
                    <form class="form theme-form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Code classe  </label>
                                        <input class="form-control" id="message-text" type="text"
                                               placeholder="entrez le code de la classe..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Nom classe </label>
                                        <input class="form-control" id="message-text" type="text"
                                               placeholder="entrez le nom de la classe..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Spécialité</label>
                                        <select class="js-example-basic-single col-sm-12">
                                            <option value="0'">Séléctionnez la spécialité</option>
                                            <option value="1">Info</option>
                                            <option value="2">Comptabilité</option>
                                            <option value="3">Finance</option>
                                            <option value="4">Eco</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Type de stage </label>
                                        <select class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                            <option value="0">2eme master blig</option>
                                            <option value="1">1ere licence volontaire</option>
                                            <option value="2">3eme licence info</option>
                                            <option value="3">2eme info oblig</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Type de sujet</label>
                                        <select class="js-example-basic-single col-sm-12">
                                            <option value="0'">Séléctionnez le type de sujet</option>
                                            <option value="0">PFE</option>
                                            <option value="1">BP</option>
                                            <option value="2">PT</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Liste des fichiers</label>
                                        <select class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                            <option value="0">Attestation</option>
                                            <option value="1">Fiche réponse</option>
                                            <option value="2">Fiche plagiat</option>
                                            <option value="2">Fiche biblio</option>
                                            <option value="3">Mémoire</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Année universitaire</label>
                                        <select class="js-example-basic-single col-sm-12">
                                            <option value="0'">Séléctionnez l'année</option>
                                            <option value="0">2022-2021</option>
                                            <option value="1">2021-2020</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <input class="btn btn-light" type="reset" value="Annuler" />
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    @endpush

@endsection

