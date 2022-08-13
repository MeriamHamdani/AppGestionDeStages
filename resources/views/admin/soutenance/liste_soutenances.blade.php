@extends('layouts.admin.master')

@section('title')Liste des soutenances
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>La liste des soutenances</h3>
        @endslot
        <li class="breadcrumb-item">Soutenance</li>
        <li class="breadcrumb-item">La liste des soutenances</li>

    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Les soutenances</h5>
                    </div>
                    <div style="padding-bottom: 16px; padding-right: 30px;">
                        <!--------------------------------------------------------------------------------->
                        <a href="#">
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success pull-right" type="button"
                                        style="margin-right: 0.5cm" data-bs-toggle="modal" data-bs-target="#pv"
                                        data-whatever="@getbootstrap">
                                    Télécharger le PV de soutenance
                                </button>
                                <div class="modal fade" id="pv" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Télécharger le PV de soutenance</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Fermez"></button>
                                            </div>
                                            <form method="POST" action="{{ route('telecharger_pv_stnc') }}">
                                                @csrf
                                                @if($errors->any())
                                                    @foreach ($errors->all() as $err )
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ $err }}
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="col-form-label" for="recipient-name">Selon la
                                                            Classe-Spécialité</label>
                                                        <div class="mb-2">
                                                            <select class="js-example-basic-single col-sm-12"
                                                                    id="classe_id" name="classe_id" required>
                                                                @foreach($classes as $classe)
                                                                    <option value="{{ $classe->id }}" {{
                                                                old('classe_id')==$classe->id ? 'selected' :
                                                                '' }}
                                                                    >{{ ucwords($classe->nom) }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">

                                                    <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Annuler
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"
                                                            type="button">Télécharger
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </i>
                        </a>

                        <a href={{ route('planifier_soutenance') }}>
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success pull-right" type="button"
                                        style="margin-right: 0.5cm" href={{ route('planifier_soutenance') }}>
                                    Planifier une soutenance
                                </button>
                            </i>
                        </a>

                        <a href="#">
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success pull-right" type="button"
                                        style="margin-right: 0.5cm" data-bs-toggle="modal" data-bs-target="#liste_stnc"
                                        data-whatever="@getbootstrap">
                                    Télécharger la liste de soutenances
                                </button>
                                <div class="modal fade" id="liste_stnc" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Télécharger la liste de soutenances</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Fermez"></button>
                                            </div>
                                            <form method="POST" action="{{ route('telecharger_liste_stnc') }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="col-form-label" for="recipient-name">Selon la
                                                            Classe-Spécialité</label>
                                                        <div class="mb-2">
                                                            <select class="js-example-basic-single col-sm-12"
                                                                    id="classe_id" name="classe_id" required>
                                                                @foreach($classes as $classe)
                                                                    <option value="{{ $classe->id }}" {{
                                                                old('classe_id')==$classe->id ? 'selected' :
                                                                '' }}
                                                                    >{{ ucwords($classe->nom) }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Annuler
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"
                                                            type="button">Télécharger
                                                    </button>

                                                </div>
                                            </form>
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
                                    <th>Nom et prénom de l'etudiant</th>
                                    <th>Classe</th>
                                    <th>Sujet</th>
                                    <th>Jury</th>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th>Salle</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($soutenances as $soutenance )
                                    <tr>
                                        @php
                                            $stage=App\Models\Stage::find($soutenance->stage_id);
                                            $etudiant=App\Models\Etudiant::find($stage->etudiant_id);
                                            $classe=App\Models\Classe::find($etudiant->classe_id);
                                        @endphp
                                        <td>{{ ucwords($etudiant->nom) }}&nbsp;{{ ucwords($etudiant->prenom) }}</td>
                                        <td>{{ $classe->code }}</td>
                                        <td>{{ $stage->titre_sujet }}</td>
                                        <td>
                                            <strong>Encadrant: </strong> {{ucwords($stage->enseignant->nom) }} {{ucwords($stage->enseignant->prenom) }}
                                            <strong>Président: </strong> {{ucwords($soutenance->president->nom) }} {{ucwords($soutenance->president->prenom) }}
                                            <strong>Rapporteur: </strong> {{ucwords($soutenance->rapporteur->nom) }} {{ucwords($soutenance->rapporteur->prenom) }}
                                        </td>
                                        <td style="font-size:8.5px">{{Arr::first((App\Http\Controllers\TypeStageController::decouper_nom($soutenance->date))) }}</td>

                                        <td>{{ $soutenance->start_time }}</td>
                                        <td>{{ $soutenance->salle }}</td>
                                        <td class="text-center">
                                            <a href="{{route('telecharger_pv_indiv',$soutenance)}}"
                                               data-title="télécharger le pv de la soutenance"
                                               title="Télécharger le pv de la soutenance"
                                               data-toggle="tooltip"> <i
                                                    class="icofont icofont-file-text icon-large"></i></a>
                                            @if($soutenance->stage->etudiant->classe->cycle == "licence" && !(App\Http\Controllers\SoutenanceController::isInfo($soutenance->stage->etudiant->classe)) )
                                                <a href="{{route('telecharger_grille_lic_non_info',$soutenance)}}"
                                                   data-title="télécharger la fiche d'évaluation de la soutenance"
                                                   title="Télécharger la grille d'évaluation de la soutenance"
                                                   data-toggle="tooltip"> <i
                                                        class="icofont icofont-file-word icon-large"></i></a>
                                            @elseif($soutenance->stage->etudiant->classe->cycle == "licence" && (App\Http\Controllers\SoutenanceController::isInfo($soutenance->stage->etudiant->classe)))
                                                <a href="{{route('telecharger_grille_lic_info',$soutenance)}}"
                                                   data-title="télécharger la fiche d'évaluation de la soutenance"
                                                   title="Télécharger la grille d'évaluation de la soutenance"
                                                   data-toggle="tooltip"> <i
                                                        class="icofont icofont-file-word icon-large"></i></a>
                                            @elseif($soutenance->stage->etudiant->classe->cycle == "master")
                                                <a href="{{route('telecharger_grille_mastere',$soutenance)}}"
                                                   data-title="télécharger la fiche d'évaluation de la soutenance"
                                                   title="Télécharger la grille d'évaluation de la soutenance"
                                                   data-toggle="tooltip"> <i
                                                        class="icofont icofont-file-word icon-large"></i></a>
                                            @endif
                                            @if($soutenance->stage->validation_admin == null)
                                                <a href="{{ route('evaluer_soutenance',$soutenance) }}"
                                                   data-title="évaluer la soutenance" title="Valider la soutenance"
                                                   data-toggle="tooltip"> <i
                                                        class="icofont icofont-tick-mark icon-large"></i></a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                <tr>
                                    <th>Nom et prénom de l'etudiant</th>
                                    <th>Classe</th>
                                    <th>Sujet</th>
                                    <th>Jury</th>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th>Salle</th>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
                integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        @if (Session::get('message')=='valid_stnc')
            <script>
                swal('Bien', "Le stage est bien validé", 'success', {
                    //button: 'Continuer'
                    showConfirmButton: false,
                    timer: 2500
                })

            </script>
        @endif
    @endpush

@endsection
