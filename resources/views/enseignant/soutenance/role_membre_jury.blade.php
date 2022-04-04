@extends('layouts.enseignant.master')

@section('title')Mes soutenances
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Soutenances</h3>
        @endslot
        <li class="breadcrumb-item">Soutenance</li>
        <li class="breadcrumb-item">Mes soutenances</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <!-- Ajax Generated content for a column start-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Mes soutenances en tant que membre de jury</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Rôle</th>
                                    <th>Informations sur la soutenance</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>DEV WEB</td>
                                    <td>Technical Author</td>
                                    <td>Président</td>
                                    <td><a class="btn btn-primary" href={{ Route('info_soutenance') }}
                                            class="{{ routeActive('info_soutenance') }}">
                                            <i class="icofont icofont-hat-alt">
                                                Infos sur la soutenance
                                            </i></a>
                                    </td>
                                    <td>
                                        <a href="#" data-title="Télécharger la grille d'évaluation" data-toggle="tooltip" data-original-title="Télécharger la grille d'évaluation" title="Télécharger la grille d'évaluation">
                                            <i class="icofont icofont-prescription icon-large" style="color:#bf9168 "></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dev mobile</td>
                                    <td>Team Leader</td>
                                    <td>Membre</td>
                                    <td><a class="btn btn-primary" href={{ Route('info_soutenance') }}
                                            class="{{ routeActive('info_soutenance') }}">
                                            <i class="icofont icofont-hat-alt">
                                                Infos sur la soutenance
                                            </i></a>
                                    </td>
                                    <td>
                                        <a href="#" data-title="Télécharger la grille d'évaluation" data-toggle="tooltip" data-original-title="Télécharger la grille d'évaluation" title="Télécharger la grille d'évaluation">
                                            <i class="icofont icofont-prescription icon-large" style="color:#bf9168 "></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Intelligence artificielle</td>
                                    <td>Post-Sales support</td>
                                    <td>Président</td>
                                    <td><a class="btn btn-primary" href={{ Route('info_soutenance') }}
                                            class="{{ routeActive('info_soutenance') }}">
                                            <i class="icofont icofont-hat-alt">
                                                Infos sur la soutenance
                                            </i></a>
                                    </td>
                                    <td>
                                        <a href="#" data-title="Télécharger la grille d'évaluation" data-toggle="tooltip" data-original-title="Télécharger la grille d'évaluation" title="Télécharger la grille d'évaluation">
                                            <i class="icofont icofont-prescription icon-large" style="color:#bf9168 "></i></a>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Rôle</th>
                                    <th>Informations sur la soutenance</th>
                                    <th>Actions</th>
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
    @endpush

@endsection


