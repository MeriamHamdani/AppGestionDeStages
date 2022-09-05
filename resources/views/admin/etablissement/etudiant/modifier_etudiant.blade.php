@extends('layouts.admin.master')

@section('title')Modifier les informations d'étudiant
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Modifier les informations</h3>
@endslot
<li class="breadcrumb-item">Administration</li>
<li class="breadcrumb-item">Modifier les informations de l'etudiant</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Modifier les informations de l'étudiant <strong>{{$etudiant->prenom}}
                            {{$etudiant->nom}}</strong></h5>
                </div>
                <div class="card-body">
                    <form class="row g-3 needs-validation" novalidate="" method="POST"
                        action="{{ route('update_etudiant', $etudiant) }}">
                        @csrf
                        @method('PATCH')
                        @if($errors->any())
                        @foreach ($errors->all() as $err )
                        <div class="alert alert-danger" role="alert">
                            {{ $err }}
                        </div>
                        @endforeach
                        @endif

                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Numéro CIN</label>
                            <input class="form-control" id="numero_CIN" name="numero_CIN" type="number"
                                value="{{$etudiant->user->numero_CIN}}" required="" />
                            <div class="invalid-tooltip">Entrez le N°CIN svp!</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Nom</label>
                            <input class="form-control" id="nom" name="nom" type="text" value="{{$etudiant->nom}}"
                                required="" />
                            <div class="invalid-tooltip">Entrez le nom svp!</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Prénom</label>
                            <input class="form-control" id="prenom" name="prenom" type="text"
                                value="{{$etudiant->prenom}}" required="" />
                            <div class="invalid-tooltip">Entrez le nom svp!</div>
                        </div>

                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Email</label>
                            <input class="form-control" id="email" name="email" type="email"
                                value="{{$etudiant->email}}" required="" />
                            <div class="invalid-tooltip">Entrez l'email svp!</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Numéro de téléphone</label>
                            <input class="form-control" id="numero_telephone" name="numero_telephone" type="number"
                                value="{{$etudiant->numero_telephone}}" required="" />
                            <div class="invalid-tooltip">Entrez le N° de téléphone svp!</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Classe</label>
                            <select class="js-example-basic-single col-sm-12" id="classe_id" name="classe_id">
                                <option disabled="disabled" selected="selected">Sélectionnez la classe</option>
                                @foreach (\App\Models\Classe::all() as $classe)
                                <option value="{{ $classe->id }}" {{ old('classe_id', $etudiant->classe_id) ==
                                    $classe->id ? 'selected' : '' }}>
                                    {{ ucwords($classe->nom) }}
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">Séléctionnez la classe svp!</div>
                        </div>

                        <div class="card-footer text-end">
                            <a class="btn btn-light" href="{{ route('liste_etudiants') }}">Annuler</a>
                            <button class="btn btn-primary" type="submit">Valider</button>
                        </div>
                        {{-- <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Numero CIN</label>
                                    <input class="form-control" id="numero_CIN" name="numero_CIN" type="number"
                                        value="{{$etudiant->user->numero_CIN}}" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Nom</label>
                                    <input class="form-control" id="nom" name="nom" type="text"
                                        value="{{$etudiant->nom}}" required
                                        placeholder="entrez le nom de l'etudiant..." />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">Prénom</label>
                                    <input class="form-control" id="prenom" name="prenom" type="text"
                                        value="{{$etudiant->prenom}}" required
                                        placeholder="entrez le prénom de l'etudiant..." />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Numéro de téléphone</label>
                                    <input class="form-control" id="numero_telephone" name="numero_telephone"
                                        type="number" value="{{$etudiant->numero_telephone}}" required
                                        placeholder="entrez le numéro de téléphone de l'etudiant..." />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">E-mail </label>
                                    <input class="form-control" id="email" name="email" type="email"
                                        value="{{$etudiant->email}}" required
                                        placeholder="entrez l'adresse mail de l'etudiant..." />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Classe</label>
                                    <select class="js-example-basic-single col-sm-12" id="classe_id" name="classe_id">
                                        <option disabled="disabled" selected="selected">Sélectionnez le grade</option>
                                        @foreach (\App\Models\Classe::all() as $classe)
                                        <option value="{{ $classe->id }}" {{ old('classe_id', $etudiant->classe_id) ==
                                            $classe->id ? 'selected' : '' }}>
                                            {{ ucwords($classe->nom) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
@endpush

@endsection

