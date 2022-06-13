@extends('layouts.enseignant.master')

@section('title')Liste de demandes d'encadrement
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>La liste de demandes d'encadrement</h3>
@endslot
<li class="breadcrumb-item">Encadrement</li>
<li class="breadcrumb-item">La liste de demandes d'encadrement</li>

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Les Demandes</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Etudiant</th>
                                    <th>Type de Stage</th>
                                    <th>Sujet</th>
                                    <th>Entreprise</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Confirmation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stages as $stage)
                                @if($stage->confimation_encadrant == null)
                                <tr>
                                    <td>{{ucwords($stage->etudiant->nom)}}&nbsp; {{ucwords($stage->etudiant->prenom)}}
                                    </td>
                                    <td>{{$stage->etudiant->classe->typeStage->nom}}</td>
                                    <td>@if(isset($stage->type_sujet)){{$stage->type_sujet}}@endif</td>
                                    @if(isset($stage->entreprise))
                                    <td>{{$stage->entreprise->nom}}</td>
                                    @else
                                        <td class="text-center">
                                            <i class="icofont icofont-exclamation-tringle" style="font-size: 1.3em"></i>
                                        </td>
                                    @endif
                                    <td>{{$stage->date_debut}}</td>
                                    <td>{{$stage->date_fin}}</td>
                                    <td>
                                        <div style="align-content: center">
                                            {{--<a href="#" data-title="confirmer-demande" data-toggle="tooltip"
                                                title="confirmer la demande" onclick="this.disabled = true">
                                                <i style="background-position: 0 -90px;
                                                            height: 30px;
                                                            width: 23px;
                                                            display:block;
                                                            margin:0 auto;" class="icofont icofont-ui-check"></i>
                                            </a>
                                            <a href="#" data-title='refuser-demande' data-toggle='tooltip'
                                                title="refuser la demande">

                                                <i style="background-position: 0 -90px;
                                                height: 30px;
                                                width: 23px;
                                                display:block;
                                                margin:0 auto;" class="icofont icofont-ui-close"></i>
                                            </a>
                                            --}}
                                            <a href="{{route('confirmer_demande_enseignant',$stage)}}">
                                                <button class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                    title="confirmer la demande">
                                                    <i class="icofont icofont-ui-check"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('refuser_demande_enseignant',$stage)}}">
                                                <button class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                    title="refuser la demande">
                                                    <i class="icofont icofont-ui-close"></i>
                                                </button>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Etudiant</th>
                                    <th>Type de Stage</th>
                                    <th>Sujet</th>
                                    <th>Entreprise</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Confirmation</th>
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

