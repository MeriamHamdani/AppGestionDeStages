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
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Jenette Caldwell</td>
                                    <td>Development Lead</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Yuri Berry</td>
                                    <td>Chief Marketing Officer (CMO)</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Caesar Vance</td>
                                    <td>Pre-Sales Support</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Doris Wilder</td>
                                    <td>Sales Assistant</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Angelica Ramos</td>
                                    <td>Chief Executive Officer (CEO)</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Gavin Joyce</td>
                                    <td>Developer</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Jennifer Chang</td>
                                    <td>Regional Director</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Brenden Wagner</td>
                                    <td>Software Engineer</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Fiona Green</td>
                                    <td>Chief Operating Officer (COO)</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Shou Itou</td>
                                    <td>Regional Marketing</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Michelle House</td>
                                    <td>Integration Specialist</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Suki Burks</td>
                                    <td>Developer</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Prescott Bartlett</td>
                                    <td>Technical Author</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                            class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Gavin Cortez</td>
                                    <td>Team Leader</td>
                                    <td><a class="btn btn-primary" href="/depot/gerer_depot/{stage}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Martena Mccray</td>
                                    <td>Post-Sales support</td>
                                    <td><a class="btn btn-primary" href="/depot/gerer_depot/{stage}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Gérer le dépôt</th>
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

