@extends('layouts.admin.master')

@section('title')Ajouter un enseignant
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Ajouter un enseignant</h3>
@endslot
<!--<li class="breadcrumb-item">Forms</li>
		<li class="breadcrumb-item">Form Controls</li>-->
<!--<li class="breadcrumb-item active">Demander un stage</li>-->
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <!-- <div class="card-header pb-0">
                    <h5>Basic form control</h5>
                </div>-->
                <form class="form theme-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Nom de l'enseignant</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Le nom..." type="text" />
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
                                        <input class="form-control" placeholder="Le prénom..." type="text" />
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
                                        <input class="form-control" placeholder="le num de CIN..." type="text" />
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
                                        <input class="form-control" placeholder="La grade..." type="text" />
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
                                        <input class="form-control" placeholder="e-mail..." type="text" />
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
                                        <input class="form-control" placeholder="Le numéro de telephone..."
                                            type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Ajouter</button>
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

