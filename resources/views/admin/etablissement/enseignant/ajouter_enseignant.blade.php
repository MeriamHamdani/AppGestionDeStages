@extends('layouts.admin.master')

@section('title')Ajouter Enseignant
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter un enseignant</h3>
        @endslot
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Ajouter un enseignant</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ajouter un enseignant</h5>
                    </div>
                    <form class="form theme-form" method="POST" action="{{ route('sauvegarder_enseignant') }}">
                        @csrf
                        <div class="card-body">
                            @if($errors->any())
                                @foreach ($errors->all() as $err )
                                    <div class="alert alert-danger" role="alert">
                                        {{ $err }}
                                    </div>
                                @endforeach
                            @endif
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Numero CIN</label>
                                        <input class="form-control" id="numero_CIN" name="numero_CIN" type="number" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Nom </label>
                                        <input class="form-control" id="nom" name="nom" type="text" required
                                               placeholder="entrez le nom de l'enseignant..."/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Prénom </label>
                                        <input class="form-control" id="prenom" name="prenom" type="text" required
                                               placeholder="entrez le prénom de l'enseignant..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Numéro de téléphone</label>
                                        <input class="form-control" id="numero_telephone" name="numero_telephone" type="number" required
                                               placeholder="entrez le numéro de téléphone de l'enseignant..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="exampleFormControlInput1">E-mail </label>
                                        <input class="form-control" id="email" name="email" type="email" required
                                               placeholder="entrez l'adresse mail de l'enseignant..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Grade</label>
                                        <select class="js-example-basic-single col-sm-12" id="grade" name="grade" required>
                                            <option disabled="disabled" selected="selected">Sélectionnez le grade</option>
                                            <option value="maitre assistant">Maitre assistant</option>
                                            <option value="maitre de conference">Maitre de conférence</option>
                                            <option value="professeur">Professeur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Département</label>
                                        <select class="js-example-basic-single col-sm-12" id="departement_id" name="departement_id" required>
                                            <option disabled="disabled" selected="selected">Sélectionnez le département</option>
                                            @foreach (\App\Models\Departement::all() as $departement)
                                                <option
                                                    value="{{ $departement->id }}"
                                                    {{ old('departement_id') == $departement->id ? 'selected' : '' }}
                                                >{{ ucwords($departement->nom) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">RIB </label>
                                        <input class="form-control" id="rib" name="rib" type="number" required/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Identifiant </label>
                                        <input class="form-control" id="identifiant" name="identifiant" type="number" required/>
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

