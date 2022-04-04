@extends('layouts.enseignant.master')

@section('title')Liste des stages actifs
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>La liste des stages actifs</h3>
@endslot
<li class="breadcrumb-item">Encadrement</li>
<li class="breadcrumb-item">La liste des stages actifs</li>

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Les Stages Actifs</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Etudiant</th>
                                    <th>Type de Stage</th>
                                    <th>Sujet</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Zouhour Ben Ticha</td>
                                    <td>LF3I obligatoire</td>
                                    <td>Application de gestion des stages </td>
                                    <td>01-02-2022</td>
                                    <td>31-05-2022</td>
                                    <td>
                                        <a href="#" data-title="Télécharger la lettre d'affectation" data-toggle="tooltip" data-original-title="Télécharger la lettre d'affectation" title="Télécharger la lettre d'affectation">
                                            <i class="icofont icofont-file-document icon-large" style="color:#bf9168 "></i></a>
                                        <a data-title="Consulter les détails de stage" data-toggle="tooltip" data-original-title="Consulter les détails de stage" title="Consulter les détails de stage"
                                           href={{ route('details_stage') }}>
                                            <i class="icofont icofont-info-square icon-large"></i></a>
                                        <a data-title="Consulter le cahier de stage" data-toggle="tooltip"  title="Consulter le cahier de stage"
                                           href={{ route('cahier_stage_etud') }}>
                                            <i class="icofont icofont-book-alt icon-large" style="color:#fd2e64"></i></a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>Meriam Hamdani</td>
                                    <td>LF3I obligatoire</td>
                                    <td>Application de gestion des stages </td>
                                    <td>01-02-2022</td>
                                    <td>31-05-2022</td>
                                    <td>
                                        <a href="#" data-title="Télécharger la lettre d'affectation" data-toggle="tooltip" data-original-title="Télécharger la lettre d'affectation" title="Télécharger la lettre d'affectation">
                                            <i class="icofont icofont-file-document icon-large" style="color:#bf9168 "></i></a>
                                        <a data-title="Consulter les détails de stage icon-large" data-toggle="tooltip" data-original-title="Consulter les détails de stage" title="Consulter les détails de stage"
                                           href={{ route('details_stage') }}>
                                            <i class="icofont icofont-info-square icon-large"></i></a>
                                        <a class="{{ routeActive('liste_stages_actifs') }}" data-title="Consulter le cahier de stage" data-toggle="tooltip"  title="Consulter le cahier de stage"
                                           href={{ route('cahier_stage_etud') }} >
                                            <i class="icofont icofont-book-alt icon-large" style="color:#fd2e64"></i></a>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Ali Ben Ali</td>
                                    <td>LF3I obligatoire</td>
                                    <td>Application de gestion des stages </td>
                                    <td>01-02-2022</td>
                                    <td>31-05-2022</td>
                                    <td>
                                        <a href="#" data-title="Télécharger la lettre d'affectation" data-toggle="tooltip" data-original-title="Télécharger la lettre d'affectation" title="Télécharger la lettre d'affectation">
                                            <i class="icofont icofont-file-document icon-large" style="color:#bf9168 "></i></a>
                                        <a data-title="Consulter les détails de stage" data-toggle="tooltip" data-original-title="Consulter les détails de stage" title="Consulter les détails de stage"
                                           href={{ route('details_stage') }}>
                                            <i class="icofont icofont-info-square icon-large"></i></a>
                                        <a class="{{ routeActive('liste_stages_actifs') }}" data-title="Consulter le cahier de stage" data-toggle="tooltip"  title="Consulter le cahier de stage"
                                           href={{ route('cahier_stage_etud') }} >
                                            <i class="icofont icofont-book-alt icon-large" style="color:#fd2e64"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Etudiant</th>
                                    <th>Type de Stage</th>
                                    <th>Sujet</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
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
<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/icons-notify.js') }}"></script>
<script src="{{ asset('assets/js/icons/flag-icon-clipart.js') }}"></script>
<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/icons-notify.js') }}"></script>
<script src="{{ asset('assets/js/icons/icon-clipart.js') }}"></script>
@endpush

@endsection

