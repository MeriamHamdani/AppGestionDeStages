@extends('layouts.etudiant.master')

@section('title')Mes demandes de stage
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Mes demandes des stage</h3>
@endslot
<li class="breadcrumb-item">Stage</li>
<li class="breadcrumb-item">Mes demandes des stage</li>
<!--<li class="breadcrumb-item active">Auto fill</li>-->
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Mes demandes</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Année universitaire</th>
                                    <th>Entreprise</th>
                                    <th>Encadrant</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Etat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($demandes_classes as $demande)
                                <tr>
                                    <td>{{$demande->typeStage->nom}}</td>
                                    <td>{{
                                        App\Models\AnneeUniversitaire::find($demande->annee_universitaire_id)->annee}}
                                    </td>
                                    @if(isset($demande->entreprise_id))
                                    <td>{{ App\Models\Entreprise::find($demande->entreprise_id)->nom}}</td>
                                    @else
                                    <td class="text-center">
                                    </td>
                                    @endif
                                    @if(isset($demande->enseignant->prenom))
                                    <td>{{ucwords($demande->enseignant->prenom)}} {{ucwords($demande->enseignant->nom)}}
                                    </td>
                                    @else
                                    <td class="text-center">
                                    </td>
                                    @endif
                                    <td>{{ $demande->date_debut }}</td>
                                    <td>{{ $demande->date_fin }}</td>
                                    <td>
                                        @if($demande->confirmation_admin == 0)
                                        <button class="btn btn-warning btn-sm" data-toggle="tooltip"
                                            title="demande en attente">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </button>
                                        @if($demande->confirmation_encadrant == -1)
                                        <button class="btn btn-outline-danger btn-sm" data-toggle="tooltip"
                                            title="demande encadrement refusée">
                                            <i class="icofont icofont-ui-close"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm"> <a
                                                href="{{ route('modifier_demande',['stage_id'=>$demande->id]) }}"
                                                data-title="Modifer" data-toggle="tooltip"
                                                title="choisir un autre encadrant"> <i
                                                    class="icofont icofont-ui-edit icon-large"></i> </a></button>
                                        @endif
                                        @endif
                                        @if($demande->confirmation_admin == 1)
                                        <button class="btn btn-primary btn-sm" data-toggle="tooltip"
                                            title="demande confirmée">
                                            <i class="icofont icofont-ui-check"></i>
                                        </button>
                                        @endif
                                        @if($demande->confirmation_admin == -1)
                                        <!-- demande refusée -->
                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip"
                                            title="demande refusée">
                                            <i class="icofont icofont-ui-close"></i>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Type</th>
                                    <th>Année universitaire</th>
                                    <th>Entreprise</th>
                                    <th>Encadrant</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Etat</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(Session::has('message'))
<script>
    toastr.success("{!! Session::get('message') !!}")
</script>
@endif
@if(Session::has('message'))
@if (Session::get('message')=='stage exist')

<script>
    swal('oups', "Vous avez deja une demande de stage en attente, vous ne pouvez pas envoyer une autre avant que l'administration l'accepter ou la refuser ", 'error', {
                button: 'Continuer'
                //showConfirmButton: false,
  //timer: 2500
            })

</script>
@endif
@endif

@endpush
@endsection

