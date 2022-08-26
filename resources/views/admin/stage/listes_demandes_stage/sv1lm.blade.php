@extends('layouts.admin.master')

@section('title')Liste des demandes des stages volontaires
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/buttonload.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>La liste des demandes des stages volontaires </h3>
        @endslot
        <li class="breadcrumb-item">Stages</li>
        <li class="breadcrumb-item">Les demandes des stages</li>
        <li class="breadcrumb-item">Stage volontaire 1ére année licence et 1ère année mastère</li>

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
                                    <th>Les fiches</th>
                                    <th>Date début stage</th>
                                    <th>Date fin stage</th>
                                    <th>Confirmation de l'administration</th>
                                    <th>Actions pour la demande</th>
                                    <th>Valider le stage</th>
                                    <th>Etat</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($stages_volontaires as $stage )
                                    <tr>
                                        <td>{{ucwords($stage->etudiant->prenom) }} {{ ucwords($stage->etudiant->nom) }}</td>
                                        <td>{{$stage->etudiant->classe->code}}</td>
                                        <td class="text-center">
                                            @if(isset($stage->fiche_demande))
                                                <a href="{{ route('telecharger_fiche_demande',['fiche_demande'=>$stage->file,'code_classe'=>$stage->code_classe,'stage'=>$stage]) }}">
                                                    <i class="icofont icofont-papers icon-large"
                                                       style="color:#bf9168 "></i>
                                                </a>
                                            @endif
                                            @if(isset($stage->fiche_2Dinars))
                                                <a href="{{route('telecharger_fiche_2Dinars',['fiche_2Dinars'=>Str::after($stage->fiche_2Dinars, '/'),
                                                                                'code_classe'=>$stage->etudiant->classe->code,'stage'=>$stage])}}"
                                                   data-toggle="tooltip" title="Télécharger la fiche 2 dinars">
                                                    <i class="icofont icofont-ui-copy icon-large"
                                                       style="color: #8a6d3b"></i></a>
                                            @endif
                                            @if(isset($stage->fiche_assurance))
                                                <a href="{{route('telecharger_fiche_assurance',['fiche_assurance'=>Str::after($stage->fiche_assurance, '/'),
                                                                                'code_classe'=>$stage->etudiant->classe->code,'stage'=>$stage])}}"
                                                   data-toggle="tooltip" title="Télécharger la fiche assurance">
                                                    <i class="icofont icofont-paper icon-large"
                                                       style="color: #8a6d3b"></i></a>
                                            @endif

                                        </td>
                                        <td style="font-size:12px">{{$stage->date_debut}}</td>
                                        <td style="font-size:11.5px">{{$stage->date_fin}}</td>
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
                                            margin:0 auto; color: #4B8D5F"
                                                   class="icofont icofont-ui-check icon-large"></i>
                                            @endif
                                        </td>
                                        @if($stage->date_fin > $current_date)
                                            <td class="text-center">
                                                @if ($stage->confirmation_admin == 0 )
                                                    <a href="{{ route('confirmer_demande',['stage_id'=>$stage->id]) }}">
                                                        <i
                                                            data-toggle="tooltip" title="Confirmer"
                                                            class="icofont icofont-ui-check icon-large"></i></a>

                                                    <a href="{{ route('refuser_demande',['stage_id'=>$stage->id]) }}"><i
                                                            data-toggle="tooltip" title="Refuser"
                                                            class="icofont icofont-ui-close icon-large"></i></a>
                                                @endif
                                                @if($stage->confirmation_admin!= -1)
                                                    <a href="{{ route('demandes_stage.modifier_demande',['stage_id'=>$stage->id]) }}"
                                                       data-title="Modifer" data-toggle="tooltip" title="Modifer"><i
                                                            class="icofont icofont-ui-edit icon-large"></i></a>
                                                @elseif($stage->confirmation_admin == -1)
                                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                            title="demande refusée">
                                                        <i class="icofont icofont-ui-close"></i>
                                                    </button>
                                                @endif

                                            </td>
                                        @else
                                            <td class="text-center">
                                            </td>
                                        @endif
                                        <td class="text-center">
                                            @if($stage->validation_admin==null)
                                                <a href="{{ route('valider_stage_non_terminale',$stage)}}">
                                                    <i class="icofont icofont-check-circled"
                                                       style="font-size: 1.6em;color:darkgreen"></i> </a>
                                            @elseif(($stage->validation_admin==1))
                                                <button class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                        style="font-size: 0.6em"> Stage
                                                    Validé
                                                </button>
                                            @endif
                                            @if($stage->validation_admin==null)
                                                    <a href="{{ route('invalider_stage_non_terminale',$stage)}}">
                                                <i class="icofont icofont-close-circled"
                                                   style="font-size: 1.6em;color:darkred"></i> </a>
                                            @elseif(($stage->validation_admin==-1))
                                                <button class="btn btn-dark-gradien btn-sm" data-toggle="tooltip"
                                                    style="font-size: 0.6em"> Stage
                                                    NON Validé
                                                </button>
                                                @endif

                                        </td>
                                        <td> @if($stage->date_fin >= $current_date)
                                                @if($stage->confirmation_admin == 0)
                                                    <button class="btn btn-warning btn-sm" data-toggle="tooltip"
                                                            title="demande en attente">
                                                        <i class="fa fa-spinner fa-spin"></i>
                                                    </button>
                                                @elseif($stage->confirmation_admin == 1)
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                            title="Stage en cours">
                                                        <i class="fa fa-spinner fa-spin"></i>
                                                    </button>
                                                @elseif($stage->confirmation_admin == -1)
                                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                            title="demande refusée">
                                                        <i class="icofont icofont-ui-close"></i>
                                                    </button>
                                                @endif
                                            @elseif($stage->date_fin < $current_date)
                                                @if($stage->validation_admin == 1)
                                                    <button class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                            title="stage valide et terminé">
                                                        <i class="icofont icofont-ui-check"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-dark-gradien btn-sm" data-toggle="tooltip"
                                                            title="stage terminé non validé">
                                                        <i class="icofont icofont-ui-close"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>Classe</th>
                                    <th>Les fiches</th>
                                    <th>Date début stage</th>
                                    <th>Date fin stage</th>
                                    <th>Confirmation de l'administration</th>
                                    <th>Actions pour la demande</th>
                                    <th>Valider le stage</th>
                                    <th>Etat</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="table">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>Légende</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="tooltip">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </button>
                                </td>

                                <td>Demande de stage en attente</td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip">
                                        <i class="icofont icofont-ui-close"></i>
                                    </button>
                                </td>
                                <td>Demande de stage refusée</td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-secondary" data-toggle="tooltip">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </button>
                                </td>
                                <td>Stage en cours/actif</td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="tooltip">
                                        <i class="icofont icofont-ui-check"></i>
                                    </button>
                                </td>
                                <td>Stage achevé et validé</td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-dark-gradien btn-sm" data-toggle="tooltip">
                                        <i class="icofont icofont-ui-close"></i>
                                    </button>
                                </td>
                                <td>Stage achevé et non validé</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
                integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            @if (Session::get('message')=='demande_confirmé')
                <script>
                    swal('Demande de stage acceptée', '', 'success', {
                        button: 'OK'
                    })
                </script>
            @endif
            @if (Session::get('message')=='demande_refusé')

                <script>
                    swal('Demande de stage refusée', '', 'warning', {
                        button: 'OK'
                    })

                </script>
            @endif
            @if (Session::get('message')=='dure_stage_inacheve')

                <script>
                    swal('Durée stage inachevée', 'Vous ne pouvez pas valider/invalider un stage dont la durée n\'est pas encore achevée', 'warning', {
                        button: 'OK'
                    })

                </script>
            @endif
            @if (Session::get('message')=='stage_valide')
                <script>
                    swal('Stage Validé', '', 'success', {
                        button: 'OK'
                    })
                </script>
            @endif
            @if (Session::get('message')=='stage_invalide')

                <script>
                    swal('Stage NON Validé', '', 'warning', {
                        button: 'OK'
                    })

                </script>
            @endif
            @if (Session::get('message')=='demande_en_attente')

                <script>
                    swal('Demande pas encore acceptée', 'Vous ne pouvez pas valider/invalider un stage dont la demande de stage n\'est pas encore acceptée', 'warning', {
                        button: 'OK'
                    })


                </script>
            @endif
        @endif
    @endpush

@endsection
