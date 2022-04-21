@extends('layouts.admin.master')

@section('title')Modifier Classe
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">

@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Modifier les coordonnées d'un administrateur</h3>
@endslot
<!--<li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Modifier  les informations de la classe</li>-->
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <!-- <div class="card-header pb-0">
                    <h5>Modifier les informations de la classe</h5>
                </div>-->
                <form class="form theme-form" method="post"
                    action="{{ route('admin.update',['id_admin'=>$admin->id]) }}">
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
                                    <label class="form-label" for="exampleFormControlInput1">Nom </label>
                                    <input class="form-control" type="text" name="nom" id="nom" value={{ $admin->nom }}
                                    />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Prénom </label>
                                    <input class="form-control" name="prenom" id="prenom" value={{ $admin->prenom }}
                                    type="text"
                                    value="Flene" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">CIN </label>
                                    <input class="form-control" type="text" name="numero_CIN" id="numero_CIN" value={{
                                        $user->numero_CIN }} />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Numéro de telephone
                                    </label>
                                    <input class="form-control" type="text" name="numero_telephone"
                                        id="numero_telephone" value={{ $admin->numero_telephone }}
                                    />
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">E-mail </label>
                                    <input class="form-control" type="email" name="email" id="email" value={{
                                        $admin->email }} />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <input class="btn btn-light" type="reset" value="Annuler" />
                        <button class="btn btn-primary" type="submit">Modifier</button>
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