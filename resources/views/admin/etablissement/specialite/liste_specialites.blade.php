@extends('layouts.admin.master')

@section('title')Gestion des spécialités
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">


@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Gestion des spécialités</h3>
@endslot
<li class="breadcrumb-item">Etablissement</li>
<li class="breadcrumb-item">Gestion des spécialités</li>

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>La liste des Spécialités</h5>
                    <div style="padding-left: 2px">
                        <a href={{ route('ajouter_specialite') }}>
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success btn-sm pull-right" type="button">
                                    Ajouter une Spécialité
                                </button>
                            </i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Spécialité</th>
                                    <th>Déparetement</th>
                                    <th>Responsable</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($specialites as $specialite)
                                <tr>
                                    <td>{{ucwords($specialite->code)}}</td>
                                    <td>{{ucwords($specialite->nom)}}</td>
                                    @if ( $specialite->departement_id==null)
                                    <td class="text-center">

                                        <a href="{{ route('modifier_specialite', $specialite) }}" data-toggle="tooltip"
                                            title="veuillez editer les informations de cette spécialité pour l'affecter à un
                                        département">
                                            <i class="icofont icofont-exclamation-tringle" style="font-size: 1.3em"></i>
                                        </a>

                                    </td>
                                    @else
                                    <td>{{ucwords($specialite->departement->nom)}}</td>
                                    @endif

                                    <td class="text-center">
                                        @if(isset($specialite->enseignant_id)){{ucwords($specialite->enseignant->nom)}}
                                        {{ucwords($specialite->enseignant->prenom)}}
                                        @else
                                        <a href="{{ route('modifier_specialite', $specialite) }}" data-toggle="tooltip"
                                            title="veuillez editer les informations de cette spécialité pour lui affecter un responsable">
                                            <i class="icofont icofont-exclamation-tringle" style="font-size: 1.3em"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('modifier_specialite', $specialite) }}"> <i
                                                style="font-size: 1.3em;" class='fa fa-edit'></i></a>
                                        <a href="#" data-id="{{ $specialite->id }}" data-name="{{ $specialite->nom }}"
                                            class="delete"> <i style="font-size: 1.3em;"
                                                class='fa fa-trash delete'></i></a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Spécialité</th>
                                    <th>Déparetement</th>
                                    <th>Responsable</th>
                                    <th>Actions</th>
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
<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/icons-notify.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon-clipart.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
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
@if(Session::has('message'))
<script>
    toastr.success("{!! Session::get('message') !!}")
</script>
@endif
@if(Session::has('message'))
@if (Session::get('message')=='ok')

<script>
    swal({
  position: 'center',
  icon: 'success',
  title: 'La nouvelle spécialité est sauvegardée avec succées',
  showConfirmButton: false,
  timer: 2500
})
    /*swal('Bien','Le nouveau enseignant est sauvegardé','success',{
        button: 'continuer'
    })*/

</script>

@elseif (Session::get('message')=='ko')
<script>
    swal({
  position: 'center',
  icon: 'error',
  title: 'Oups! cette spécialité existe déja ',
  showConfirmButton: false,
  timer: 2500
})
    /*swal('Oups','L\'enseignant existe déja','error',{
    button: 'reéssayer'
})*/
</script>
@elseif (Session::get('message')=='update')
<script>
    swal({
  position: 'center',
  icon: 'success',
  title: 'mise à jour éffectué',
  showConfirmButton: false,
  timer: 2500
})

</script>
@endif
@endif
<script>
    $('.delete').click(function(){
        var dataId=$(this).attr('data-id');
        var dataName=$(this).attr('data-name');
        //var dataAll =$(this).att('data-all');
        swal({
                    title: "Etes-vous sûr de vouloir supprimer la spécialité "+dataName+" ?",
                    //text: "Une fois supprimé, les classes attachés à cette spécialité seront sans spécialité!",
                    icon: "warning",
                    buttons: true,

                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location="supprimer-specialite/"+dataId+"";
                        swal("Ok! La spécialité est supprimée!", {
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
