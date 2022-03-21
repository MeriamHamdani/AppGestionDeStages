@extends('layouts.admin.master')

@section('title')Demander un stage
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Le formulaire de demande de stage</h3>
@endslot
<!--<li class="breadcrumb-item">Forms</li>
		<li class="breadcrumb-item">Form Controls</li>-->
<li class="breadcrumb-item active">Demander un stage</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <!-- <div class="card-header pb-0">
                    <h5>Basic form control</h5>
                </div>-->
                <form class="form theme-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Le sujet</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Tapez votre sujet..." type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le nom de
                                        l'Encadrant</label>
                                    <select class="form-select" id="encadrant">
                                        <option>enseignant 1</option>
                                        <option>enseignant 2</option>
                                        <option>enseignant 3</option>
                                        <option>enseignant 4</option>
                                        <option>enseignant 5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le nom de
                                        l'entreprise</label>
                                    <select class="form-select" id="entreprise">
                                        <option><a value="+" onclick="ajouterZoneTexte()">
                                                Ajouter une entreprise </a></option>
                                        <option>a entreprise 1</option>
                                        <option>b entreprise 2</option>
                                        <option>c entreprise 3</option>
                                        <option>d entreprise 4</option>
                                        <option>e entreprise 5</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">La fiche de demande de stage</label>
                                    <div class="mb-3">
                                        <input class="form-control" type="file" />
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
@endpush
@endsection

