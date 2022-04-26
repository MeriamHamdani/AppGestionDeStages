@extends('layouts.admin.master')

@section('title')Modifier les informations du spécialité
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier les informations </h3>
        @endslot
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Modifier les informations de la spécialité</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Modifier les informations de la spécialité <strong>{{$specialite->nom}} </strong></h5>
                    </div>
                    <form class="form theme-form" method="POST" action="{{ route('update_specialite', $specialite) }}">
                        @csrf
                        @method('PATCH')
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
                                        <label class="form-label" for="exampleFormControlInput1">Code spécialité  </label>
                                        <input class="form-control" id="code" name="code" type="text" value="{{$specialite->code}}" required
                                               placeholder="entrez le code de spécialité..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Nom spécialité </label>
                                        <input class="form-control"  id="nom" name="nom" type="text" value="{{$specialite->nom}}" required
                                               type="text" placeholder="entrez le nom du spécialité..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Cycle/Type de formation</label>
                                        <select class="js-example-basic-single col-sm-12" id="cycle" name="cycle">
                                            <option disabled="disabled" selected="selected">Séléctionnez le cycle/type de formation</option>
                                            <option value="licence" {{ $specialite->cycle == "licence" ? 'selected' : '' }}>Licence</option>
                                            <option value="master" {{ $specialite->cycle == "master" ? 'selected' : '' }}>Mastère</option>
                                            <option value="doctorat" {{ $specialite->cycle == "doctorat" ? 'selected' : '' }}>Doctorat</option>
                                            <option value="ingeniorat" {{ $specialite->cycle == "ingeniorat" ? 'selected' : '' }}>Ingéniorat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Département</label>
                                        <select class="js-example-basic-single col-sm-12" id="departement_id" name="departement_id"  required>
                                            <option disabled="disabled" selected="selected">Sélectionnez le département</option>
                                            @foreach (\App\Models\Departement::all() as $departement)
                                                <option value="{{ $departement->id }}"
                                                    {{ old('departement_id', $specialite->departement_id) == $departement->id ? 'selected' : '' }}>
                                                    {{ ucwords($departement->nom) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Responsable</label>
                                        <select class="js-example-basic-single col-sm-12" id="enseignant_id" name="enseignant_id" required>
                                            <option disabled="disabled" selected="selected">Sélectionnez le responsable</option>
                                            @foreach (\App\Models\Enseignant::all() as $enseignant)
                                                <option value="{{ $enseignant->id }}"
                                                    {{ old('enseignant_id', $specialite->enseignant_id) == $enseignant->id ? 'selected' : '' }}>
                                                    {{ ucwords($enseignant->nom) }} {{ ucwords($enseignant->prenom) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a class="btn btn-light" href="{{ route('liste_specialites') }}">Annuler</a>
                                <button class="btn btn-primary" type="submit">Valider</button>
                            </div>
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


