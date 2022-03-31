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
                <form class="form theme-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">Nom </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        placeholder="entrez le nom de l'administrateur..." />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">Prénom </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        placeholder="entrez le prénom de l'administrateur..." />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">Numéro de téléphone</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="number"
                                        placeholder="entrez le numéro de téléphone de l'administrateur..." />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">E-mail </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="email"
                                        placeholder="entrez l'adresse mail de l'administrateur..." />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">Numéro de CIN</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="number"
                                        placeholder="entrez le numéro de CIN de l'administrateur..." />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">Mot de passe </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="password"
                                           placeholder="entrez le mot de passe" />
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <input class="btn btn-light" type="reset" value="Annuler" />
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

