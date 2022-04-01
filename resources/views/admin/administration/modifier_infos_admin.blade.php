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
                <form class="form theme-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Nom </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        value="Ben Flene" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Prénom </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        value="Flene" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">CIN </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        value="88888888" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Numéro de telephone
                                    </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        value="55555555" />
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">E-mail </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        value="fene@flen.com" />
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