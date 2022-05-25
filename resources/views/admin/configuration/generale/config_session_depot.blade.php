@extends('layouts.admin.master')

@section('title')Configuration de session de dépot
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3 style="text-align: center;">Configuration de session de dépot des mémoires</h3>
@endslot

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 center-content">

            <div class="card">

                <div class="col-xl-12 xl-90 col-lg-12 box-col-12">

                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="media faq-widgets">
                                <div class="media-body">
                                    <h5>Voulez-vous ouvrir une session de dépot des memoires!</h5>
                                    <p style="color:white">

                                        <a href=#>
                                            <i class="text-right" aria-hidden="true">
                                                <button class="btn btn-pill btn-success btn-sm pull-right" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#import"
                                                    data-whatever="@getbootstrap">
                                                    cliquez ici
                                                </button>
                                                <div class="modal fade" id="import" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" style="display: none;"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ $annee }}
                                                                </h5>
                                                                <button class="btn-close" type="button"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST"
                                                                    action="{{ route('new_session_depot') }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Date de
                                                                                debut de dépot</label>
                                                                            <input
                                                                                class="datepicker-here form-control digits date-picker"
                                                                                type="text" data-language="en"
                                                                                required="required" name="date_debut"
                                                                                id="date_debut_depot" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label">Date limite de
                                                                                dépot</label>
                                                                            <input
                                                                                class="datepicker-here form-control digits"
                                                                                type="text" data-language="en"
                                                                                required="required" name="date_fin"
                                                                                id="date_limite_depo" />
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="col-form-label"
                                                                            for="recipient-name">Type
                                                                            de stage</label>
                                                                        <div class="mb-2">
                                                                            @foreach($tpStg as
                                                                            $ts)
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="d-block"
                                                                                        for="chk-ani"><input
                                                                                            class="checkbox_animated"
                                                                                            id="chk-ani" type="checkbox"
                                                                                            name="type_stages[]"
                                                                                            value={{$ts->id}}>
                                                                                        {{$ts->nom}}</label>
                                                                                </div>


                                                                            </div>

                                                                            @endforeach

                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button"
                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                        <button class="btn btn-primary"
                                                                            type="submit">Ouvrir</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </i>
                                        </a>

                                    </p>
                                </div>
                                <i data-feather="download"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push(' scripts')
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}">
</script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(Session::has('message'))
<script>
    toastr.success("{!! Session::get('message') !!}")
</script>
@endif
@if(Session::has('message'))

<script>
    swal('Oups',get('message'),'error',{
                        button: 'Continuer'
                    })

</script>

@endif
@endpush

@endsection
