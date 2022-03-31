@extends('layouts.admin.master')

@section('title')Gérer les paiements de chaque enseignant
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
            <h3>Gérer les paiements de chaque enseignant</h3>
        @endslot
        <li class="breadcrumb-item">Paiement</li>
        <li class="breadcrumb-item">Détails des paiements de l'enseignant</li>

    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Détails de paiement de chaque enseignant</h5>
                        <div style="padding-left: 800px">
                            <a href=#>
                                <i class="text-right" aria-hidden="true">
                                    <button class="btn btn-primary" type="button"
                                            data-bs-toggle="modal" data-bs-target="#import"
                                            data-whatever="@getbootstrap">
                                        Attrayant
                                    </button>
                                    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Attrayant des stages par enseignant</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label" for="message-text">Enseignant </label>
                                                                        <select class="js-example-basic-single col-md-5-sm-12">
                                                                            <option value="0">Sélectionnez l'enseignant</option>
                                                                            <option value="5">enseignant 1</option>
                                                                            <option value="1">enseignant 2</option>
                                                                            <option value="2">enseignant 3</option>
                                                                            <option value="3">enseignant 4</option>
                                                                            <option value="4">enseignant 5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label" for="message-text">Identifiant </label>
                                                                        <input class="form-control" id="exampleFormControlInput1" type="text"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label" for="message-text">CIN</label>
                                                                        <input class="form-control" id="exampleFormControlInput1" type="number"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label" for="message-text">RIB </label>
                                                                        <input class="form-control" id="exampleFormControlInput1" type="number"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label" for="message-text">Numéro de Téléphone</label>
                                                                        <input class="form-control" id="exampleFormControlInput1" type="number"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label" for="message-text">Établissement de nomination</label>
                                                                        <input class="form-control" id="exampleFormControlInput1" type="text"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Annuler</button>
                                                    <button class="btn btn-primary" type="button">Télécharger</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate="">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Sélectionnez l'enseignant que vous voulez consulter ses détails de paiement </label>
                                <select class="js-example-basic-single col-md-5-sm-12">
                                    <option value="0">Sélectionnez l'enseignant</option>
                                    <option value="5">enseignant 1</option>
                                    <option value="1">enseignant 2</option>
                                    <option value="2">enseignant 3</option>
                                    <option value="3">enseignant 4</option>
                                    <option value="4">enseignant 5</option>
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Voir Détails</button>

                        </form>
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
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.col-md-5Vis.min.js')}}"></script>
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
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.col-md-5Reorder.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/custom.js')}}"></script>
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    @endpush
@endsection




