@extends('layouts.admin.master')

@section('title')Configuration de type de stage par classe
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Configurer le type de stage selon la classe</h3>
        @endslot
        <li class="breadcrumb-item">Générale</li>
        <li class="breadcrumb-item active">configuration type de stage selon la classe</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Configurer</h5>
                    </div>
                    <div class="card-body">
                        <div class="stepwizard">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step"><a class="btn btn-primary" href="#step-1">1</a>
                                    <p>classe et type de stage</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-2">2</a>
                                    <p>Periode de stage</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-3">3</a>
                                    <p>Fiche de demande</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-4">4</a>
                                    <p>Dates limites de <br>dépôt des mémoires</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-5">5</a>
                                    <p>Le(s) type(s) de sujet</p>
                                </div>
                            </div>
                        </div>

                        @if($errors->any())
                            @foreach ($errors->all() as $err )
                                <div class="alert alert-danger" role="alert">
                                    {{ $err }}
                                </div>
                            @endforeach
                        @endif

                        <form action="{{ route('typeStage.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="setup-content" id="step-1">
                                @if ($error_message['nom']!="")
                                    <div class="alert alert-danger" role="alert">
                                        {{ $error_message['nom'] }}
                                    </div>
                                @endif
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Classe</label>
                                            <select class="js-example-basic-single col-sm-12" name="nom_classe" id="nom_classe">
                                                <option disabled="disabled" selected="selected">Sélectionnez la classe</option>
                                                @foreach ($classes as $classe )
                                                    <option value="{{ $classe->nom }}">
                                                        {{ $classe->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Type</label>
                                            <select class="js-example-basic-single col-sm-12" name="type" id="type" class="form-control">
                                                <option disabled="disabled" selected="selected">Sélectionnez le type</option>
                                                <option value="Obligatoire">
                                                    Obligatoire
                                                </option>
                                                <option value="Volontaire">
                                                    Volontaire
                                                </option>
                                            </select>

                                        </div>
                                        <button class="btn btn-primary nextBtn pull-right" type="button">Suivant
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="setup-content" id="step-2">
                                @if ($error_message['periode_stage']!="")
                                    <div class="alert alert-danger" role="alert">
                                        {{ $error_message['periode_stage'] }}
                                    </div>
                                @endif
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Date de debut</label>
                                            <input class="datepicker-here form-control digits date-picker" type="text"
                                                   data-language="en" required="required" name="date_debut"
                                                   id="date_debut"/>


                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Date de fin</label>
                                            <input class="datepicker-here form-control digits" type="text"
                                                   data-language="en" required="required" name="date_fin"
                                                   id="date_fin"/>
                                        </div>
                                        <button class="btn btn-primary nextBtn pull-right" type="button">Suivant
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="setup-content" id="step-3">
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">

                                                    <div class="mb-3 row">
                                                        <label class="col-sm-3 col-form-label">La fiche de demande de
                                                            stage</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" type="file" name="fiche_demande"
                                                                   id="fiche_demande" required="required"/>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary nextBtn pull-right"
                                                    type="button">Suivant
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="setup-content" id="step-4">
                                @if ($error_message['depot_stage']!="")
                                    <div class="alert alert-danger" role="alert">
                                        {{ $error_message['depot_stage'] }}
                                    </div>
                                @endif

                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Date de debut</label>
                                            <input class="datepicker-here form-control digits date-picker" type="text"
                                                   data-language="en" name="date_debut_depo" id="date_debut_depo"/>


                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Date de fin</label>
                                            <input class="datepicker-here form-control digits" type="text"
                                                   data-language="en" name="date_fin_depo" id="date_fin_depo"/>
                                        </div>
                                        <button class="btn btn-primary nextBtn pull-right" type="button">Suivant
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="setup-content" id="step-5">
                                <div class="col-xs-12 card-body animate-chk">
                                    <div class="col-md-12">
                                        <div class="alert alert-primary dark" role="alert">
                                            <p><i class="icofont icofont-exclamation-tringle"></i>
                                                Ces champs ne sont requis que pour les stages <u>Obligatoires</u>
                                                .<br>
                                                Cliquer Terminer si le type de stage encours de configuration est
                                                <u>Volontaire</u>
                                            </p>
                                        </div>
                                        <div class="form-group">

                                            <label class="d-block" for="chk-ani"><input class="checkbox_animated"
                                                                                        id="chk-ani" type="checkbox"
                                                                                        checked="" name="type_sujet[]"
                                                                                        value="PFE"
                                                                                        checked="false">
                                                PFE</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="d-block" for="chk-ani"><input class="checkbox_animated"
                                                                                        id="chk-ani" type="checkbox"
                                                                                        name="type_sujet[]"
                                                                                        value="Projet Tutoré">
                                                Projet Tutoré</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="d-block" for="chk-ani"><input class="checkbox_animated"
                                                                                        id="chk-ani" type="checkbox"
                                                                                        checked="" name="type_sujet[]"
                                                                                        value="Business Plan">
                                                Business Plan</label>
                                            <button class="btn btn-primary nextBtn pull-right"
                                                    type="submit">Términer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



    @push('scripts')
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
        <script src="{{asset('assets/js/form-wizard/form-wizard-two.js')}}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    @endpush

@endsection

