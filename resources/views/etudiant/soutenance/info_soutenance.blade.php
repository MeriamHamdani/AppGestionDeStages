@extends('layouts.etudiant.master')

@section('title')Ma soutenance
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Ma soutenance</h3>
@endslot
<li class="breadcrumb-item">Soutenance</li>
<li class="breadcrumb-item active">Détails</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Informations sur ma soutenacne</h5>
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
                                            Nom : <strong>Hamdani</strong>
                                        </li>
                                        <li>
                                            Prénom : <strong>Meriam</strong>
                                        </li>
                                        <li>
                                            classe: <strong>3eme genie info</strong>
                                        </li>
                                        <li>
                                            Titre de sujet : <strong>dev app stage</strong>
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
                                            Président : <strong>Slim Kenoun</strong>
                                        </li>
                                        <li>
                                            Rapporteur : <strong>Slim Kenoun</strong>
                                        </li>
                                        <li>
                                            Encadrant: <strong>Slim Kenoun</strong>
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
                                            Date : <strong>30 juin 2022</strong>
                                        </li>
                                        <li>
                                            Heure : <strong>09:00 am</strong>
                                        </li>
                                        <li>
                                            Lieu :<strong> Amphi 6</strong>
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

