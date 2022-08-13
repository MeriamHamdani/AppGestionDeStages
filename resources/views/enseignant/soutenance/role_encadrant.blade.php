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
                        <h5>Mes soutenances en tant qu'Encadrant</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Informations sur la soutenance</th>
                                </tr>
                                </thead>
                                @foreach($soutenances as $stnc)
                                    <tbody>
                                    <tr>
                                        <td>{{$stnc->stage->titre_sujet}}</td>
                                        <td>{{ucwords($stnc->stage->etudiant->prenom)}} {{ucwords($stnc->stage->etudiant->nom)}}</td>
                                        <td><a class="btn btn-primary" href={{ route('info_soutenance_ens',$stnc) }}
                                                class="{{ routeActive('info_soutenance_ens') }}">
                                                <i class="icofont icofont-hat-alt">
                                                    Infos sur la soutenance
                                                </i></a></td>
                                    </tr>
                                    </tbody>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Informations sur la soutenance</th>
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
