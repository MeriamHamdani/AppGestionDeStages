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
                    <h5>Stage</h5>
                </div>
                <form class="form theme-form" action={{ route('demander_stage') }} method="POST"
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
                        <div class="alert alert-primary dark" role="alert">
                            <p><i class="icofont icofont-exclamation-tringle"></i>
                                Prière de télécharger la fiche de demande de stage, la remplir,
                                la signer avec le responsable de l entreprise ( avec cachet )
                                et la scanner puis la dépôser dans ce formulaire.</p>

                            <p> <a href="{{ route('telecharger_fiche_demande',['fiche_demande'=>$fiche_demande]) }}"><u
                                        style="color:rgb(255, 255, 255)">Télécharger la fiche de demande
                                        de
                                        stage</u></a></p>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Le sujet</label>
                                    <div class="mb-3">
                                        <input class="form-control" name="titre_sujet" id="titre_sujet"
                                            placeholder="Taper votre sujet..." type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="message-text">Type de sujet</label>
                                <select class="js-example-basic-single col-sm-12" name="type_sujet" id="type_sujet">
                                    <option>Séléctionner le type de sujet</option>
                                    <option value="PFE">PFE</option>
                                    <option value="Business Plan">Business Plan</option>
                                    <option value="Projet Tutoré">Projet Tutoré</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le nom de
                                        l'Encadrant</label>
                                    <select class="js-example-basic-single col-sm-12" id="encadrant" name="encadrant">
                                        <option><a value="+" onclick="ajouterZoneTexte()">
                                                Choisir l'encadrant académique </a></option>
                                        @foreach ($enseignants as $enseignant )
                                        <option value="{{ $enseignant->id }}">{{ $enseignant->nom }}.{{
                                            $enseignant->prenom
                                            }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le nom de
                                        l'entreprise</label>
                                    <select class="js-example-basic-single col-sm-12" name="entreprise" id="entreprise">
                                        <option><a value="+" onclick="ajouterZoneTexte()">
                                                Ajouter une entreprise </a></option>
                                        @foreach ($entreprises as $entreprise )
                                        <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Date début de
                                        stage</label>
                                    <input class="datepicker-here form-control digits" placeholder="mm/jj/aaaa"
                                        type="text" data-language="en" name="date_debut" id="date_debut" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Date fin de stage</label>
                                    <input class="datepicker-here form-control digits" placeholder="mm/jj/aaaa"
                                        type="text" data-language="en" name="date_fin" id="date_fin" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">La fiche de demande de stage scannée</label>
                                    <div class="mb-3">
                                        <input class="form-control" type="file" name="demande_file" id="demande_file"
                                            required="required" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Envoyer</button>
                        <input class="btn btn-light" type="reset" value="Annuler" />
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
@endpush
@endsection

