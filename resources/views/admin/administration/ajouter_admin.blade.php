@extends('layouts.admin.master')

@section('title')Ajouter Admin
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Ajouter un administrateur</h3>
@endslot
<li class="breadcrumb-item">Administration</li>
<li class="breadcrumb-item">Ajouter un administrateur</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Ajouter un admin</h5>
                </div>
               {{-- <form class="form theme-form" action="{{ route('ajout_admin') }}" method="POST">
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
                                        <label class="form-label" for="exampleFormControlInput1">Numéro de CIN</label>
                                        <input class="form-control" id="exampleFormControlInput1" type="number"
                                               placeholder="entrez le numéro de CIN de l'administrateur..." name="numero_CIN"
                                               id="numero_CIN"  value="{{old('numero_CIN')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                     <div class="mb-3">

                                        <label class="form-label" for="exampleFormControlInput1">Nom </label>
                                        <input class="form-control" id="exampleFormControlInput1" type="text"
                                            placeholder="entrez le nom de l'administrateur..." name="nom" id="nom"
                                        value="{{old('nom')}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">Prénom </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        placeholder="entrez le prénom de l'administrateur..." name="prenom"
                                        id="prenom"  value="{{old('prenom')}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Numéro de téléphone</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="number"
                                        placeholder="entrez le numéro de téléphone de l'administrateur..."
                                        name="numero_telephone" id="numero_telephone" value="{{old('numero_telephone')}}"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">E-mail </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="email"
                                        placeholder="entrez l'adresse mail de l'administrateur..." name="email"
                                        id="email" value="{{old('email')}}" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a class="btn btn-light" href="{{ route('liste_admin') }}">Annuler</a>
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                </form>--}}
                <div class="card-body">
                    <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{ route('ajout_admin') }}">
                        @csrf
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
                                   value="{{old('numero_CIN')}}" required="" placeholder="entrez le num cin..."/>
                            <div class="invalid-tooltip">Entrez le N°CIN svp!</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Nom</label>
                            <input class="form-control" id="nom" name="nom" type="text"
                                   value="{{old('nom')}}" required=""
                                   placeholder="entrez le nom de l'admin..."/>
                            <div class="invalid-tooltip">Entrez le nom svp!</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Prénom</label>
                            <input class="form-control" id="prenom" name="prenom" type="text"
                                   value="{{old('prenom')}}" required=""
                                   placeholder="entrez le prénom de l'admin'..."/>
                            <div class="invalid-tooltip">Entrez le prénom svp!</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Email</label>
                            <input class="form-control" id="email" name="email" type="email"
                                   value="{{old('email')}}" required=""
                                   placeholder="entrez l'email de l'admin..."/>
                            <div class="invalid-tooltip">Entrez l'email svp!</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Numero de téléphone</label>
                            <input class="form-control" id="numero_telephone" name="numero_telephone" type="number"
                                   value="{{old('numero_telephone')}}" required=""
                                   placeholder="entrez le numéro de téléphone de l'admin..."/>
                            <div class="invalid-tooltip">Entrez le N° de téléphone svp!</div>
                        </div>

                        <div class="card-footer text-end">
                            <a class="btn btn-light" href="{{ route('liste_admin') }}">Annuler</a>
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

