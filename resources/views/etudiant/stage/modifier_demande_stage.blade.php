@extends('layouts.etudiant.master')

@section('title')Modifier Classe
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Choisir un autre encadrant</h3>
        @endslot
        <!--<li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Modifier  les informations de la classe</li>-->
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <form class="form theme-form" method="POST" action="{{ route('update_demande',['stage_id'=>$stage->id]) }}"
                          enctype="multipart/form-data">
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
                                        <label class="form-label" for="exampleFormControlSelect9">Le nom de
                                            l'Encadrant</label>
                                        <select class="js-example-basic-single col-sm-12" id="enseignant_id"
                                                name="enseignant_id" required>
                                            <option disabled="disabled" selected="selected">Choisissez l'encadrant
                                                académique
                                            </option>
                                            @foreach ($enseignants as $enseignant )
                                                <option
                                                    value="{{ $enseignant->id }}"
                                                    {{ old('enseignant_id') == $enseignant->id ? 'selected' : '' }}
                                                >{{ ucwords($enseignant->nom) }} {{ ucwords($enseignant->prenom) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-light" type="reset" href="{{route('demandes_stages')}}" value="Annuler"/>
                            <button class="btn btn-primary" type="submit">Sauvegarder</button>

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

