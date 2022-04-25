use App\Models\Entreprise;
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
                <form class="form theme-form" method="POST" action={{ route('entreprise.store') }}>
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Nom</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Tapez le nom de l'entreprise ici..."
                                            type="text" name="nom" id="nom" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Adresse </label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Tapez l'adresse de l'entreprise ici..."
                                            type="text" name="adresse" id="adresse" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Adresse mail </label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Tapez l'adresse e-mail ici..."
                                            type="text" name="email" id="email" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Numéro de téléphone
                                    </label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Tapez le numéro de téléphone ici..."
                                            type="text" name="numero_telephone" id="numero_telephone" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Fax
                                    </label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Tapez le numéro de téléphone ici..."
                                            type="text" name="fax" id="fax" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-light" href="{{ route('list_entreprises') }}">Annuler</a>
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

