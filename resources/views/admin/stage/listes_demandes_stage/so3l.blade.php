@extends('layouts.admin.master')

@section('title')Liste des demandes des stages obligatoires pour 3ème année licence non-informatique
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Liste des demandes des stages obligatoires pour 3ème année licence non-informatique</h3>
        @endslot
        <li class="breadcrumb-item">Stages</li>
        <li class="breadcrumb-item">Les demandes des stages</li>
        <li class="breadcrumb-item">Stages obligatoires pour 3éme année licence non-informatique</li>

    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Les demandes</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="auto-fill">
                                <thead>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>Classe</th>
                                    <th>Encadrant</th>
                                    <th>La fiche de demande</th>
                                    <th>Confirmation de l'encadrant</th>
                                    <th>Confirmation de l'administration</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($stages as $stage )
                                    <tr>
                                        <td>{{ App\Models\Etudiant::find($stage->etudiant_id)->nom }}
                                            {{ App\Models\Etudiant::find($stage->etudiant_id)->prenom }}</td>
                                        <td>{{$stage->code_classe}}</td>
                                        <td>{{ App\Models\Enseignant::find($stage->enseignant_id)->nom }}&nbsp;{{
                                        App\Models\Enseignant::find($stage->enseignant_id)->prenom }}</td>


                                    @if(isset($stage->fiche_demande))
                                    <td class="text-center"><a
                                            href="{{ route('telechargement_fiche_demande',['fiche_demande'=>$stage->file,'code_classe'=>$stage->code_classe]) }}">

                                            <i style="font-size: 2em;" class="icofont icofont-file-pdf icon-large"></i>
                                        </a>
                                    </td>
                                    @else
                                    <td class="text-center">
                                        <i class="icofont icofont-exclamation-tringle" style="font-size: 1.3em"></i>
                                    </td>
                                    @endif
                                    @if ($stage->confirmation_encadrant==null)
                                    <td class="text-center">
                                        <button class="buttonload" data-toggle="tooltip" title="demande en attente">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </button>
                                    </td>
                                    @endif
                                    @if ($stage->confirmation_encadrant==-1)
                                    <td style="text-align: center">
                                        <i data-toggle="tooltip" title="demande refusée" style="background-position: 0 -90px;
>>>>>>> 7fbe0e17b3d84e1edbde6ce8fc8d8e17981bc97c
                                            height: 30px;
                                            width: 23px;
                                            display:block;
                                            margin:0 auto; color: #B3363E;"
                                                   class="icofont icofont-ui-close icon-large"></i>

                                            </td>
                                        @endif
                                        @if ($stage->confirmation_encadrant==1)
                                            <td class="text-center">

                                                <i data-toggle="tooltip" title="demande confirmée" style="background-position: 0 -90px;
                                        height: 30px;
                                        width: 23px;
                                        display:block;
                                        margin:0 auto; color: #4B8D5F" class="icofont icofont-ui-check icon-large"></i>

                                            </td>
                                        @endif
                                        <td class="text-center">
                                            @if ($stage->confirmation_admin==null)
                                                <button class="buttonload" data-toggle="tooltip"
                                                        title="demande en attente">
                                                    <i class="fa fa-spinner fa-spin"></i>
                                                </button>
                                            @endif
                                            @if ($stage->confirmation_admin==-1)
                                                <i data-toggle="tooltip" title="demande refusée" style="background-position: 0 -90px;
                                            height: 30px;
                                            width: 23px;
                                            display:block;
                                            margin:0 auto; color: #B3363E;"
                                                   class="icofont icofont-ui-close icon-large"></i>
                                            @endif
                                            @if ($stage->confirmation_admin==1)
                                                <i data-toggle="tooltip" title="demande confirmée" style="background-position: 0 -90px;
                                        height: 30px;
                                        width: 23px;
                                        display:block;
                                        margin:0 auto; color: #4B8D5F" class="icofont icofont-ui-check icon-large"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($stage->confirmation_admin!=1)
                                                <a href="{{ route('confirmer_demande',['stage_id'=>$stage->id]) }}"> <i
                                                        data-toggle="tooltip" title="Confirmer"
                                                        class="icofont icofont-ui-check icon-large"></i></a>
                                            @endif
                                            @if ($stage->confirmation_admin!=-1)
                                                <a href="{{ route('refuser_demande',['stage_id'=>$stage->id]) }}"><i
                                                        data-toggle="tooltip" title="Refuser"
                                                        class="icofont icofont-ui-close icon-large"></i></a>
                                            @endif
                                            <a href="{{ route('demandes_stage.modifier_demande',['stage_id'=>$stage->id]) }}"
                                               data-title="Modifer" data-toggle="tooltip" title="Modifer"><i
                                                    class="icofont icofont-ui-edit icon-large"></i></a>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>

                                <tr>
                                    <th>Nom Complet</th>
                                    <th>Classe</th>
                                    <th>Encadrant</th>
                                    <th>La fiche de demande</th>
                                    <th>Confirmation de l'encadrant</th>
                                    <th>Confirmation de l'administration</th>
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
            @if (Session::get('message')=='attend_encadrant')

                <script>
                    swal('C\'est interdit', 'Il faut que l\'encadrant confirme la demande d\'abord', 'warning', {
                        button: 'error'
                    })

                </script>
            @endif
        @endif
    @endpush

@endsection
