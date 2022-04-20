@extends('layouts.admin.master')

@section('title')Modifier les informations d'un Département
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Modifier les informations du département</h3>
@endslot
<li class="breadcrumb-item">Administration</li>
<li class="breadcrumb-item">Modifier les informations du département</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Modifier les informations du département</h5>

                </div>

                <form class="form theme-form" method="post"
                    action="{{ route('departement.update',['id'=>$departement->id]) }}">
                    @csrf

                    <div class="card-body">
                        @if($errors->any())
                        @foreach ($errors->all() as $err )
                        <div class="text-red-600">{{ $err }}</div>
                        @endforeach

                        @endif
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Code département </label>
                                    <input class="form-control" id="code" name="code" type="text" value="{{
                                        $departement->code }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">

                                <label class="form-label" for="exampleFormControlInput1">Nom département </label>
                                <input class="form-control" id="nom" name="nom" type="text" value="{{
                                    $departement->nom }}" />
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-light" href="{{ route('liste_departements') }}">Annuler</a>
                        <button class="btn btn-primary" type="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')
@endpush

@endsection

