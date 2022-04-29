@extends('layouts.admin.master')

@section('title')Mon profil
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Mes coordonnées</h3>
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
                    <form class="form theme-form needs-validation" novalidate="" method="post"
                          action="{{route('update_profil')}}">
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
                                        <label class="form-label" for="exampleFormControlInput1">CIN </label>
                                        <input disabled class="form-control" type="text" name="numero_CIN" id="numero_CIN" required value="{{$admin->user->numero_CIN}}" />

                                    </div>

                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Nom </label>
                                        <input class="form-control" type="text" name="nom" id="nom" required value="{{$admin->nom}}" />
                                        <div class="invalid-tooltip">Entrez le nom d'admin svp!</div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Prénom </label>
                                        <input class="form-control" name="prenom" id="prenom" type="text" required value="{{$admin->prenom}}" />
                                        <div class="invalid-tooltip">Entrez le prenom d'admin svp!</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Numéro de téléphone
                                        </label>
                                        <input class="form-control" type="text" name="numero_telephone"
                                               id="numero_telephone" required value="{{ $admin->numero_telephone }}" />
                                        <div class="invalid-tooltip">Entrez le numéro de téléphone d'admin svp!</div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">E-mail </label>
                                        <input class="form-control" type="email" name="email" id="email" required value={{$admin->email }} />
                                        <div class="invalid-tooltip">Entrez l'email d'admin svp!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a class="btn btn-light" href="{{ route('liste_admin') }}">Annuler</a>
                            <button class="btn btn-primary" type="submit">Modifier</button>
                        </div>
                    </form>
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

