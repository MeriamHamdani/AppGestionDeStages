@extends('layouts.etudiant.master')

@section('title')Déposer mon mémoire
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Déposer mon mémoire</h3>
@endslot
<li class="breadcrumb-item">Dépôt</li>
<li class="breadcrumb-item">Gérer le dépôt</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <!-- Ajax Generated content for a column start-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Stage & Dépôt</h5>
                    <span>Ce table contient titre de stage et une action qui m'amène à dépôser mon mémoire s'il est
                        possible</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Gérer le dépôt</th>
                                    <th>Etat</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td>Dai Rios</td>
                                    <td>Personnel Lead</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a>
                                    </td>
                                    <td><button class="btn btn-warning btn-sm" data-toggle="tooltip" title="demande dépôt en attente">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenette Caldwell</td>
                                    <td>Development Lead</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a>
                                    </td>
                                    <td><button class="btn btn-primary btn-sm" data-toggle="tooltip" title="demande dépôt confirmée">
                                            <i class="icofont icofont-ui-check"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Yuri Berry</td>
                                    <td>Chief Marketing Officer (CMO)</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a>
                                    </td>
                                    <td><button class="btn btn-danger btn-sm" data-toggle="tooltip" title="demande dépôt refusée">
                                            <i class="icofont icofont-ui-close"></i>
                                        </button>
                                        <button class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Les remarques de l'encadrant">
                                               <a href={{ Route('remarques_encadrant') }}>
                                            <i class="icofont icofont-comment" style="color: white"></i>
                                               </a>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Caesar Vance</td>
                                    <td>Pre-Sales Support</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a>
                                    </td>
                                    <td><button class="btn btn-primary btn-sm" data-toggle="tooltip" title="demande dépôt confirmée">
                                            <i class="icofont icofont-ui-check"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Gérer le dépôt</th>
                                    <th>Etat</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ajax Generated content for a column end-->
    </div>
</div>


@push('scripts')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/icons-notify.js') }}"></script>
<script src="{{ asset('assets/js/icons/icon-clipart.js') }}"></script>
@endpush

@endsection

