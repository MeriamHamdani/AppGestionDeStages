@extends('layouts.enseignant.master')

@section('title')La soutenance
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>La soutenance</h3>
@endslot
<li class="breadcrumb-item">Soutenance</li>
<li class="breadcrumb-item active">Détails</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Informations sur la soutenacne</h5>
                </div>
                <div class="card-body">
                    <div class="default-according style-1" id="accordionoc">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-white" data-bs-toggle="collapse"
                                        data-bs-target="#collapseicon" aria-expanded="true" aria-controls="collapse11">
                                        <i class="icofont icofont-graduate-alt"></i> Informations générales sur
                                        l'étudiant
                                    </button>
                                </h5>
                            </div>
                            <div class="collapse show" id="collapseicon" aria-labelledby="collapseicon"
                                data-bs-parent="#accordionoc">
                                <div class="card-body">
                                    <ul>
                                        <li>
                                            Nom : <strong>{{ucwords( $etudiant->nom) }}</strong>
                                        </li>
                                        <li>
                                            Prénom : <strong>{{ ucwords($etudiant->prenom) }}</strong>
                                        </li>
                                        <li>
                                            classe: <strong>{{ App\Models\Classe::find($etudiant->classe_id)->nom
                                                }}</strong>
                                        </li>
                                        <li>
                                            Titre de sujet : <strong>{{ $stage->titre_sujet }}</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse"
                                        data-bs-target="#collapseicon1" aria-expanded="false">
                                        <i class="icofont icofont-support"></i>Membres de jury
                                    </button>
                                </h5>
                            </div>
                            <div class="collapse" id="collapseicon1" aria-labelledby="headingeight"
                                data-bs-parent="#accordionoc">
                                <div class="card-body">
                                    <ul>

                                        @if((App\Models\Enseignant::where('user_id',Auth::user()->id)->get()[0])->id!=$stage->enseignant_id)
                                        <li>
                                            Encadrant : <strong>{{
                                                ucwords(App\Models\Enseignant::find($stage->enseignant_id)->nom)
                                                }}&nbsp;{{
                                                ucwords(App\Models\Enseignant::find($stage->enseignant_id)->prenom)
                                                }}</strong>
                                        </li>
                                        @endif
                                        <li>
                                            Président : <strong>{{
                                                ucwords(App\Models\Enseignant::find($soutenance->president_id)->nom)}}&nbsp;{{
                                                ucwords(App\Models\Enseignant::find($soutenance->president_id)->prenom)
                                                }}</strong>
                                        </li>
                                        <li>
                                            Rapporteur : <strong>{{
                                                ucwords(App\Models\Enseignant::find($soutenance->rapporteur_id)->nom)
                                                }}&nbsp;{{
                                                ucwords(App\Models\Enseignant::find($soutenance->rapporteur_id)->prenom)
                                                }}</strong>
                                        </li>
                                        <li>
                                            Membra de jury : <strong>{{
                                                ucwords(App\Models\Enseignant::find($soutenance->deuxieme_membre_id)->nom)
                                                }}&nbsp;{{
                                                ucwords(App\Models\Enseignant::find($soutenance->deuxieme_membre_id)->prenom)
                                                }}</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse"
                                        data-bs-target="#collapseicon2" aria-expanded="false"
                                        aria-controls="collapseicon2">
                                        <i class="icofont icofont-tasks-alt"></i> Date et Lieu
                                    </button>
                                </h5>
                            </div>
                            <div class="collapse" id="collapseicon2" data-bs-parent="#accordionoc">
                                <div class="card-body">
                                    <ul>
                                        <li>
                                            @php

                                            $date=strtotime($soutenance->date);
                                            $date = date("d-m-Y", $date);
                                            @endphp
                                            Date : <strong>{{ $date }}</strong>
                                        </li>
                                        <li>
                                            Heure : <strong>{{ $soutenance->start_time }}</strong>
                                        </li>
                                        <li>
                                            Salle : <strong> {{ $soutenance->salle }}</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--------------------------------------------------------------------------->
                        @if((App\Models\Enseignant::where('user_id',Auth::user()->id)->get()[0])->id==$soutenance->rapporteur_id)
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse"
                                        data-bs-target="#collapseicon2" aria-expanded="false"
                                        aria-controls="collapseicon2">
                                        <i class="icofont icofont-book-alt"></i> La mémoire
                                    </button>
                                </h5>
                            </div>
                            <div class="collapse" id="collapseicon2" data-bs-parent="#accordionoc">
                                <div class="card-body text-center">

                                    <a href={{ route('telecharger_memoire',[$soutenance->stage_id])
                                        }} data-title="Télécharger la grille d'évaluation"
                                        data-toggle="tooltip"
                                        data-original-title="Télécharger la mémoire"
                                        title="Télécharger la mémoire">
                                        <i class="icofont icofont-book-alt icon-large" style="color:#bf9168; font-size: 30px; text-align: center;
                                                    width: 6em"></i></a>


                                </div>
                            </div>
                        </div>

                        @endif
                        <!--------------------------------------------------------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
@endpush

@endsection

