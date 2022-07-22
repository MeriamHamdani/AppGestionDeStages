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
                            <button class="btn btn-pill btn-success pull-right" type="button" href={{
                                route('planifier_soutenance') }}>
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
                                    <th>Heure</th>
                                    <th>Salle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @php
                            $soutenances=App\Models\Soutenance::all();
                            @endphp
                            <tbody>
                                @foreach ($soutenances as $soutenance )
                                <tr>
                                    @php
                                    $stage=App\Models\Stage::find($soutenance->stage_id);
                                    $etudiant=App\Models\Etudiant::find($stage->etudiant_id);
                                    $classe=App\Models\Classe::find($etudiant->classe_id);
                                    @endphp
                                    <td>{{ $etudiant->nom }}&nbsp;{{ $etudiant->prenom }}</td>
                                    <td>{{ $classe->code }}</td>
                                    <td>{{ $stage->titre_sujet }}</td>
                                    <td>{{ $soutenance->date }}</td>
                                    <td>{{ $soutenance->start_time }}</td>
                                    <td>{{ $soutenance->salle }}</td>
                                    <td class="text-center">
                                        <a href="pv-soutenance.txt" download="PV-soutenance.txt"
                                            data-title="télécharger le pv de soutenance" data-toggle="tooltip"> <i
                                                class="icofont icofont-file-text icon-large"></i></a>
                                        <a href="{{ route('evaluer_soutenance') }}" data-title="évaluer le soutenance"
                                            data-toggle="tooltip"> <i
                                                class="icofont icofont-tick-mark icon-large"></i></a>
                                        <a href="evaluation.pdf" download="evaluation-soutenance.pdf"
                                            data-title="télécharger le fichier d'évaluation de soutenance"
                                            data-toggle="tooltip"> <i
                                                class="icofont icofont-file-pdf icon-large"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Nom et prénom de l'etudiant</th>
                                    <th>Classe</th>
                                    <th>Sujet</th>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th>Salle</th>
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

