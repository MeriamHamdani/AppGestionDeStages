@extends('layouts.admin.master')

@section('title')Liste des années universitaires
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
            <h3>Liste des années universitaires </h3>
        @endslot
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item">Liste des années universitaires</li>


    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Les années universitaires</h5>
                        <div style="padding-left: 2px">
                            <a href={{ route('config_annee_universitaire') }}>
                                <i class="text-right" aria-hidden="true">
                                    <button class="btn btn-pill btn-success btn-sm pull-right" type="button">
                                        Ajouter l'année universitaire actuelle
                                    </button>
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext">
                            <table class="display" id="auto-fill">
                                <thead>
                                <tr>
                                    <th>Année Universitaire </th>
                                    <th>Lettre d'affectation</th>
                                    <th>Fiche d'encadrement</th>
                                    <th>Les grilles</th>
                                    <th>Les Pvs</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($annees as $annee)
                                <tr>
                                    <td class="text-center">{{$annee->annee}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('telecharger_lettre_affectation',['lettre_affectation'=>Str::afterLast($annee->lettre_affectation, '/'),'annee'=>$annee]) }}"
                                                                data-toggle="tooltip" title="Télécharger le model de la lettre d'affectation">
                                            <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i>
                                        </a></td>
                                    <!--dd(public_path() . '/storage/'. $annee->lettre_affectation)-->
                                    <td class="text-center"> <a href="{{ route('telecharger_fiche_encadrement',Str::after($annee->fiche_encadrement, '/')) }}"
                                                                data-toggle="tooltip" title="Télécharger le model de la fiche d'encadrement">
                                            <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i></i>
                                        </a></td>
                                    <td class="text-center"> <a href="{{ route('telecharger_grille_licence',Str::after($annee->grille_evaluation_licence, '/')) }}"
                                                                data-toggle="tooltip" title="Télécharger le model de la grille d'évaluation licence">
                                            <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i></i>
                                        </a>
                                      <a href="{{ route('telecharger_grille_info',Str::after($annee->grille_evaluation_info, '/')) }}"
                                         data-toggle="tooltip" title="Télécharger le model de la grille d'évaluation licence informatique">
                                          <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i></i>
                                        </a>
                                        <a href="{{ route('telecharger_grille_master',Str::after($annee->grille_evaluation_master, '/')) }}"
                                         data-toggle="tooltip" title="Télécharger le model de la grille d'évaluation mastère">
                                            <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i>
                                        </a></td>
                                        <td class="text-center">
                                            <a href="{{ route('telecharger_pv_individuel',Str::after($annee->pv_individuel, '/')) }}"
                                                                    data-toggle="tooltip" title="Télécharger le model de PV individuel">
                                                <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i></i> </a>
                                            <a href="{{ route('telecharger_pv_global',Str::after($annee->pv_global, '/')) }}"
                                                                    data-toggle="tooltip" title="Télécharger le model de PV global">
                                                <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i></a>
                                        </td>

                                    <td class="text-center">
                                            <a href={{route('modifier_annee_universitaire',$annee)}}> <i style="font-size: 1.3em;" class='icofont icofont-edit icon-large'
                                                          data-toggle="tooltip" title="Editer"></i></a>
                                        </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Année Universitaire </th>
                                    <th>Lettre d'affectation</th>
                                    <th>Fiche d'encadrement</th>
                                    <th>Les grilles</th>
                                    <th>Les Pvs</th>
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
        @endif
    @endpush

@endsection
