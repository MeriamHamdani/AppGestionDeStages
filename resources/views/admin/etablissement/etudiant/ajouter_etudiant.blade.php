@extends('layouts.admin.master')

@section('title')Ajouter Etudiant
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter un etudiant</h3>
        @endslot
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Ajouter un etudiant</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ajouter un etudiant</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{ route('sauvegarder_etudiant') }}">
                                @csrf
                            @if($errors->any())
                                @foreach ($errors->all() as $err )
                                    <div class="alert alert-danger" role="alert">
                                        {{ $err }}
                                    </div>
                                @endforeach
                            @endif
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Numero CIN/Passeport</label>
                                <input class="form-control" id="numero_CIN" name="numero_CIN" type="number"
                                       value="{{old('numero_CIN')}}" required="" placeholder="entrez le num cin..."/>
                                <div class="invalid-tooltip">Entrez le N°CIN svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Nom</label>
                                <input class="form-control" id="nom" name="nom" type="text"
                                       value="{{old('nom')}}" required=""
                                       placeholder="entrez le nom de l'étudiant..."/>
                                <div class="invalid-tooltip">Entrez le nom svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Prénom</label>
                                <input class="form-control" id="prenom" name="prenom" type="text"
                                       value="{{old('prenom')}}" required=""
                                       placeholder="entrez le prénom de létudiant..."/>
                                <div class="invalid-tooltip">Entrez le prénom svp!</div>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Email</label>
                                <input class="form-control" id="email" name="email" type="email"
                                       value="{{old('email')}}" required=""
                                       placeholder="entrez l'email de l'étudiant..."/>
                                <div class="invalid-tooltip">Entrez l'email svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Numero de téléphone</label>
                                <input class="form-control" id="numero_telephone" name="numero_telephone" type="number"
                                       value="{{old('numero_telephone')}}" required=""
                                       placeholder="entrez le numéro de téléphone de l'étudiant..."/>
                                <div class="invalid-tooltip">Entrez le N° de téléphone svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Classe</label>
                                <select class="js-example-basic-single col-sm-12" id="classe_id" name="classe_id" required>
                                    <option disabled="disabled" selected="selected">Sélectionnez la classe</option>
                                    @foreach(\App\Models\Classe::all() as $classe)
                                        <option
                                            value="{{ $classe->id }}"
                                            {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                                            {{ ucwords($classe->nom) }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le classe svp!</div>
                            </div>

                            <div class="card-footer text-end">
                                <a class="btn btn-light" href="{{ route('liste_etudiants') }}">Annuler</a>
                                <button class="btn btn-primary" type="submit">Ajouter</button>
                            </div>
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

