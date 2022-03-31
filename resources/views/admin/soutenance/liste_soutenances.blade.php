@extends('layouts.admin.master')

@section('title')Liste des soutenances
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">

@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>La liste des soutenances</h3>
@endslot
<li class="breadcrumb-item">Soutenance</li>
<li class="breadcrumb-item">La liste des soutenances</li>

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Les soutenances</h5>

                </div>
                <div style="padding-bottom: 16px; padding-right: 30px;">
                    <a href={{ route('planifier_soutenance') }}>
                        <i class="text-right" aria-hidden="true">
                            <button class="btn btn-pill btn-success pull-right" type="button">
                                Planifier une soutenance
                            </button>
                        </i>
                    </a>
                    <a href="#">
                        <i class="text-right" aria-hidden="true">
                            <button class="btn btn-pill btn-success pull-right" type="button"
                                style="margin-right: 0.5cm">
                                PV de soutenance
                            </button>
                        </i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">

                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Nom et prénom de l'etudiant</th>
                                    <th>Classe</th>
                                    <th>Sujet</th>
                                    <th>Date</th>
                                    <th>Salle</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Flen ben foulene</td>
                                    <td>LF3I</td>
                                    <td>application de gestion des stages</td>
                                    <td>06-06-2022</td>
                                    <td>amphi 2</td>
                                    <td class="text-center">
                                        <a href="pv-soutenance.txt" download="PV-soutenance.txt"
                                            data-title="télécharger le pv de soutenance" data-toggle="tooltip"> <i
                                                class="icofont icofont-file-text"></i></a>
                                        <a href="{{ route('evaluer_soutenance') }}" data-title="évaluer le soutenance"
                                            data-toggle="tooltip"> <i class="icofont icofont-tick-mark"></i></a>
                                        <a href="evaluation.pdf" download="evaluation-soutenance.pdf"
                                            data-title="télécharger le fichier d'évaluation de soutenance"
                                            data-toggle="tooltip"> <i class="icofont icofont-file-pdf"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Flen ben foulene</td>
                                    <td>LF3I</td>
                                    <td>application de gestion des stages</td>
                                    <td>06-06-2022</td>
                                    <td>amphi 2</td>
                                    <td class="text-center">
                                        <a href="pv-soutenance.txt" download="PV-soutenance.txt"
                                            data-title="télécharger le pv de soutenance" data-toggle="tooltip"> <i
                                                class="icofont icofont-file-text"></i></a>
                                        <a href="{{ route('evaluer_soutenance') }}" data-title="évaluer le soutenance"
                                            data-toggle="tooltip"> <i class="icofont icofont-tick-mark"></i></a>
                                        <a href="evaluation.pdf" download="evaluation-soutenance.pdf"
                                            data-title="télécharger le fichier d'évaluation de soutenance"
                                            data-toggle="tooltip"> <i class="icofont icofont-file-pdf"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Flen ben foulene</td>
                                    <td>LF3I</td>
                                    <td>application de gestion des stages</td>
                                    <td>06-06-2022</td>
                                    <td>amphi 2</td>
                                    <td class="text-center">
                                        <a href="pv-soutenance.txt" download="PV-soutenance.txt"
                                            data-title="télécharger le pv de soutenance" data-toggle="tooltip"> <i
                                                class="icofont icofont-file-text"></i></a>
                                        <a href="{{ route('evaluer_soutenance') }}" data-title="évaluer le soutenance"
                                            data-toggle="tooltip"> <i class="icofont icofont-tick-mark"></i></a>
                                        <a href="evaluation.pdf" download="evaluation-soutenance.pdf"
                                            data-title="télécharger le fichier d'évaluation de soutenance"
                                            data-toggle="tooltip"> <i class="icofont icofont-file-pdf"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Nom et prénom de l'etudiant</th>
                                    <th>Classe</th>
                                    <th>Sujet</th>
                                    <th>Date</th>
                                    <th>Salle</th>
                                    <th>Action</th>
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

