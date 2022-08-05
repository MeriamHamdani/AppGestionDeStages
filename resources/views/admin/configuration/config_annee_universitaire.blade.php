@extends('layouts.admin.master')

@section('title')Ajouter Année Universitaire
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter une année universitaire</h3>
        @endslot
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item">Ajouter une année universitaire</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ajouter une année universitaire</h5>
                    </div>
                    <form class="form theme-form" method="POST" action="{{ route('ajouter_annee_universitaire') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Année Universitaire
                                        </label>
                                        <input class="form-control" id="annee" name="annee" type="text" required
                                               placeholder="2021-2022"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Modèle de lettre
                                            d'affectation
                                        </label>
                                        <input class="form-control" id="lettre_affectation" name="lettre_affectation"
                                               type="file"  accept=".docx"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Modèle de fiche
                                            d'encadrement
                                        </label>
                                        <input class="form-control" id="fiche_encadrement" name="fiche_encadrement"
                                               type="file" accept=".docx" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Modèle d'attrayant
                                        </label>
                                        <input class="form-control" id="attrayant" name="attrayant" type="file"
                                               accept=".docx" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Modèle de grille d'évaluation licence
                                        </label>
                                        <input class="form-control" id="grille_evaluation_licence" name="grille_evaluation_licence" type="file"
                                               accept=".docx" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Modèle de grille d'évaluation licence informatique
                                        </label>
                                        <input class="form-control" id="grille_evaluation_info" name="grille_evaluation_info" type="file"
                                               accept=".docx" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Modèle de grille d'évaluation mastère
                                        </label>
                                        <input class="form-control" id="grille_evaluation_master" name="grille_evaluation_master" type="file"
                                               accept=".docx" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Modèle de PV individuel
                                        </label>
                                        <input class="form-control" id="pv_individuel" name="pv_individuel" type="file"
                                               accept=".docx"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Modèle de PV global
                                        </label>
                                        <input class="form-control" id="pv_global" name="pv_global" type="file"
                                               accept=".docx" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-end">
                            {{-- <a href class="btn btn-light" type="reset" value="Annuler" />--}}
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
                integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @if(Session::has('message'))
            <script>
                toastr.success("{!! Session::get('message') !!}")
            </script>
        @endif
        @if(Session::has('message'))
            @if (Session::get('message')=='error')

                <script>
                    swal('Oups', 'L\'année que vous vouloir ajouter n\'est pas l\'année courante', 'error', {
                        button: 'Continuer'
                    })

                </script>
            @endif
            @if (Session::get('message')=='error exist')

                <script>
                    swal('Oups', 'L\'année existe déjà', 'error', {
                        button: 'Continuer'
                    })

                </script>
            @endif
        @endif
    @endpush

@endsection

