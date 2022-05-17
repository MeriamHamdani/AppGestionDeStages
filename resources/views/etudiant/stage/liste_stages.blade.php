@extends('layouts.etudiant.master')

@section('title')Liste des stage
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>La liste des stages confirmés</h3>
@endslot
<li class="breadcrumb-item">Stage</li>
<li class="breadcrumb-item">La liste des stages confirmés</li>
<!--<li class="breadcrumb-item active">Auto fill</li>-->
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Mes Stages</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Année universitaire</th>
                                    <th>Entreprise</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Ma lettre d'affectation</th>
                                    <th>Etat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($demandes_confirmer as $demande )
                                <tr>
                                    <td>{{ Str::ucfirst($demande->type) }}
                                    </td>
                                    <td>{{ App\Models\AnneeUniversitaire::find($demande->annee_universitaire_id)->annee
                                        }}</td>
                                    <td>{{ App\Models\Entreprise::find($demande->entreprise_id)->nom
                                        }}</td>
                                    <td>{{ $demande->date_debut }}</td>
                                    <td>{{ $demande->date_fin }}</td>
                                    <td class="text-center"><a href={{
                                            route('telecharger_lettre_affect',['demande'=>$demande]) }}>
                                            <i style="font-size: 2em;" class="icofont icofont-file-pdf icon-large"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if ($demande->validation_admin==1)
                                        <button class="btn btn-primary btn-sm" data-toggle="tooltip"
                                            title="Stage terminée">
                                            <i class="icofont icofont-ui-check"></i>
                                        </button>
                                        @elseif ($demande->validation_admin==0)
                                        <button class="btn btn-secondary" data-toggle="tooltip" title="Stage en cours">
                                            <i class="fa fa-spinner fa-spin"></i>
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
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Ma letttre d'affectation</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
<script src="{{ asset('assets/js/tooltip-init.js')}}"></script>

@if(Session::has('message'))
<script>
    toastr.success("{!! Session::get('message') !!}")
</script>
@endif
@if(Session::has('message'))
@if (Session::get('message')=='download_OK')

<script>
    swal('Bien', 'Votre lettre d\'affectation est téléchargée', 'success', {
                        button: 'Continuer'
                    })

</script>

@elseif (Session::get('message')=='lettre_aff_introuvable')
<script>
    swal('Oups', 'Vous n\'avez pas une lettre d\'affectation pour ce stage , Veuillez contactez l\'administration', 'error')
</script>
@elseif (Session::get('message')=='attend_encadrant')
<script>
    swal('oups', 'Cette demande n\'est pas confirmée par l\'encadrant', 'alert', {
                        button: 'Continuer'
                    })
</script>
@endif
@endif
<script>
    $('.delete').click(function () {
                var dataId = $(this).attr('data-id');
                var dataName = $(this).attr('data-name');
                swal({
                    title: "Êtes-vous  sûr de vouloir supprimer La classe " + dataName + " ?",
                    //text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            //window.location=route('departement.destroy', ['id'=>dataId]);
                            window.location = "supprimer-classe/" + dataId + "";
                            swal("Poof! La classe est bien supprimée!", {
                                icon: "success",
                            });
                        } else {
                            swal("La suppression est annulée!");
                        }
                    })
            });

</script>
@endpush

@endsection
