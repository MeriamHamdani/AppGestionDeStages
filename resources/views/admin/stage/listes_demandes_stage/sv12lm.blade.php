@extends('layouts.admin.master')

@section('title')Liste des demandes des stages volontaire pour 1ére et 2éme licence et 1ère mastère
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>La liste des demandes des stages volontaire pour 1ére année et 2éme année licence et 1ère année mastère</h3>
@endslot
<li class="breadcrumb-item">Stages</li>
<li class="breadcrumb-item">Les demandes des stages</li>
<li class="breadcrumb-item">Stage volontaire 1ère et 2éme licence et 1ère mastère</li>

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Les demandes</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Classe</th>
                                    <th>Encadrant</th>
                                    <th>La fiche de demande</th>
                                    <th>Confirmation de l'encadrant</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ben Foulen</td>
                                    <td>Foulen</td>
                                    <td>LF1I</td>
                                    <td>Ali Ben Ali</td>
                                    <td class="text-center"><a href="demande_stage.pdf" download="demande_stage.pdf">
                                            <i style="font-size: 2em;" class="icofont icofont-file-pdf"></i>
                                        </a>
                                    </td>

                                    <td style="text-center">

                                        <i data-toggle="tooltip" title="demande confirmée" style="background-position: 0 -90px;
                                            height: 30px;
                                            width: 23px;
                                            display:block;
                                            margin:0 auto; color: #4B8D5F" class="icofont icofont-ui-check"></i>

                                    </td>
                                    <td class="text-center">
                                        <a href="#"> <i data-toggle="tooltip" title="Confirmer"
                                                class="icofont icofont-ui-check"></i></a>
                                        <a href="#"><i data-toggle="tooltip" title="Refuser"
                                                class="icofont icofont-ui-close"></i></a>
                                        <a href="{{ route('demandes_stage.modifier_demande') }}" data-title="Modifer"
                                            data-toggle="tooltip" title="Modifer"><i
                                                class="icofont icofont-ui-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ben Foulen</td>
                                    <td>Foulen</td>
                                    <td>LF1I</td>
                                    <td>Ali Ben Ali</td>
                                    <td class="text-center"><a href="demande_stage.pdf" download="demande_stage.pdf">
                                            <i style="font-size: 2em; " class="icofont icofont-file-pdf"></i>
                                        </a>
                                    </td>
                                    <td style="text-center">

                                        <i data-toggle="tooltip" title="demande confirmée" style="background-position: 0 -90px;
                                            height: 30px;
                                            width: 23px;
                                            display:block;
                                            margin:0 auto; color: #B3363E;" class="icofont icofont-ui-close"></i>

                                    </td>

                                    <td class="text-center">
                                        <a href="#"> <i data-toggle="tooltip" title="Confirmer"
                                                class="icofont icofont-ui-check"></i></a>
                                        <a href="#"><i data-toggle="tooltip" title="Refuser"
                                                class="icofont icofont-ui-close"></i></a>
                                        <a href="{{ route('demandes_stage.modifier_demande') }}" data-title="Modifer"
                                            data-toggle="tooltip" title="Modifer"><i
                                                class="icofont icofont-ui-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ben Foulen</td>
                                    <td>Foulen</td>
                                    <td>LF1I</td>
                                    <td>Ali Ben Ali</td>
                                    <td class="text-center"><a href="demande_stage.pdf" download="demande_stage.pdf">
                                            <i style="font-size: 2em;" class="icofont icofont-file-pdf"></i>
                                        </a>
                                    </td>


                                    <td class="text-center">

                                        <i data-toggle="tooltip" title="demande confirmée" style="background-position: 0 -90px;
                                        height: 30px;
                                        width: 23px;
                                        display:block;
                                        margin:0 auto; color: #4B8D5F" class="icofont icofont-ui-check"></i>

                                    </td>


                                    <td class="text-center">


                                        <a href="#"> <i data-toggle="tooltip" title="Confirmer"
                                                class="icofont icofont-ui-check"></i></a>
                                        <a href="#"><i data-toggle="tooltip" title="Refuser"
                                                class="icofont icofont-ui-close"></i></a>
                                        <a href="{{ route('demandes_stage.modifier_demande') }}" data-title="Modifer"
                                            data-toggle="tooltip" title="Modifer"><i
                                                class="icofont icofont-ui-edit"></i></a>

                                    </td>
                                </tr>




                            </tbody>
                            <tfoot>

                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Classe</th>
                                    <th>Encadrant</th>
                                    <th>La fiche de demande</th>
                                    <th>Confirmation de l'encadrant</th>
                                    <th>Action</th>

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

