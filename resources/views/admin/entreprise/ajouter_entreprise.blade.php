@extends('layouts.admin.master')

@section('title')Ajouter une entreprise
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Ajouter une entreprise</h3>
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
                                    <label class="form-label">Nom de l'entreprise</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Tapez le nom de l'entreprise ici..."
                                            type="text" />
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
                                        <input class="form-control" placeholder="Tapez l'adresse de l'entreprise ici..."
                                            type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">L'adresse e-mail de
                                        l'entreprise'</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Tapez l'adresse e-mail ici..."
                                            type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le numéro de téléphone de
                                        l'entreprise</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Tapez le numéro de téléphone ici..."
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

