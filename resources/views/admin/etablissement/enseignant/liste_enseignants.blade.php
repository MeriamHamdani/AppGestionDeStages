@extends('layouts.admin.master')

@section('title')Gestion des enseignants
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
<h3>Gestion des enseignants</h3>
@endslot
<li class="breadcrumb-item">Etablissement</li>
<li class="breadcrumb-item">Gestion des enseignants</li>

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>La liste des Enseignants</h5>
                    <div style="padding-left: 2px">
                        <a href={{ route('ajouter_enseignant') }}>
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success btn-sm pull-right" type="button">
                                    Ajouter un Enseignant
                                </button>
                            </i>
                        </a>
                        <a href=#>
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success btn-sm pull-right" type="button"
                                        data-bs-toggle="modal" data-bs-target="#export"
                                        data-whatever="@getbootstrap">
                                    Exporter des enseignants
                                </button>
                                <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Exporter la liste des enseignants</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Fermez"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <div class="mb-2">
                                                            <select class="js-example-basic-single col-sm-12">
                                                                <option value="0">Sélectionnez le département</option>
                                                                <option value="5">Exportez tous</option>
                                                                <option value="1">Comptabilité</option>
                                                                <option value="2">GRH</option>
                                                                <option value="3">Finance</option>
                                                                <option value="4">Info</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Annuler</button>
                                                <button class="btn btn-primary" type="button">Exporter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </i>
                        </a>
                        <a href=#>
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success btn-sm pull-right" type="button"
                                        data-bs-toggle="modal" data-bs-target="#import"
                                        data-whatever="@getbootstrap">
                                   Importer des enseignants
                                </button>
                                <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Importer la liste des enseignants</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label class="col-form-label" for="recipient-name">Département</label>
                                                        <div class="mb-2">
                                                            <select class="js-example-basic-single col-sm-12">
                                                                    <option value="0">Sélectionnez le département</option>
                                                                    <option value="1">Comptabilité</option>
                                                                    <option value="2">GRH</option>
                                                                    <option value="3">Finance</option>
                                                                    <option value="4">Info</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label" for="message-text">Fichier CSV</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" type="file" />
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Annuler</button>
                                                <button class="btn btn-primary" type="button">Importer</button>
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
                                    <th>Département</th>
                                    <th>Grade</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ben Foulen Foulen</td>
                                    <td>Info</td>
                                    <td>maitre assistant</td>
                                    <td>foulene@benfoulen.com</td>
                                    <td>888888</td>
                                    <td><a class=" btn btn-icon-only default" href="#" data-placement="top"
                                           data-toggle="tooltip" title="Désactiver"><img
                                                src="{{ asset('assets/images/userActive.png') }}">

                                        </a>
                                    </td>
                                    <td class="text-center">

                                        <a href="{{ route('modifier_enseignant') }}"> <i style="font-size: 1.3em;"
                                                class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>Ben Foulen Foulen</td>
                                    <td>Info</td>
                                    <td>maitre assistant</td>
                                    <td>foulene@benfoulen.com</td>
                                    <td>888888</td>
                                    <td><a class=" btn btn-icon-only default" href="#" data-placement="top"
                                           data-toggle="tooltip" title="Désactiver"><img
                                                src="{{ asset('assets/images/usercancled.png') }}">

                                        </a>
                                    </td>
                                    <td class="text-center">

                                        <a href="{{ route('modifier_enseignant') }}"> <i style="font-size: 1.3em;"
                                                class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>Ben Foulen Foulen</td>
                                    <td>Info</td>
                                    <td>maitre assistant</td>
                                    <td>foulene@benfoulen.com</td>
                                    <td>888888</td>
                                    <td><a class=" btn btn-icon-only default" href="#" data-placement="top"
                                           data-toggle="tooltip" title="Désactiver"><img
                                                src="{{ asset('assets/images/userActive.png') }}">

                                        </a>
                                    </td>
                                    <td class="text-center">

                                        <a href="{{ route('modifier_enseignant') }}"> <i style="font-size: 1.3em;"
                                                class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>




                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>Département</th>
                                    <th>Grade</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
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

