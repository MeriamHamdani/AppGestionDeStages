@extends('layouts.admin.master')

@section('title')Modifier Etudiant
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier les informations d'un etudiant</h3>
        @endslot
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Modifier les informations d'un etudiant</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Modifier les informations d'un etudiant</h5>
                    </div>
                    <form class="form theme-form">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Numero CIN/Passeport</label>
                                        <input class="form-control" id="exampleFormControlInput1" type="number"
                                               placeholder="entrez le num cin" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="exampleFormControlInput1">Nom </label>
                                        <input class="form-control" id="exampleFormControlInput1" type="text"
                                               placeholder="entrez le nom de l'etudiant..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="exampleFormControlInput1">Prénom </label>
                                        <input class="form-control" id="exampleFormControlInput1" type="text"
                                               placeholder="entrez le prénom de l'etudiant..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="exampleFormControlInput1">Numéro de téléphone</label>
                                        <input class="form-control" id="exampleFormControlInput1" type="number"
                                               placeholder="entrez le numéro de téléphone de l'etudiant..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="exampleFormControlInput1">E-mail </label>
                                        <input class="form-control" id="exampleFormControlInput1" type="email"
                                               placeholder="entrez l'adresse mail de l'etudiant..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Adresse</label>
                                        <input class="form-control" id="exampleFormControlInput1" type="text"
                                               placeholder="entrez l'adresse'" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Classe</label>
                                        <select class="js-example-basic-single col-sm-12">
                                            <option value="0">Sélectionnez la classe</option>
                                            <option value="1">2 Comp</option>
                                            <option value="2">1 Gest</option>
                                            <option value="3">2 info</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Numéro d'inscription</label>
                                        <input class="form-control" id="exampleFormControlInput1" type="number"
                                               placeholder="entrez le Numéro d'inscription de l'etudiant..." />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-light" type="reset" value="Annuler" />
                            <button class="btn btn-primary" type="submit">Valider</button>
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

