@extends('layouts.admin.master')

@section('title')Modifier Spécialité
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier les informations d'une spécialité</h3>
        @endslot
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Modifier les informations d'une spécialité</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Modifier les informations d'une spécialité</h5>
                    </div>
                    <form class="form theme-form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Code spécialité  </label>
                                        <input class="form-control" id="exampleFormControlInput1" type="text"
                                               placeholder="entrez le code de spécialité..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Nom spécialité </label>
                                        <input class="form-control" id="exampleFormControlInput1" type="text"
                                               placeholder="entrez le nom du spécialité..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Formation</label>
                                        <select class="js-example-basic-single col-sm-12">
                                            <option value="0">Sélectionnez le type de formation</option>
                                            <option value="1">Licence</option>
                                            <option value="2">Master</option>
                                            <option value="3">Ingénieurie</option>
                                            <option value="4">Doctorat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="exampleFormControlInput1">Département</label>
                                        <select class="js-example-basic-single col-sm-12">
                                            <option value="0">Sélectionnez le département</option>
                                            <option value="1">Comptabilité</option>
                                            <option value="2">GRH</option>
                                            <option value="3">Finance</option>
                                            <option value="4">Info</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Responsable</label>
                                        <select class="js-example-basic-single col-sm-12">
                                            <option value="0">Sélectionnez le responsable</option>
                                            <option value="1">Msr flen</option>
                                            <option value="2">Mdm flena</option>
                                            <option value="3">Mrs roza</option>
                                            <option value="4">Mr fley</option>
                                        </select>
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


