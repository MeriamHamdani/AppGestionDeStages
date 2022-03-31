@extends('layouts.admin.master')

@section('title')Gérer les paiements
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Gérer les paiements</h3>
        @endslot
        <li class="breadcrumb-item">Paiement</li>
        <li class="breadcrumb-item">Gérer les paiements des enseignants</li>

    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Tableau des paimenets des enseignants</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="auto-fill">
                                <thead>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>Sujet</th>
                                    <th>Formation</th>
                                    <th>Grade</th>
                                    <th>Charge</th>
                                    <th>Etat</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Alex cou</td>
                                    <td>Dev mobile</td>
                                    <td>licence</td>
                                    <td>Maitre</td>
                                    <td>200</td>
                                    <td>Non Payé</td>
                                    <td>
                                        <a href="#" data-title="Payer l'enseignant" data-toggle="tooltip"
                                           title="Payer l'enseignant">
                                            <i class="icofont icofont-checked"></i></a>
                                        <a href="#" data-title="Ne Payer Pas l'enseignant" data-toggle="tooltip"
                                           title="Ne Payer Pas l'enseignant">
                                            <i class="icofont icofont-close-squared"></i></a>

                                        <a href="#" data-title="supprimer" data-toggle="tooltip"
                                           data-original-title="exonore" title="exonore">
                                            <i class="icofont icofont-ui-block"></i></a>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Foulen Ben Foulen</td>
                                    <td>Dev web</td>
                                    <td>Ingenieurie</td>
                                    <td>Maitre assistant</td>
                                    <td>1500</td>
                                    <td>Payé</td>
                                    <td>
                                        <a href="#" data-title="Payer l'enseignant" data-toggle="tooltip"
                                           title="Payer l'enseignant">
                                            <i class="icofont icofont-checked"></i></a>
                                        <a href="#" data-title="Ne Payer Pas l'enseignant" data-toggle="tooltip"
                                           title="Ne Payer Pas l'enseignant">
                                            <i class="icofont icofont-close-squared"></i></a>

                                        <a href="#" data-title="supprimer" data-toggle="tooltip"
                                           data-original-title="exonore" title="exonore">
                                            <i class="icofont icofont-ui-block"></i></a>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Foulen Ben Foulen</td>
                                    <td>Dev web</td>
                                    <td>Ingenieurie</td>
                                    <td>Maitre assistant</td>
                                    <td>1500</td>
                                    <td>Payé</td>
                                    <td>
                                        <a href="#" data-title="Payer l'enseignant" data-toggle="tooltip"
                                           title="Payer l'enseignant">
                                            <i class="icofont icofont-checked"></i></a>
                                        <a href="#" data-title="Ne Payer Pas l'enseignant" data-toggle="tooltip"
                                           title="Ne Payer Pas l'enseignant">
                                            <i class="icofont icofont-close-squared"></i></a>

                                        <a href="#" data-title="supprimer" data-toggle="tooltip"
                                           data-original-title="exonore" title="exonore">
                                            <i class="icofont icofont-ui-block"></i></a>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Foulen Ben Foulen</td>
                                    <td>Dev web</td>
                                    <td>Ingenieurie</td>
                                    <td>Maitre assistant</td>
                                    <td>1500</td>
                                    <td>Payé</td>
                                    <td>
                                        <a href="#" data-title="Payer l'enseignant" data-toggle="tooltip"
                                           title="Payer l'enseignant">
                                            <i class="icofont icofont-checked"></i></a>
                                        <a href="#" data-title="Ne Payer Pas l'enseignant" data-toggle="tooltip"
                                           title="Ne Payer Pas l'enseignant">
                                            <i class="icofont icofont-close-squared"></i></a>

                                        <a href="#" data-title="supprimer" data-toggle="tooltip"
                                           data-original-title="exonore" title="exonore">
                                            <i class="icofont icofont-ui-block"></i></a>

                                    </td>
                                </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>Sujet</th>
                                    <th>Formation</th>
                                    <th>Grade</th>
                                    <th>Charge</th>
                                    <th>Etat</th>
                                    <th>Actions</th>
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

