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

                <form class="form theme-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Le nom de l'entreprise</label>
                                    <div class="mb-3">
                                        <input class="form-control" type="text" value="Hyper-group" />
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
                                        <input class="form-control" type="text" value=" Sfax " />
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
                                        <input class="form-control" type="text" value="hyper@groupe.com" />
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
                                        <input class="form-control" type="text" value="88888888" />
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

