@extends('layouts.admin.master')

@section('title')Configuration de type de stage par classe
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Configurer le type de stages selon la classe</h3>
        @endslot
        <li class="breadcrumb-item">Gestion des classes</li>
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
                                    <p>Classe et Type de stage</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-2">2</a>
                                    <p>Periode de stage</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-3">3</a>
                                    <p>Fiches nécessaires</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-4">4</a>
                                    <p>Cahier de stage</p>
                                </div>
                                @if($classe->niveau == 3 && $classe->cycle=="licence" ||$classe->niveau == 2 && $classe->cycle=="master"  )
                                    {{--<div class="stepwizard-step"><a class="btn btn-light" href="#step-4">5</a>
                                        <p>Dates limites de <br>dépôt des mémoires</p>
                                    </div>--}}
                                    <div class="stepwizard-step"><a class="btn btn-light" href="#step-5">5</a>
                                        <p>Le(s) type(s) de sujet</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($errors->any())
                            @foreach ($errors->all() as $err )
                                <div class="alert alert-danger" role="alert">
                                    {{ $err }}
                                </div>
                            @endforeach
                        @endif

                        <form action="{{ route('update_type_stage',$typeStage) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            @if ($error_message['nom']!="")
                                <div class="alert alert-danger" role="alert">
                                    {{ $error_message['nom'] }}
                                </div>
                            @endif
                            @if ($error_message['periode_stage']!="")
                                <div class="alert alert-danger" role="alert">
                                    {{ $error_message['periode_stage'] }}
                                </div>
                            @endif
                            @if ($error_message['depot_stage']!="")
                                <div class="alert alert-danger" role="alert">
                                    {{ $error_message['depot_stage'] }}
                                </div>
                            @endif
                            <div class="setup-content" id="step-1">
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Classe</label>
                                            <select class="js-example-basic-single col-sm-12" name="nom_classe"
                                                    id="nom_classe">
                                                <option disabled="disabled" selected="selected"
                                                        value="{{ $classe->nom }}">
                                                    {{ $classe->nom }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Type</label>
                                            <select name="type" id="type" class="js-example-basic-single col-sm-12">
                                                <option disabled="disabled" selected="selected">Sélectionnez le type
                                                </option>
                                                <option
                                                    value="Obligatoire" {{ $type == "Obligatoire" ? 'selected' : '' }}>
                                                    Obligatoire
                                                </option>
                                                <option
                                                    value="Volontaire" {{ $type == "Volontaire" ? 'selected' : '' }}>
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
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Date de début</label>
                                            <input class="datepicker-here form-control digits date-picker" type="text"
                                                   data-language="en" required="required" name="date_debut"
                                                   id="date_debut" value="{{old('date_debut_periode',$typeStage->date_debut_periode)}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Date de fin</label>
                                            <input class="datepicker-here form-control digits" type="text"
                                                   data-language="en" required="required" name="date_fin"
                                                   id="date_fin" value="{{$typeStage->date_limite_periode}}"/>
                                        </div>
                                        <div class="col-md-6 position-relative">
                                            <label class="control-label">Durée de stage minimale en mois</label>
                                            <div class="input-group">
                                                <input class="touchspin" name="duree_stage_min" id="duree_stage_min" type="number"
                                                       value="{{$typeStage->duree_stage_min}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 position-relative">
                                            <label class="control-label">Durée de stage maximale en mois</label>
                                            <div class="input-group">
                                                <input class="touchspin" name="duree_stage_max" id="duree_stage_max" type="number"
                                                       value="{{$typeStage->duree_stage_max}}" required/>
                                            </div>
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
                                                        <div
                                                            class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                            <label class="col-sm-3 col-form-label">La fiche de demande
                                                                de stage</label>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline1" type="radio"
                                                                       name="fiche_demande_type" value="requis" {{$typeStage->fiche_demande_type == "requis" ? 'checked' : ''}}>
                                                                <label class="mb-0" for="radioinline1">Requis</label>
                                                            </div>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline2" type="radio"
                                                                       name="fiche_demande_type" value="non requis" {{$typeStage->fiche_demande_type == "non requis" ? 'checked' : ''}}>
                                                                <label class="mb-0" for="radioinline2">Non
                                                                    Requis</label>
                                                            </div>
                                                            @if($typeStage->fiche_demande)
                                                            <div class="alert alert-primary dark rounded-2" role="alert">
                                                                <p><a href="{{ route('fiche_demande', substr($typeStage->fiche_demande, 15)) }}">
                                                                        <u style="color:rgb(255, 255, 255)"><i class="icofont icofont-download-alt"> Télécharger la fiche de demande de stage</i></u>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                            @endif
                                                            <input class="form-control" type="file" name="fiche_demande"
                                                                   id="fiche_demande" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3 row">
                                                        <div
                                                            class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                            <label class="col-sm-3 col-form-label">La fiche
                                                                d'assurance</label>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline3" type="radio"
                                                                       name="fiche_assurance_type" value="requis" {{$typeStage->fiche_assurance_type == "requis" ? 'checked' : ''}}>
                                                                <label class="mb-0" for="radioinline3">Requis</label>
                                                            </div>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline4" type="radio"
                                                                       name="fiche_assurance_type" value="non requis" {{$typeStage->fiche_assurance_type == "non requis" ? 'checked' : ''}}>
                                                                <label class="mb-0" for="radioinline4">Non
                                                                    Requis</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3 row">
                                                        <div
                                                            class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                            <label class="col-sm-3 col-form-label">La fiche</label>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline5" type="radio"
                                                                       name="fiche__type" value="requis"  value="requis" {{$typeStage->fiche__type == "requis" ? 'checked' : ''}}>
                                                                <label class="mb-0" for="radioinline5">Requis</label>
                                                            </div>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline6" type="radio"
                                                                       name="fiche__type" value="non requis" value="requis" {{$typeStage->fiche__type == "non requis" ? 'checked' : ''}}>
                                                                <label class="mb-0" for="radioinline6">Non
                                                                    Requis</label>
                                                            </div>
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
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3 row">
                                                        <div
                                                            class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                            <label class="col-sm-3 col-form-label">Le cahier de stage pour ce type de stage est</label>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline7" type="radio"
                                                                       name="cahier_stage_type" value="requis" {{$typeStage->cahier_stage_type == "requis" ? 'checked' : ''}} >
                                                                <label class="mb-0" for="radioinline7">Requis</label>
                                                            </div>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline8" type="radio"
                                                                       name="cahier_stage_type"  value="non requis" {{$typeStage->cahier_stage_type == "non requis" ? 'checked' : ''}} >
                                                                <label class="mb-0" for="radioinline8">Non
                                                                    Requis</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($classe->niveau == 3 && $classe->cycle=="licence" || $classe->niveau == 2 && $classe->cycle=="master"  )
                                                <button class="btn btn-primary nextBtn pull-right"
                                                        type="button">Suivant
                                                </button>
                                            @else
                                                <button class="btn btn-secondary pull-right"
                                                        type="submit">Términer!
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($classe->niveau == 3 && $classe->cycle=="licence" ||
                            $classe->niveau == 2 && $classe->cycle=="master" )
                                {{--<div class="setup-content" id="step-5">
                                    <div class="col-xs-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Date de début</label>
                                                <input class="datepicker-here form-control digits date-picker"
                                                       type="text"
                                                       data-language="en" name="date_debut_depo" id="date_debut_depo"
                                                       value="{{$typeStage->date_debut_depot}}"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Date de fin</label>
                                                <input class="datepicker-here form-control digits" type="text"
                                                       data-language="en" name="date_fin_depo" id="date_fin_depo"
                                                       value="{{old('date_limite_depot',$typeStage->date_limite_depot)}}"/>
                                            </div>

                                            <button class="btn btn-primary nextBtn pull-right" type="button">Suivant
                                            </button>
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="setup-content" id="step-5">
                                    <div class="col-xs-12 card-body animate-chk">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="d-block" for="chk-ani"><input class="checkbox_animated"
                                                                                            id="chk-ani" type="checkbox"
                                                                                            name="type_sujet[]"
                                                                                            value="PFE" @for ($i = 0; $i < 3; $i++)
                                                        @if(isset(($typeStage->type_sujet)[$i] )&& ($typeStage->type_sujet)[$i])
                                                            == "PFE" )
                                                            {{($typeStage->type_sujet)[$i] == "PFE" ? 'checked' : ''}}
                                                        @endif
                                                    @endfor >
                                                    PFE</label>
                                            </div>
                                            <div class="form-group">
                                                <label class="d-block" for="chk-ani"><input class="checkbox_animated"
                                                                                            id="chk-ani" type="checkbox"
                                                                                            name="type_sujet[]"
                                                                                            value="Projet Tutoré" @for ($i = 0; $i < 3; $i++)
                                                        @if(isset(($typeStage->type_sujet)[$i] )&& ($typeStage->type_sujet)[$i])
                                                            == "Projet Tutoré" )
                                                            {{($typeStage->type_sujet)[$i] == "Projet Tutoré" ? 'checked' : '' }}
                                                        @endif
                                                    @endfor >
                                                    Projet Tutoré</label>
                                            </div>
                                            <div class="form-group">
                                                <label class="d-block" for="chk-ani"><input class="checkbox_animated"
                                                                                            id="chk-ani" type="checkbox"
                                                                                            name="type_sujet[]"
                                                                                            value="Business Plan" @for ($i = 0; $i < 3; $i++)
                                                        @if(isset(($typeStage->type_sujet)[$i] )&& ($typeStage->type_sujet)[$i])
                                                            == "Business Plan" )
                                                            {{ ($typeStage->type_sujet)[$i] == "Business Plan" ? 'checked' : '' }}
                                                        @endif
                                                    @endfor >
                                                    Business Plan</label>
                                                <button class="btn btn-secondary pull-right"
                                                        type="submit">Términer!
                                                </button>
                                            </div>
                                            <div class="form-group">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
        <script src="{{ asset('assets/js/touchspin/vendors.min.js') }}"></script>
        <script src="{{ asset('assets/js/touchspin/touchspin.js') }}"></script>
        <script src="{{ asset('assets/js/touchspin/input-groups.min.js') }}"></script>
        <script src="{{asset('assets/js/form-wizard/form-wizard-two.js')}}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    @endpush

@endsection

