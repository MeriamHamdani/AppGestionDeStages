@extends('layouts.admin.master')

@section('title')Dépôt
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/buttonload.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Dépôt</h3>
@endslot
<li class="breadcrumb-item">Dépôt</li>
<li class="breadcrumb-item">Gérer les dépôts</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Listes des demandes de dépôt</h5>
                </div>
                <a href="#">
                    <i class="text-right" aria-hidden="true">
                        <button class="btn btn-pill btn-success pull-right" type="button"
                                style="margin-right: 0.5cm" data-bs-toggle="modal" data-bs-target="#liste_stnc"
                                data-whatever="@getbootstrap">
                           Exporter la liste des mémoires déposés
                        </button>
                        <div class="modal fade" id="liste_stnc" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> Exporter la liste des mémoires déposés</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Fermez"></button>
                                    </div>
                                    <form method="POST" action="{{ route('exporter_liste_depots') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="recipient-name">Selon la
                                                    Classe-Spécialité</label>
                                                <div class="mb-2">
                                                        <select class="js-example-basic-single col-sm-12"
                                                                id="classe_id" name="classe_id" required>
                                                            <option value="tous" selected="selected">
                                                                Exportez tous
                                                            </option>
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
                                                    data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary"
                                                    type="button">Télécharger</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </i>
                </a>
                <div class="card-body">
                    <div>
                        <table class="display" id="advance-1">
                            <thead>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Classe</th>
                                    <th>Déposé le</th>
                                    <th>Encadrant</th>
                                    <th>Confirmation de l'encadrant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($demandesDepotC as $demande)
                                <tr>
                                    <td>{{$demande->titre}}</td>
                                    <td>{{ucwords($demande->stage->etudiant->prenom)}} {{ucwords($demande->stage->etudiant->nom)}}</td>
                                    <td>{{$demande->stage->etudiant->classe->code}}</td>
                                    <td>{{$demande->date_depot}}</td>
                                    <td>{{ucwords($demande->stage->enseignant->prenom)}} {{ucwords($demande->stage->enseignant->nom)}}</td>
                                    @if($demande->validation_encadrant == -1)
                                    <td class="text-center">
                                        <button class="buttonload btn btn-warning btn-sm" data-toggle="tooltip" title="demande en attente">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </button>
                                    </td>
                                    @elseif($demande->validation_encadrant == 0)
                                        <td class="text-center">
                                            <button class="buttonload btn btn-danger btn-sm" data-toggle="tooltip" title="demande refusée en attente de mise à jour">
                                                <i class="icofont icofont-close-squared icon-large"></i>
                                            </button>
                                        </td>
                                    @elseif($demande->validation_encadrant == 1)
                                        <td class="text-center">
                                            <button class="buttonload btn btn-primary btn-sm" data-toggle="tooltip" title="demande validée">
                                                <i class="icofont icofont-checked icon-large"></i>
                                            </button>
                                        </td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{route('telecharger_memoire_adm',['memoire'=>$demande->memoire,
                                                                                'code_classe'=>$demande->stage->etudiant->classe->code])}}" data-toggle="tooltip"
                                            data-original-title="Télécharger le mémoire" title="Télécharger le mémoire">
                                            <i class="icofont icofont-papers icon-large" style="color: #8a6d3b"></i></a>
                                        <a href="{{route('telecharger_fiche_plagiat',['fiche_plagiat'=>$demande->fiche_plagiat,
                                                                                'code_classe'=>$demande->stage->etudiant->classe->code])}}" data-toggle="tooltip"
                                           data-original-title="Télécharger le fiche plagiat" title="Télécharger le fiche plagiat">
                                            <i class="icofont icofont-paper icon-large" style="color: #8a6d3b"></i></a>
                                        <a href="{{route('telecharger_fiche_biblio',['fiche_biblio'=>$demande->fiche_biblio,
                                                                                'code_classe'=>$demande->stage->etudiant->classe->code])}}" data-toggle="tooltip"
                                           data-original-title="Télécharger le fiche biblio" title="Télécharger le fiche biblio">
                                            <i class="icofont icofont-file-text icon-large" style="color: #8a6d3b"></i></a> <br>
                                        @if(isset($demande->attestation) && isset($demande->fiche_tech))
                                            <a href="{{route('telecharger_fiche_tech',['fiche_tech'=>$demande->fiche_tech,
                                                                                'code_classe'=>$demande->stage->etudiant->classe->code])}}" data-toggle="tooltip"
                                               data-original-title="Télécharger le fiche technique" title="Télécharger le fiche technique">
                                                <i class="icofont icofont-ui-copy icon-large" style="color: #8a6d3b"></i></a>
                                            <a href="{{route('telecharger_attestation',['attestation'=>$demande->attestation,
                                                                                'code_classe'=>$demande->stage->etudiant->classe->code])}}" data-toggle="tooltip"
                                               data-original-title="Télécharger l'attestation" title="Télécharger l'attestation">
                                                <i class="icofont icofont-ui-file icon-large" style="color: #8a6d3b"></i></a><br>
                                        @endif
                                        @if($demande->validation_admin !=1)
                                        <a href="{{route('valider_par_admin',['demande_depot'=>$demande])}}" data-title="Valider le dépôt du mémoire" data-toggle="tooltip"
                                            title="Valider le dépôt du mémoire">
                                            <i class="icofont icofont-checked icon-large"></i></a>

                                       <!-- <a href="#" data-title="Refuser le dépôt du mémoire" data-toggle="tooltip"
                                            title="Refuser le dépôt du mémoire" style="color: darkred">
                                            <i class="icofont icofont-close-squared icon-large"></i></a> -->
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Classe</th>
                                    <th>Déposé le</th>
                                    <th>Encadrant</th>
                                    <th>Confirmation de l'encadrant</th>
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
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(Session::has('message'))
    @if (Session::get('message')=='attend validation encadrant')

        <script>
            swal('Erreur', "Validation d'encadrant requise!", 'error', {
                button: 'Ok'
            })

        </script>
    @endif
@endif
@endpush

@endsection

