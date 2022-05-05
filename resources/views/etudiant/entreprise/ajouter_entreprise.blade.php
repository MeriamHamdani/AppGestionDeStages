@extends('layouts.etudiant.master')

@section('title')Ajouter une entreprise
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter une entreprise</h3>
        @endslot
        <li class="breadcrumb-item">Entreprise</li>
        <li class="breadcrumb-item">Ajouter une entreprise</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ajouter une entreprise</h5>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{ route('sauvegarder_entreprise') }}">
                            @csrf
                            @if($errors->any())
                                @foreach ($errors->all() as $err )
                                    <div class="alert alert-danger" role="alert">
                                        {{ $err }}
                                    </div>
                                @endforeach
                            @endif
                            <div class="alert alert-primary dark" role="alert">
                                <p><i class="icofont icofont-exclamation-tringle"></i>
                                    Vérifiez tout d'abord l'existance du nom d'entreprise dans la liste!!</p>
                                <p>Pour consulter la liste des entreprises <a
                                        href="{{ route('liste_entreprises')}}"
                                        style="color:white"><strong>cliquez ici </strong></a></p>
                            </div>
                            <div class="col-md-6 position-relative">
                                        <label class="form-label" for="exampleFormControlInput1">Nom de
                                            l'entreprise</label>
                                        <input class="form-control" id="nom" name="nom" type="text" required
                                               placeholder="entrez le nom de l'entreprise"  value="{{old('nom')}}"/>
                                <div class="invalid-tooltip">Entrez le nom d'entreprise svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="exampleFormControlInput1">Email</label>
                                <input class="form-control" id="email" name="email" type="email" required
                                       placeholder="entrez l'adresse email de l'entreprise" value="{{old('email')}}"/>
                                <div class="invalid-tooltip">Entrez l'email d'entreprise svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                        <label class="form-label" for="exampleFormControlInput1">Adresse</label>
                                        <input class="form-control" id="adresse" name="adresse" type="text" required
                                               placeholder="entrez l'adresse de l'entreprise" value="{{old('adresse')}}"/>
                                <div class="invalid-tooltip">Entrez l'adresse 'd'entreprise svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                        <label class="form-label" for="exampleFormControlInput1">Téléphone</label>
                                        <input class="form-control" id="numero_telephone" name="numero_telephone" type="number" required
                                               placeholder="entrez le numéro de téléphone de l'entreprise" value="{{old('numero_telephone')}}"/>
                                <div class="invalid-tooltip">Entrez le numéro de téléphone d'entreprise svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="exampleFormControlInput1">Fax</label>
                                <input class="form-control" id="fax" name="fax" type="number"
                                       placeholder="entrez le numéro de fax de l'entreprise" value="{{old('fax')}}"/>
                            </div>
                            <div class="card-footer text-end">
                                <a class="btn btn-light" href="{{ route('liste_entreprises') }}">Annuler</a>
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
    @endpush

@endsection

