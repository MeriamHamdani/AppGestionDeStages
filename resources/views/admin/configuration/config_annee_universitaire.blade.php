@extends('layouts.admin.master')

@section('title')Ajouter Année Universitaire
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter une année universitaire</h3>
        @endslot
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item">Ajouter une année universitaire</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ajouter une année universitaire</h5>
                    </div>
                    <form class="form theme-form" method="POST" action="{{ route('ajouter_annee_universitaire') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Année Universitaire  </label>
                                        <input class="form-control" id="annee" name="annee" type="text"
                                               placeholder="2021-2022"  />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
{{--                            <input class="btn btn-light" type="reset" value="Annuler" />--}}
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    @endpush

@endsection

