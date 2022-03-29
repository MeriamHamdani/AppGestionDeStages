@extends('layouts.admin.master')

@section('title')Modifier les informations de l'enseignant
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Modifier les informations de l'enseignant</h3>
@endslot

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <form class="form theme-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Nom de l'enseignant</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Le nom..." type="text"
                                            value="Ben Foulène" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le prénom de
                                        l'Encadrant</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Le prénom..." type="text"
                                            value=" Foulène" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le numéro de CIN de
                                        l'enseignant</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="le num de CIN..." type="text"
                                            value="88888888" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">La grade de
                                        l'enseignant</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="La grade..." type="text"
                                            value="mètre assistant" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">L'adresse mail de
                                        l'enseignant</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="e-mail..." type="text"
                                            value="foulene@foulene.com" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le numéro de
                                        téléphone de l'enseignant</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Le numéro de telephone..." type="text"
                                            value="55555555" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Modifier</button>
                        <input class="btn btn-light" type="reset" value="Annuler" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush
@endsection

