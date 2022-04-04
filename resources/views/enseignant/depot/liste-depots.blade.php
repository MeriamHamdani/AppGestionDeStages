@extends('layouts.enseignant.master')

@section('title')Dépôt
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Dépôt</h3>
        @endslot
        <li class="breadcrumb-item">Dépôt</li>
        <li class="breadcrumb-item">Traiter les dépôts</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>La Liste des demandes de dépôt</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="advance-1">
                                <thead>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>2011/04/25</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <a href="#" data-title="Consulter le mémoire" data-toggle="tooltip" data-original-title="Consulter le mémoire" title="Consulter le mémoire">
                                            <i class="icofont icofont-papers icon-large" style="color:#bf9168 "></i></a>
                                        <a data-title="Commenter le dépôt" data-toggle="tooltip"  title="Commenter le dépôt"
                                           href={{ route('details_depot') }}>
                                            <i class="icofont icofont-comment icon-large"></i></a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Michael Bruce</td>
                                    <td>Javascript Developer</td>
                                    <td>2011/04/25</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <a href="#" data-title="Consulter le mémoire" data-toggle="tooltip" data-original-title="Consulter le mémoire" title="Consulter le mémoire">
                                            <i class="icofont icofont-papers icon-large" style="color:#bf9168 "></i></a>
                                        <a data-title="Commenter le dépôt" data-toggle="tooltip"  title="Commenter le dépôt"
                                           href={{ route('details_depot') }}>
                                            <i class="icofont icofont-comment icon-large"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Donna Snider</td>
                                    <td>Customer Support</td>
                                    <td>2011/04/25</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <a href="#" data-title="Consulter le mémoire" data-toggle="tooltip" data-original-title="Consulter le mémoire" title="Consulter le mémoire">
                                           <i class="icofont icofont-papers icon-large" style="color:#bf9168 "></i></a>
                                        <a  data-title="Commenter le dépôt" data-toggle="tooltip"  title="Commenter le dépôt"
                                           href={{ route('details_depot') }}>
                                            <i class="icofont icofont-comment icon-large"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
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
        <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    @endpush

@endsection
