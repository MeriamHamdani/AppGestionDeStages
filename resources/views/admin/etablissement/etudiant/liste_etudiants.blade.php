@extends('layouts.admin.master')

@section('title')Gestion des etudiants
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">


@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Gestion des etudiants</h3>
@endslot
<li class="breadcrumb-item">Etablissement</li>
<li class="breadcrumb-item">Gestion des étudiants</li>

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>La liste des etudiants</h5>
                    <div style="padding-left: 2px">
                        <a href={{ route('ajouter_etudiant') }}>
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success btn-sm pull-right" type="button">
                                    Ajouter un étudiant
                                </button>
                            </i>
                        </a>
                        <a href=#>
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success btn-sm pull-right" type="button"
                                    data-bs-toggle="modal" data-bs-target="#export" data-whatever="@getbootstrap">
                                    Exporter des étudiants
                                </button>
                                <div class="modal fade" id="export" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Exporter la liste des etudiants</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Fermez"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label class="col-form-label" for="recipient-name">Exporter
                                                            selon la Classe</label>
                                                        <div class="mb-2">
                                                            <select class="js-example-basic-single col-sm-12"
                                                                id="classe_id" name="classe_id" required>
                                                                <option disabled="disabled" selected="selected">
                                                                    Sélectionnez la classe</option>
                                                                @foreach(\App\Models\Classe::all() as $classe)
                                                                <option value="{{ $classe->id }}" {{
                                                                    old('classe_id')==$classe->id ? 'selected' : '' }}>
                                                                    {{ ucwords($classe->nom) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button class="btn btn-primary" type="button">Exporter</button>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label" for="recipient-name">Exporter
                                                            selon la Spécialité</label>
                                                        <div class="mb-2">
                                                            <select class="js-example-basic-single col-sm-12"
                                                                id="specialite_id" name="specialite_id" required>
                                                                <option disabled="disabled" selected="selected">
                                                                    Sélectionnez la spécialité</option>
                                                                @foreach (\App\Models\Specialite::all() as $specialite)
                                                                <option value="{{ $specialite->id }}" {{
                                                                    old('specialite_id')==$specialite->id ? 'selected' :
                                                                    '' }}
                                                                    >{{ ucwords($specialite->nom) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button class="btn btn-primary" type="button">Exporter</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-bs-dismiss="modal">Annuler</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </i>
                        </a>
                        <a href=#>
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success btn-sm pull-right" type="button"
                                    data-bs-toggle="modal" data-bs-target="#import" data-whatever="@getbootstrap">
                                    Importer des étudiants
                                </button>
                                <div class="modal fade" id="import" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Importer la liste des etudiants</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('sauvegarder_etudiants_csv') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="col-form-label"
                                                            for="recipient-name">Classe</label>
                                                        <div class="mb-2">
                                                            <select class="js-example-basic-single col-sm-12"
                                                                id="classe_id" name="classe_id" required>
                                                                <option disabled="disabled" selected="selected">
                                                                    Sélectionnez la classe</option>
                                                                @foreach(\App\Models\Classe::all() as $classe)
                                                                <option value="{{ $classe->id }}" {{
                                                                    old('classe_id')==$classe->id ? 'selected' : '' }}>
                                                                    {{ ucwords($classe->nom) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label" for="message-text">Fichier
                                                            CSV</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" type="file" accept=".csv"
                                                                name="liste_etudiants" />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-primary" type="submit">Importer</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </i>
                        </a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="dt-ext table-responsive">

                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>N°CIN</th>
                                    <th>Classe</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($etudiants as $etudiant)
                                <tr>
                                    <td>{{ucwords($etudiant->nom)}} {{ucwords($etudiant->prenom)}}</td>
                                    <td>{{($etudiant->user->numero_CIN)}}</td>
                                    <td>{{ucwords($etudiant->classe->nom)}}</td>
                                    <td>{{ucwords($etudiant->email)}}</td>
                                    <td>{{($etudiant->numero_telephone)}}</td>
                                    @if(App\Models\User::find($etudiant->user_id)->is_active == 1)
                                    <td><a class=" btn btn-icon-only default" href="#" data-placement="top"
                                            data-toggle="tooltip" title="Active"><img
                                                src="{{ asset('assets/images/userActive.png') }}">
                                        </a>
                                    </td>
                                    @else
                                    <td><a class=" btn btn-icon-only default" href="#" data-placement="top"
                                            data-toggle="tooltip" title="Active"><img
                                                src="{{ asset('assets/images/usercancled.png') }}">
                                        </a>
                                    </td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{ route('modifier_etudiant',$etudiant) }}"> <i
                                                style="font-size: 1.3em;" class='fa fa-edit'></i></a>
                                        <a href="{{ route('supprimer_etudiant',$etudiant) }}"> <i
                                                style="font-size: 1.3em;" class='fa fa-trash'></i></a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>N°CIN</th>
                                    <th>Classe</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')

<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/icons-notify.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon-clipart.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/custom.js')}}"></script>
@endpush

@endsection

