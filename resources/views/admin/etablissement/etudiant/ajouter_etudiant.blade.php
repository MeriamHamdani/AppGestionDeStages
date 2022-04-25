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
                    <form class="form theme-form" method="POST" action="{{ route('sauvegarder_etudiant') }}"> <!--{{ route('sauvegarder_etudiant') }}-->
                        @csrf
                        <div class="card-body">
                            @if($errors->any())
                                @foreach ($errors->all() as $err )
                                    <div class="alert alert-danger" role="alert">
                                        {{ $err }}
                                    </div>
                                @endforeach
                            @endif
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Numero CIN/Passeport</label>
                                        <input class="form-control" id="numero_CIN" name="numero_CIN" type="number" required
                                               placeholder="entrez le num cin" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="message-text">Nom </label>
                                        <input class="form-control" id="nom" name="nom" type="text" required
                                               placeholder="entrez le nom de l'etudiant..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="message-text">Prénom </label>
                                        <input class="form-control" id="prenom" name="prenom" type="text" required
                                               placeholder="entrez le prénom de l'etudiant..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">E-mail </label>
                                        <input class="form-control" id="email" name="email" type="email" required
                                               placeholder="entrez l'adresse mail de l'etudiant..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Numéro de téléphone</label>
                                        <input class="form-control" id="numero_telephone" name="numero_telephone" type="number" required
                                               placeholder="entrez le numéro de téléphone de l'etudiant..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Classe</label>
                                        <select class="js-example-basic-single col-sm-12" id="classe_id" name="classe_id" required>
                                            <option disabled="disabled" selected="selected">Sélectionnez la classe</option>
                                            @foreach(\App\Models\Classe::all() as $classe)
                                                <option
                                                    value="{{ $classe->id }}"
                                                    {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                                                    {{ ucwords($classe->nom) }}</option>
                                            @endforeach
                                        </select>
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

