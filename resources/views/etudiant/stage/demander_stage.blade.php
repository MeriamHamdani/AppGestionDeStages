@extends('layouts.etudiant.master')

@section('title')Demander un stage
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">

@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Le formulaire de demande de stage</h3>
@endslot
<li class="breadcrumb-item">Stage</li>
<li class="breadcrumb-item active">Demander un stage</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Demander un Stage</h5>
                </div>
                <form class="form theme-form" action="{{ route('demander_stage') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if($errors->any())
                        @foreach ($errors->all() as $err )
                        <div class="alert alert-danger" role="alert">
                            {{ $err }}
                        </div>
                        @endforeach
                        @endif
                        @if(($etudiant->classe->typeStage->fiche_demande) != null)
                        <div class="alert alert-primary dark" role="alert">
                            <p><i class="icofont icofont-exclamation-tringle"></i>
                                Prière de télécharger la fiche de demande de stage, la remplir,
                                la signer avec le responsable de l'entreprise ( avec cachet )
                                et la scanner puis la dépôser dans ce formulaire.</p>
                            <p><a href="{{ route('telecharger_modele_fiche_demande',$fiche_demande) }}">
                                    <u style="color:rgb(255, 255, 255)"><i
                                            class="icofont icofont-download-alt">Télécharger
                                            la fiche de demande de stage</i></u>
                                </a>
                            </p>
                        </div>
                        @endif
                        <div class="row">
                            @if($etudiant->classe->niveau != 1)
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Le sujet (champ non obligatoire)</label>
                                    <div class="mb-3">
                                        <input class="form-control" name="titre_sujet" id="titre_sujet"
                                            placeholder="Taper votre sujet..." value="{{old('titre_sujet')}}"
                                            type="text" />
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(($etudiant->classe->niveau == 3 && $etudiant->classe->cycle=="licence") ||
                            ($etudiant->classe->niveau == 2 && $etudiant->classe->cycle=="master"))
                            <div class="mb-3">
                                <label class="form-label" for="type_sujet">Type de sujet</label>
                                <select class="js-example-basic-single col-sm-12" name="type_sujet" id="type_sujet">
                                    <option disabled="disabled" selected="selected">Choisissez le type de
                                        sujet
                                    </option>
                                    @foreach ($typesSujet as $ts)
                                    <option value="{{$ts}}" {{ old('type_sujet')==$ts ? 'selected' : '' }}>{{$ts}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                            @endif
                        </div>
                        @if(($etudiant->classe->niveau == 3 && $etudiant->classe->cycle=="licence") ||
                        ($etudiant->classe->niveau == 2 && $etudiant->classe->cycle=="master") )
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le nom de
                                        l'Encadrant</label>
                                    <select class="js-example-basic-single col-sm-12" id="enseignant_id"
                                        name="enseignant_id" required>
                                        <option disabled="disabled" selected="selected">Choisissez l'encadrant
                                            académique
                                        </option>
                                        @foreach ($enseignants as $enseignant )
                                        <option value="{{ $enseignant->id }}" {{ old('enseignant_id')==$enseignant->id ?
                                            'selected' : '' }}
                                            >{{ ucwords($enseignant->nom) }} {{ ucwords($enseignant->prenom) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col">
                                <div class="mb-3" id="entrepriseDiv">
                                    <label class="form-label" for="entreprise">Le nom de
                                        l'entreprise</label>
                                    <select class="js-example-basic-single col-sm-12" name="entreprise" id="entreprise">
                                        <option disabled="disabled" selected="selected">Choisissez l'entreprise
                                        </option>
                                        @foreach ($entreprises as $entreprise )
                                        <option value="{{ $entreprise->id }}" {{ old('entreprise')==$entreprise->id ?
                                            'selected' : '' }}>{{ $entreprise->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="alert alert-secondary dark round-badge-info" role="alert">
                                <p><i class="icofont icofont-exclamation-tringle"></i>
                                    Veillez choisir la période de votre stage incluse dans la période définie dans le
                                    type de stage</p>
                                <p> entre <strong>{{$type_stage->date_debut_periode}}</strong> et
                                    <strong>{{$type_stage->date_limite_periode}} </strong>
                                </p>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Date début de
                                        stage</label>
                                    <input class="datepicker-here form-control digits" placeholder="mm/jj/aaaa"
                                        value="{{old('date_debut')}}" type="text" data-language="en" name="date_debut"
                                        id="date_debut" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Date fin de
                                        stage</label>
                                    <input class="datepicker-here form-control digits" placeholder="mm/jj/aaaa"
                                        value="{{old('date_fin')}}" type="text" data-language="en" name="date_fin"
                                        id="date_fin" />
                                </div>
                            </div>
                        </div>
                        @if(($etudiant->classe->typeStage->fiche_demande) != null)
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">La fiche de demande de stage scannée (Fiche
                                        d'encadrement)</label>
                                    <div class="mb-3">
                                        <input class="form-control" type="file" name="fiche_demande" id="fiche_demande"
                                            required="required" accept=".jpg,.jpeg,.png,.pdf" />
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(($etudiant->classe->typeStage->fiche_assurance_type== "requis"))
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">La fiche d'assurance</label>
                                        <div class="mb-3">
                                            <input class="form-control" type="file" name="fiche_assurance"
                                                id="fiche_assurance" required accept=".jpg,.jpeg,.png,.pdf" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(($etudiant->classe->typeStage->fiche_2Dinars_type== "requis"))
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Fiche 2 Dinars</label>
                                    <div class="mb-3">
                                        <input class="form-control" type="file" name="fiche_2Dinars" id="fiche_2Dinars"
                                            required accept=".jpg,.jpeg,.png,.pdf" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="card-footer text-end">
                        <input class="btn btn-light" type="reset" value="Annuler" />
                        <button class="btn btn-primary" type="submit">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
<script src="{!!url('/js/jquery.min.js')!!}"></script>
<script type="text/javascript">
    $("#type_sujet").change(function () {
                if ($(this).val() == "PFE") {
                    $('#entrepriseDiv').show();
                } else {
                    $('#entrepriseDiv').hide();
                }
            });
            $("#type_sujet").trigger("change");
</script>
@endpush
@endsection

