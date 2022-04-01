@extends('layouts.admin.master')

@section('title')Ajouter classe
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter une classe</h3>
        @endslot
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Ajouter une classe</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ajouter une classe</h5>
                    </div>
                    <form class="form theme-form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Code classe  </label>
                                        <input class="form-control" id="message-text" type="text"
                                               placeholder="entrez le code de la classe..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Nom classe </label>
                                        <input class="form-control" id="message-text" type="text"
                                               placeholder="entrez le nom de la classe..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Spécialité</label>
                                        <select class="js-example-basic-single col-sm-12">
                                            <option value="0'">Séléctionnez la spécialité</option>
                                            <option value="1">Info</option>
                                            <option value="2">Comptabilité</option>
                                            <option value="3">Finance</option>
                                            <option value="4">Eco</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-light" type="reset" value="Annuler"/>
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Configurer le stage selon la classe</h5>
                        <div style="padding-left: 800px">
                            <a href=#>
                                <i class="text-right" aria-hidden="true">
                                    <button class="btn btn-primary" type="button"
                                            data-bs-toggle="modal" data-bs-target="#import"
                                            data-whatever="@getbootstrap">
                                        Configurer une classe
                                    </button>
                                    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Configurations d'une classe</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="message-text">Classe</label>
                                                                        <select class="js-example-basic-single col-sm-12">
                                                                            <option value="0'">Séléction de classe</option>
                                                                            <option value="00">3eme comptabilite</option>
                                                                            <option value="0">3eme licence info</option>
                                                                            <option value="1">2eme mastère</option>
                                                                            <option value="2">3eme finance</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="message-text">Année universitaire</label>
                                                                        <select class="js-example-basic-single col-sm-12">
                                                                            <option value="0'">Séléction d'année</option>
                                                                            <option value="0">2022-2021</option>
                                                                            <option value="1">2021-2020</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="message-text">Type de stage </label>
                                                                        <select class="js-example-basic-single col-sm-12">
                                                                            <option value="0'">Séléction type de stage</option>
                                                                            <option value="0">2eme master blig</option>
                                                                            <option value="1">1ere licence volontaire</option>
                                                                            <option value="2">3eme licence info</option>
                                                                            <option value="3">2eme info oblig</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="message-text">Type de sujet</label>
                                                                        <select class="js-example-basic-single col-sm-12">
                                                                            <option value="0'">Séléction type de sujet</option>
                                                                            <option value="00">Aucun</option>
                                                                            <option value="0">PFE</option>
                                                                            <option value="1">BP</option>
                                                                            <option value="2">PT</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="message-text">Modèle fiche de demande</label>
                                                                                <input class="form-control" type="file" />
                                                                        </div>
                                                                    </div>
                                                                <div class="col">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="message-text">Liste des fichiers</label>
                                                                            <select class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                                                <option value="0">Attestation</option>
                                                                                <option value="1">Fiche réponse</option>
                                                                                <option value="2">Fiche plagiat</option>
                                                                                <option value="2">Fiche biblio</option>
                                                                                <option value="3">Mémoire</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Annuler</button>
                                                    <button class="btn btn-primary" type="button">Ajouter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="dt-ext table-responsive">
                                <table class="display" id="auto-fill">
                                    <thead>
                                    <tr>
                                        <th>Nom classe</th>
                                        <th>Spécialité</th>
                                        <th>Type de stage</th>
                                        <th>Année universitaire</th>
                                        <th>Modèle fiche de demande</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    </tr>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Nom classe</th>
                                        <th>Spécialité</th>
                                        <th>Type de stage</th>
                                        <th>Année universitaire</th>
                                        <th>Modèle fiche de demande</th>
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
    </div>


    @push('scripts')
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
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

