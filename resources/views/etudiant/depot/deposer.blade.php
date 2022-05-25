@extends('layouts.etudiant.master')

@section('title')Dépôser mon mémoire
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Dépôser mon mémoire</h3>
@endslot
<li class="breadcrumb-item">Dépôt</li>
<li class="breadcrumb-item active">Dépôt du mémoire</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Dépôser mon mémoire</h5>
                    <span>Le dépôt du mémoire se fait juste avant la soutanance d'une période bien déterminé et dés que
                        vous serez autorisé vous pouvez déposer votre mémoire</span>
                </div>
                <div class="card-body">
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step"><a class="btn btn-primary" href="#step-1">1</a>
                                <p>Titre sujet</p>
                            </div>
                            <div class="stepwizard-step"><a class="btn btn-light" href="#step-2">2</a>
                                <p>Fichiers nécessaires 1</p>
                            </div>
                            <div class="stepwizard-step"><a class="btn btn-light" href="#step-3">3</a>
                                <p>Mémoire</p>
                            </div>
                            @if($stage->type_sujet == "PFE")
                            <div class="stepwizard-step"><a class="btn btn-light" href="#step-4">4</a>
                                <p>Fichiers nécessaires 2</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <form action="{{route('deposer_memoire',['stage_id'=>$stage->id])}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @if($errors->any())
                            @foreach ($errors->all() as $err )
                                <div class="alert alert-danger" role="alert">
                                    {{ $err }}
                                </div>
                            @endforeach
                        @endif
                        <div class="setup-content" id="step-1">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Titre de sujet</label>
                                        <input class="form-control" type="text" disabled value="{{$stage->titre_sujet}}">
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right" type="button">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="setup-content" id="step-2">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Fiche de bibliothèque</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" name="fiche_biblio"
                                                               id="fiche_biblio"
                                                               required="required"/>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Fiche plagiat</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" name="fiche_plagiat"
                                                               id="fiche_plagiat"
                                                               required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right" type="button">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="setup-content" id="step-3">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Le mémoire</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" name="memoire" id="memoire" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($stage->type_sujet == "Projet Tutoré" || $stage->type_sujet == "Business Plan" || $etudiant->classe->cycle =="master")
                                        <button class="btn btn-secondary pull-right"
                                                type="submit">Términer!
                                        </button>
                                    @else
                                        <button class="btn btn-primary nextBtn pull-right"
                                                type="button">Suivant
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($stage->type_sujet == "PFE")
                        <div class="setup-content" id="step-4">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Attestation</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" name="attestation" id="attestation"/>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Fiche technique</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" name="fiche_tech" id="fiche_tech" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="stage_id" value="{{$stage_id}}">
                                    <button class="btn btn-secondary pull-right" type="submit">Terminer!</button>
                                </div>
                            </div>
                        </div>
                            @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script src="{{asset('assets/js/form-wizard/form-wizard-two.js')}}"></script>
@endpush

@endsection

