@extends('layouts.etudiant.master')

@section('title')Mes soutenances
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Mes soutenances</h3>
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
                        <h5>Mes soutenances</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Informations sur ma soutenance</th>
                                </tr>
                                </thead>
                                @foreach($soutenances as $st)
                                <tbody>
                                <tr>
                                    <td>{{$st->stage->titre_sujet}}</td>
                                    <td>{{$st->stage->type_sujet}}</td>
                                    <td><a class="btn btn-primary" href={{ Route('info_soutenance',$st) }}
                                            class="{{ routeActive('info_soutenance') }}">
                                            <i class="icofont icofont-hat-alt">
                                                Infos sur ma soutenance
                                            </i></a></td>

                                </tr>
                                </tbody>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Informations sur ma soutenance</th>
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

