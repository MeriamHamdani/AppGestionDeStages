@extends('layouts.admin.master')

@section('title')Configuration de grille d'évaluation
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Configurer la grille</h3>
@endslot
<!--<li class="breadcrumb-item">Configuration</li>
<li class="breadcrumb-item">Ajouter une année universitaire</li>-->
@endcomponent

<div class="container-fluid">
    <div class="card">
        <div class="row" style="padding: 30px;">
            <div class="col-sm-12" style="margin: 0 auto;
        width: 400px; ">
                <!--<div class="card">-->
                <!--<div class="card-header pb-0">
                    <h5>Ajouter un block</h5>
                </div>-->


                <i class="text-right" aria-hidden="true">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#import"
                        data-whatever="@getbootstrap">
                        Ajouter un bloc dans la grille
                    </button>
                    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        style="display: none;" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Configurations d'un grille</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="message-text">Titre</label>
                                                        <input type="text">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="message-text">Barème</label>
                                                        <input type="text">
                                                        <!--<fieldset>
                                                            <div class="touchspin-vertical-tab">
                                                                <input class="touchspin-vertical" type="text"
                                                                    value="0" />
                                                            </div>
                                                        </fieldset>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="message-text">Sous-Titre</label>
                                                        <input type="text">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="message-text">Barème</label>
                                                        <input type="text">
                                                        <!--<fieldset>
                                                            <div class="touchspin-vertical-tab">
                                                                <input class="touchspin-vertical" type="text"
                                                                    value="0" />
                                                            </div>
                                                        </fieldset>-->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input_fields_wrap">
                                                    <div class="row" id="Cible">
                                                        <!--<script src="{{ asset('assets/js/nouveau-sous-titre.js') }}">
                                                    </script>-->
                                                    </div>

                                                </div>
                                                <a href="#" onclick="fAddText()" class="add_field_button"><i
                                                        class="icofont icofont-plus-square"
                                                        style="font-size: 1.5em;"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button"
                                        data-bs-dismiss="modal">Annuler</button>
                                    <button class="btn btn-primary" type="button">Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </i>
                <!--</div>-->

            </div>
        </div>
    </div>
</div>


@push('scripts')
<script src="{{ asset('assets/js/nouveau-sous-titre.js') }}"></script>
<script src="{{ asset('assets/js/touchspin/vendors.min.js') }}"></script>
<script src="{{ asset('assets/js/touchspin/touchspin.js') }}"></script>
<script src="{{ asset('assets/js/touchspin/input-groups.min.js') }}"></script>

@endpush

@endsection

