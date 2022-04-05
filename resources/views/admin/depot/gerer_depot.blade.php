@extends('layouts.admin.master')

@section('title')Dépôt
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/buttonload.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Dépôt</h3>
@endslot
<li class="breadcrumb-item">Dépôt</li>
<li class="breadcrumb-item">Gérer les dépôts</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Listes des demandes de dépôt</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="advance-1">
                            <thead>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Date d'envoi de la demande</th>
                                    <th>Encadrant</th>
                                    <th>confirmation de l'encadrant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>2011/04/25</td>
                                    <td>encadrant</td>
                                    <td class="text-center">
                                        <button class="buttonload" data-toggle="tooltip" title="demande en attente">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" data-title="Consulter la mémoire" data-toggle="tooltip"
                                            data-original-title="Consulter le mémoire" title="Consulter le mémoire">
                                            <i class="icofont icofont-papers icon-large"></i></a>
                                        <a href="#" data-title="Valider le dépôt du mémoire" data-toggle="tooltip"
                                            title="Valider le dépôt du mémoire">
                                            <i class="icofont icofont-checked icon-large"></i></a>
                                        <a href="#" data-title="Refuser le dépôt du mémoire" data-toggle="tooltip"
                                            title="Refuser le dépôt du mémoire">
                                            <i class="icofont icofont-close-squared icon-large"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Michael Bruce</td>
                                    <td>Javascript Developer</td>
                                    <td>2011/04/25</td>
                                    <td>encadrant</td>
                                    <td>
                                        <a href="#" data-toggle="tooltip" title="demande refusée"
                                            onclick="this.disabled = true">
                                            <i style="background-position: 0 -90px;
                                                height: 30px;
                                                width: 23px;
                                                display:block;
                                                margin:0 auto;" class="icofont icofont-ui-close icon-large"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" data-title="Consulter la mémoire" data-toggle="tooltip"
                                            data-original-title="Consulter le mémoire" title="Consulter le mémoire">
                                            <i class="icofont icofont-papers icon-large"></i></a>
                                        <a href="#" data-title="Valider le dépôt du mémoire" data-toggle="tooltip"
                                            title="Valider le dépôt du mémoire">
                                            <i class="icofont icofont-checked icon-large"></i></a>
                                        <a href="#" data-title="Refuser le dépôt du mémoire" data-toggle="tooltip"
                                            title="Refuser le dépôt du mémoire">
                                            <i class="icofont icofont-close-squared icon-large"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Donna Snider</td>
                                    <td>Customer Support</td>

                                    <td>2011/04/25</td>
                                    <td>encadrant</td>
                                    <td>
                                        <a href="#" data-toggle="tooltip" title="demande confirmée"
                                            onclick="this.disabled = true">
                                            <i style="background-position: 0 -90px;
                                                    height: 30px;
                                                    width: 23px;
                                                    display:block;
                                                    margin:0 auto;" class="icofont icofont-ui-check icon-large"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" data-title="Consulter la mémoire" data-toggle="tooltip"
                                            data-original-title="Consulter le mémoire" title="Consulter le mémoire">
                                            <i class="icofont icofont-papers icon-large"></i></a>
                                        <a href="#" data-title="Valider le dépôt du mémoire" data-toggle="tooltip"
                                            title="Valider le dépôt du mémoire">
                                            <i class="icofont icofont-checked icon-large"></i></a>
                                        <a href="#" data-title="Refuser le dépôt du mémoire" data-toggle="tooltip"
                                            title="Refuser le dépôt du mémoire">
                                            <i class="icofont icofont-close-squared icon-large"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Date d'envoi de la demande</th>
                                    <th>Encadrant</th>
                                    <th>Confirmation de l'encadrant</th>
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
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@endpush

@endsection

