@extends('layouts.admin.master')

@section('title')Ajouter Spécialité
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter une spécialité</h3>
        @endslot
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Ajouter une spécialité</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ajouter une spécialité</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate="" method="POST"
                              action="{{ route('sauvegarder_specialite') }}">
                            @csrf
                            @if($errors->any())
                                @foreach ($errors->all() as $err )
                                    <div class="alert alert-danger" role="alert">
                                        {{ $err }}
                                    </div>
                                @endforeach
                            @endif
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Code spécialité</label>
                                <input class="form-control" id="code" name="code" type="text"
                                       value="{{old('code')}}" required=""
                                       placeholder="entrez le code de spécialité......"/>
                                <div class="invalid-tooltip">Entrez le code de spécialité svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Nom spécialité</label>
                                <input class="form-control" id="nom" name="nom" type="text"
                                       value="{{old('nom')}}" required=""
                                       placeholder="entrez lenom du spécialité..."/>
                                <div class="invalid-tooltip">Entrez le nom du spécialité svp!</div>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Formation</label>
                                <select class="js-example-basic-single col-sm-12" id="cycle" name="cycle"
                                        value="{{old('cycle')}}" required>
                                    <option disabled="disabled" selected="selected">Sélectionnez le type de formation
                                    </option>
                                    <option
                                        value="licence" {{ old('cycle') == "licence" ? 'selected' : '' }}>
                                        Licence
                                    </option>
                                    <option
                                        value="master" {{ old('cycle') == "master" ? 'selected' : '' }}>
                                        Mastère
                                    </option>
                                    <option
                                        value="doctorat" {{ old('cycle') == "doctorat" ? 'selected' : '' }}>
                                        Doctorat
                                    </option>
                                    <option
                                        value="ingénierie" {{ old('cycle') == "ingeniorat" ? 'selected' : '' }}>
                                        Ingénierie
                                    </option>
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le cycle svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Département</label>
                                <select class="js-example-basic-single col-sm-12" id="departement_id"
                                        name="departement_id" required>
                                    <option disabled="disabled" selected="selected">Sélectionnez le département</option>
                                    @foreach (\App\Models\Departement::all() as $departement)
                                        <option
                                            value="{{ $departement->id }}"
                                            {{ old('departement_id') == $departement->id ? 'selected' : '' }}
                                        >{{ ucwords($departement->nom) }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le département svp!</div>
                            </div>

                            <div class="col-md-6 position-relative ">
                                <label class="form-label" for="validationTooltip01">Responsable</label>
                                <select class="js-example-basic-single col-sm-12" id="enseignant_id"
                                        name="enseignant_id" >
                                    <option disabled="disabled" selected="selected">Sélectionnez le responsable</option>
                                    @foreach (\App\Models\Enseignant::all() as $enseignant)
                                        <option
                                            value="{{ $enseignant->id }}"
                                            {{ old('enseignant_id') == $enseignant->id ? 'selected' : '' }}
                                        >{{ ucwords($enseignant->nom) }} {{ ucwords($enseignant->prenom) }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le responsable svp!</div>
                            </div>

                            <div class="card-footer text-end">
                                <a class="btn btn-light" href="{{ route('liste_specialites') }}">Annuler</a>
                                <button class="btn btn-primary" type="submit">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
        <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>

    @endpush

@endsection

