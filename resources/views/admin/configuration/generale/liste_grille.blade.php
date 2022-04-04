@extends('layouts.admin.master')

@section('title')Les grilles d'évaluation
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Liste des grilles d'évaluation</h3>
@endslot
<li class="breadcrumb-item">Configuration</li>
<li class="breadcrumb-item">Configuration Générale</li>
<li class="breadcrumb-item">Configurer la grille d'évaluation</li>

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Les Grilles</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Année Universitaire</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2019-2020</td>




                                    <td class="text-center">
                                        <a href="#" data-toggle="tooltip" data-title="consulter" title="consulter"><i
                                                class="icofont icofont-eye-alt" style="font-size: 1.7em;"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2020-2021</td>


                                    <td class="text-center">
                                        <a href="#" data-toggle="tooltip" data-title="consulter" title="consulter"><i
                                                class="icofont icofont-eye-alt" style="font-size: 1.7em;"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2021-2022</td>
                                    <td class="text-center">
                                        <a href="{{ route('configurer_grille') }}" data-toggle="tooltip"
                                            data-title="configurer" title="configurer"> <i
                                                class="icofont icofont-settings-alt" style="font-size: 2em;"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>

                                <tr>
                                    <th>Année Universitaire</th>
                                    <th>action</th>

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