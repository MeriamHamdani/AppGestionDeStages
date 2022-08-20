@extends('layouts.enseignant.master')

@section('title')Soutenance
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Soutenance</h3>
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
                                        <i class="icofont icofont-graduate-alt"></i> Informations générales
                                    </button>
                                </h5>
                            </div>
                            <div class="collapse show" id="collapseicon" aria-labelledby="collapseicon"
                                data-bs-parent="#accordionoc">
                                <div class="card-body">
                                    <ul>
                                        <li>
                                            Nom : <strong>{{ucwords($soutenance->stage->etudiant->nom)}}</strong>
                                        </li>
                                        <li>
                                            Prénom : <strong>{{ucwords($soutenance->stage->etudiant->prenom)}}</strong>
                                        </li>
                                        <li>
                                            Classe:
                                            <strong>{{ucwords($soutenance->stage->etudiant->classe->nom)}}</strong>
                                        </li>
                                        <li>
                                            Titre de sujet :
                                            <strong>{{ucwords($soutenance->stage->titre_sujet)}}</strong>
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
                                        <li>
                                            Président : <strong>{{ucwords($soutenance->president->nom)}}
                                                {{ucwords($soutenance->president->prenom)}} </strong>
                                        </li>
                                        <li>
                                            Rapporteur : <strong>{{ucwords($soutenance->rapporteur->nom)}}
                                                {{ucwords($soutenance->rapporteur->prenom)}}</strong>
                                        </li>
                                        <li>
                                            Encadrant: <strong>{{ucwords($soutenance->stage->enseignant->nom)}}
                                                {{ucwords($soutenance->stage->enseignant->prenom)}}</strong>
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
                                        <i class="icofont icofont-tasks-alt"></i> Date et Salle
                                    </button>
                                </h5>
                            </div>
                            <div class="collapse" id="collapseicon2" data-bs-parent="#accordionoc">
                                <div class="card-body">
                                    <ul>
                                        @php
                                        $date= date('d-m-Y', strtotime($date));
                                        @endphp
                                        <li>
                                            Date : <strong>{{$date}}</strong>
                                        </li>
                                        <li>
                                            Heure : <strong>{{$soutenance->start_time}}</strong>
                                        </li>
                                        <li>
                                            Salle :<strong> {{$soutenance->salle}}</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
@endpush

@endsection
