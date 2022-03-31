@extends('layouts.admin.master')

@section('title')Gestion des spécialités
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">


@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Gestion des spécialités</h3>
        @endslot
        <li class="breadcrumb-item">Etablissement</li>
        <li class="breadcrumb-item">Gestion des spécialités</li>

    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>La liste des spécialités</h5>
                        <div style="padding-left: 2px">
                            <a href={{ route('ajouter_specialite') }}>
                                <i class="text-right" aria-hidden="true">
                                    <button class="btn btn-pill btn-success btn-sm pull-right" type="button">
                                        Ajouter une spécialité
                                    </button>
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="auto-fill">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Nom spécialité</th>
                                    <th>Déparetement</th>
                                    <th>Responsable</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>LIG</td>
                                    <td>Informatique de gestion</td>
                                    <th>Informatique</th>
                                    <th>Foulen ben </th>
                                    <td class="text-center">
                                        <a href="{{ route('modifier_specialite') }}"> <i style="font-size: 1.3em;"
                                                                                          class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>LC</td>
                                    <td>Licence Comptabilité</td>
                                    <td>Comptabilité</td>
                                    <th>Alex bt </th>
                                    <td class="text-center">
                                        <a href="{{ route('modifier_specialite') }}"> <i style="font-size: 1.3em;"
                                                                                          class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>LF</td>
                                    <td>Licence Finance</td>
                                    <td>Finance</td>
                                    <th>Zera v </th>
                                    <td class="text-center">
                                        <a href="{{ route('modifier_specialite') }}"> <i style="font-size: 1.3em;"
                                                                                          class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Code</th>
                                    <th>Nom spécialité</th>
                                    <th>Déparetement</th>
                                    <th>Responsable</th>
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

        <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
        <script src="{{ asset('assets/js/icons/icons-notify.js') }}"></script>
        <script src="{{ asset('assets/js/icons/feather-icon/feather-icon-clipart.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
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

