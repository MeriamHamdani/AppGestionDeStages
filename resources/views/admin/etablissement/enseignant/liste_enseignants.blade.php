@extends('layouts.admin.master')

@section('title')Gestion des enseignants
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">

@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Gestion des enseignants</h3>
@endslot
<li class="breadcrumb-item">Etablissement</li>
<li class="breadcrumb-item">Gestion des enseignants</li>

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>La liste des Enseignant</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <div>
                            <a href={{ route('ajouter_enseignant') }}>
                                <i class="text-right" aria-hidden="true">
                                    <button class="btn btn-pill btn-success pull-right" type="button">
                                        Ajouter un Enseignant
                                    </button>
                                </i>
                            </a>
                        </div>
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Grade</th>
                                    <th>numero CIN</th>
                                    <th>Adresse e-mail</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ben Foulen</td>
                                    <td>Foulen</td>
                                    <td>mètre assistant</td>
                                    <td>888888</td>
                                    <td>foulene@benfoulen.com</td>
                                    <td class="text-center">

                                        <a href="{{ route('modifier_enseignant') }}"> <i style="font-size: 1.3em;"
                                                class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>Ben Foulen</td>
                                    <td>Foulen</td>
                                    <td>mètre assistant</td>
                                    <td>888888</td>
                                    <td>foulene@benfoulen.com</td>
                                    <td class="text-center">

                                        <a href="{{ route('modifier_enseignant') }}"> <i style="font-size: 1.3em;"
                                                class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>Ben Foulen</td>
                                    <td>Foulen</td>
                                    <td>mètre assistant</td>
                                    <td>888888</td>
                                    <td>foulene@benfoulen.com</td>
                                    <td class="text-center">

                                        <a href="{{ route('modifier_enseignant') }}"> <i style="font-size: 1.3em;"
                                                class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>




                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Grade</th>
                                    <th>numero CIN</th>
                                    <th>Adresse e-mail</th>
                                    <th>action</th>
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

