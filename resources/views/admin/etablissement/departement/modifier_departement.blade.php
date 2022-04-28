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
                <form class="form theme-form needs-validation" novalidate="" method="post"
                    action="{{ route('departement.update',['id'=>$departement->id]) }}">
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
                            <div class="form-group">
                                <label class="form-label" for="exampleFormControlInput1">Code département </label>
                                <div class="input-group">
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                           name="code" id="code" placeholder="entrez le code de département..."
                                           value="{{ $departement->code }}" required=""/>
                                    <div class="invalid-tooltip">Entrez le code svp!</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleFormControlInput1">Nom département </label>
                                <div class="input-group">
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                           name="nom" id="nom" placeholder="entrez le nom du département..."
                                           value="{{$departement->nom }}" required=""/>
                                    <div class="invalid-tooltip">Entrez le nom svp!</div>
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
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>

@endpush

@endsection

