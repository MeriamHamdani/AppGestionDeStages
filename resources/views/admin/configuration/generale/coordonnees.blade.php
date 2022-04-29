@extends('layouts.admin.master')

@section('title')Coordonnées générales
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Coordonnées générales</h3>
        @endslot
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item">Coordonnées générales de l'établissement</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Coordonnées générales</h5>
                    </div>
                    <form class="form theme-form" method="POST" action="{{route('valider_coordonnees')}}">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Email</label>
                                        <input class="form-control" id="email" name="email" value="{{App\Models\Etablissement::first()->email}}" type="email"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="col-form-label" for="message-text">Université </label>
                                        <input class="form-control" id="universite" name="universite"  value="{{App\Models\Etablissement::first()->universite}}" type="text"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Université en arabe </label>
                                        <input class="form-control" id="universiteAr" name="universiteAr" value="{{App\Models\Etablissement::first()->universiteAr}}" type="text"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="message-text">Etablissement</label>
                                        <input class="form-control" id="nom" name="nom" value="{{App\Models\Etablissement::first()->nom}}" type="text"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Etablissement en arabe</label>
                                        <input class="form-control" id="nomAr" name="nomAr" value="{{App\Models\Etablissement::first()->nomAr}}" type="text"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Adresse</label>
                                        <input class="form-control" id="adresse" name="adresse" value="{{App\Models\Etablissement::first()->adresse}}" type="text"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Adresse en arabe </label>
                                        <input class="form-control" id="adresseAr" name="adresseAr"  value="{{App\Models\Etablissement::first()->adresseAr}}" type="text"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="message-text">Téléphone</label>
                                            <input class="form-control" id="telephone" name="telephone" value="{{App\Models\Etablissement::first()->telephone}}" type="text"/>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="message-text">Fax </label>
                                            <input class="form-control" id="fax" name="fax" value="{{App\Models\Etablissement::first()->fax}}" type="text"/>
                                        </div>
                                    </div>



                            </div>
                        </div>
                         {{--   <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Date début de l'année universitaire</label>
                                                <input class="datepicker-here form-control digits" type="text" data-language="en" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Date fin de l'année universitaire</label>
                                                <input class="datepicker-here form-control digits" type="text" data-language="en" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="message-text">Lettre de stage</label>
                                            <input class="form-control" type="file" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="message-text">Logo de l'établissement</label>
                                            <input class="form-control" type="file" />
                                        </div>
                                    </div>
                                </div>
                            </div>--}}

                        <div class="card-footer text-end">
                            <input class="btn btn-light" type="reset" value="Annuler" />
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
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    @endpush

@endsection

