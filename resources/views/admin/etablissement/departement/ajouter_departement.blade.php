@extends('layouts.admin.master')

@section('title')Ajouter Département
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Ajouter un département</h3>
@endslot
<li class="breadcrumb-item">Administration</li>
<li class="breadcrumb-item">Ajouter un département</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <!--<div class="card-header pb-0">
                        <h5>Ajouter un département</h5>
                    </div>-->
                <form class="form theme-form" method="POST" action="{{ route('departement.store') }}">
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
                                    <label class="form-label" for="exampleFormControlInput1">Code département </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" name="code"
                                        id="code" placeholder="entrez le code de département..." />
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">

                                <label class="form-label" for="exampleFormControlInput1">Nom département </label>
                                <input class="form-control" id="exampleFormControlInput1" type="text" name="nom"
                                    id="nom" placeholder="entrez le nom du département..." />
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-light" href="{{ route('liste_departements') }}">Annuler</a>
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
