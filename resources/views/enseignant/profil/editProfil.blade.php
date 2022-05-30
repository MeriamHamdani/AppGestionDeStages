@extends('layouts.enseignant.master')

@section('title')Mon profil
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Mes coordonnées </h3>
        @endslot
        <li class="breadcrumb-item">Profil</li>
        <li class="breadcrumb-item">Modifier mes coordonnées</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Modifier mes coordonnées</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{ route('update_profil_ens') }}">
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
                                <label class="form-label" for="validationTooltip01">Numero CIN</label>
                                <input class="form-control" id="numero_CIN" name="numero_CIN" type="number"
                                       value="{{$enseignant->user->numero_CIN}}" disabled />
                                <div class="invalid-tooltip">Entrez le N°CIN svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Nom</label>
                                <input class="form-control" id="nom" name="nom" type="text"
                                       value="{{$enseignant->nom}}" required="" />
                                <div class="invalid-tooltip">Entrez le nom svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Prénom</label>
                                <input class="form-control" id="prenom" name="prenom" type="text"
                                       value="{{$enseignant->prenom}}" required="" />
                                <div class="invalid-tooltip">Entrez le prénom svp!</div>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Numero de téléphone</label>
                                <input class="form-control" id="numero_telephone" name="numero_telephone" type="number"
                                       value="{{$enseignant->numero_telephone}}" required="" />
                                <div class="invalid-tooltip">Entrez le N° de téléphone svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Email</label>
                                <input class="form-control" id="email" name="email" type="email"
                                       value="{{$enseignant->email}}" required="" />
                                <div class="invalid-tooltip">Entrez l'email svp!</div>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Grade</label>
                                <select class="js-example-basic-single col-sm-12" id="grade" name="grade"  value="{{$enseignant->grade}}" required>
                                    <option disabled="disabled" selected="selected">Sélectionnez le grade</option>
                                    <option value="maitre assistant" {{$enseignant->grade == "maitre assistant" ? 'selected' : '' }}>Maitre assistant</option>
                                    <option value="maitre de conference"  {{$enseignant->grade == "maitre de conference" ? 'selected' : '' }}>Maitre de conférence</option>
                                    <option value="professeur" {{$enseignant->grade == "professeur" ? 'selected' : '' }} >Professeur</option>
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le grade svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Département</label>
                                <select class="js-example-basic-single col-sm-12" id="departement_id" name="departement_id" disabled="">
                                    <option disabled="disabled" selected="selected">Sélectionnez le département</option>
                                    @foreach (\App\Models\Departement::all() as $departement)
                                        <option value="{{ $departement->id }}"
                                            {{ old('departement_id', $enseignant->departement_id) == $departement->id ? 'selected' : '' }}>
                                            {{ ucwords($departement->nom) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">RIB</label>
                                <input class="form-control" id="rib" name="rib" type="number"
                                       value="{{$enseignant->rib}}" required="" />
                                <div class="invalid-tooltip">Entrez le RIB svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Identifiant</label>
                                <input class="form-control" id="identifiant" name="identifiant" type="number"
                                       value="{{$enseignant->identifiant}}" required="" />
                                <div class="invalid-tooltip">Entrez l'identifiant svp!</div>
                            </div>

                            <div class="card-footer text-end">
                                <a class="btn btn-light" href="{{ route('liste_demandes') }}">Annuler</a>
                                <button class="btn btn-primary" type="submit">Sauvegarder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            @push('scripts')
                <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
                <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
                <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    @endpush

@endsection

