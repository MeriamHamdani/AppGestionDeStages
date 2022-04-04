@extends('layouts.etudiant.master')

@section('title')Liste des stage
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>La liste des stages confirmés</h3>
@endslot
<li class="breadcrumb-item">Stage</li>
<li class="breadcrumb-item">La liste des stages confirmés</li>
<!--<li class="breadcrumb-item active">Auto fill</li>-->
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Mes Stages</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Année universitaire</th>
                                    <th>Entreprise</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Etat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Volontaire LF1I</td>
                                    <td>2019-2020</td>
                                    <td>Hyper-groupe</td>
                                    <td>01-07-2020</td>
                                    <td>30-07-2020</td>
                                    <td><button class="btn btn-primary btn-sm" data-toggle="tooltip" title="Stage terminée">
                                            <i class="icofont icofont-ui-check"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Obligatoire LF3I</td>
                                    <td>2020-2021</td>
                                    <td>Hyper-groupe</td>
                                    <td>01-07-2021</td>
                                    <td>31-08-2021</td>
                                    <td><button class="btn btn-secondary" data-toggle="tooltip" title="Stage en cours">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Obligatoire LF2I</td>
                                    <td>2021-2022</td>
                                    <td>Hyper-groupe</td>
                                    <td>01-02-2022</td>
                                    <td>31-05-2022</td>
                                    <td><button class="btn btn-secondary" data-toggle="tooltip" title="Stage en cours">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Type</th>
                                    <th>Année universitaire</th>
                                    <th>Entreprise</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Etat</th>
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
<script src="{{ asset('assets/js/tooltip-init.js')}}"></script>
@endpush

@endsection
