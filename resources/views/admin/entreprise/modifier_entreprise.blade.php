@extends('layouts.admin.master')

@section('title')Modifier les coordonnées de l'entreprise
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Modifier les coordonnées de l'entreprise</h3>
@endslot

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <form class="form theme-form" method="POST" action={{ route('entreprise.update',['id'=>$entreprise->id])
                    }}>
                    @csrf
                    <div class="card-body">

                        <!----------------------------------------------------------------------------->
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $err )
                            {{ $err }}
                            @endforeach
                        </div>
                        @endif
                        <!------------------------------------------------------------------------------>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Le nom de l'entreprise</label>
                                    <div class="mb-3">
                                        <input class="form-control" type="text" name="nom" id="nom"
                                            value="{{ $entreprise->nom }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">L'adresse de
                                        l'entreprise</label>
                                    <div class="mb-3">
                                        <input class="form-control" type="text" name="adresse" id="adresse"
                                            value="{{  $entreprise->adresse }} " />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">l'adresse e-mail de
                                        l'entreprise</label>
                                    <div class="mb-3">
                                        <input class="form-control" type="text" name="email" id="emal"
                                            value="{{ $entreprise->email }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le numéro de
                                        téléphone</label>
                                    <div class="mb-3">
                                        <input class="form-control" type="text" name="numero_telephone"
                                            id="numero_telephone" value="{{ $entreprise->numero_telephone }}" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Modifier</button>
                        <a class="btn btn-light" href="{{ route('list_entreprises') }}">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush
@endsection

