@extends('layouts.admin.master')

@section('title')Modifier Classe
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">

@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Modifier la demande de stage</h3>
@endslot
<!--<li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Modifier  les informations de la classe</li>-->
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <form class="form theme-form" method="POST" action="{{ route('edit',['stage_id'=>$stage->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Le sujet</label>
                                    <div class="mb-3">
                                        <input class="form-control" value="{{ $stage->titre_sujet }}" type="text"
                                            name="sujet" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(($classe->isMaster && $classe->niveau==2)||($classe->isLicence &&
                        $classe->niveau==3))
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le nom de
                                        l'Encadrant</label>
                                    <select class="form-select" id="encadrant" name="encadrant">
                                        <option value="{{ $stage->enseignant_id}}">
                                            {{ App\Models\Enseignant::find($stage->enseignant_id)->nom}}&nbsp;{{
                                            App\Models\Enseignant::find($stage->enseignant_id)->prenom}}
                                        </option>
                                        <option><a value="+" onclick="ajouterZoneTexte()">
                                                Ajouter une entreprise </a></option>
                                        @foreach($enseignants as $ens)
                                        <option value="{{$ens->id }}">{{$ens->nom}}&nbsp;{{$ens->prenom}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(!($stage->type_sujet=='projet tutore'||$stage->type_sujet=='business plan'))

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le nom de
                                        l'entreprise</label>
                                    <select class="form-select" id="entreprise" name="entreprise">
                                        <option value="{{ $stage->entreprise_id}}">
                                            {{ App\Models\Entreprise::find($stage->entreprise_id)->nom}}
                                        </option>
                                        @foreach ($entreprises as $entr)
                                        <option value={{ $entr->id }}>{{ $entr->nom }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">La fiche de demande de stage</label>
                                    <div class="mb-3">
                                        <input class="form-control" type="file" name="fiche_demande"
                                            accept=".pdf,.png,.jpeg,.jpg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Modifier</button>
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
@endpush

@endsection

