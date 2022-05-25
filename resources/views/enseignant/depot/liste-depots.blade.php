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
                                    <th>Type sujet</th>
                                    <th>Date début stage</th>
                                    <th>Date fin stage</th>
                                    <th>Date dépôt</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($demandes_depots_memoires as $demande_depot)
                                <tr>
                                    <td>{{$demande_depot->stage->titre_sujet}}</td>
                                    <td>{{ucwords($demande_depot->stage->etudiant->prenom)}} {{ucwords($demande_depot->stage->etudiant->nom)}}</td>
                                    <td>{{$demande_depot->stage->type_sujet}}</td>
                                    <td>{{$demande_depot->stage->date_debut}}</td>
                                    <td>{{$demande_depot->stage->date_fin}}</td>
                                    <td>{{$demande_depot->date_depot}}</td>
                                    <td>
                                        <a href="#" data-title="Consulter le mémoire" data-toggle="tooltip" data-original-title="Consulter le mémoire" title="Consulter le mémoire">
                                            <i class="icofont icofont-papers icon-large" style="color:#bf9168 "></i></a>
                                        <a data-title="Commenter le dépôt" data-toggle="tooltip"  title="Commenter le dépôt"
                                           href={{ route('details_depot') }}>
                                            <i class="icofont icofont-comment icon-large"></i></a>
                                    </td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Type sujet</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Date dépôt</th>
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
