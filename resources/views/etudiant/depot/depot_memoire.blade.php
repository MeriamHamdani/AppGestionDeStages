@extends('layouts.etudiant.master')

@section('title')Déposer mon mémoire
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Déposer mon mémoire</h3>
        @endslot
        <li class="breadcrumb-item">Dépôt</li>
        <li class="breadcrumb-item">Gérer le dépôt</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <!-- Ajax Generated content for a column start-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Stage & Dépôt</h5>
                        <span>Ce table contient titre de stage et une action qui m'amène à dépôser mon mémoire s'il est
                        possible</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Encadrant</th>
                                    <th>Gérer le dépôt</th>
                                    <th>Etat</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($stagesAdeposer as $stages)
                                    @foreach($stages as $stage)
                                        <tr>
                                            <td>{{$stage->type_sujet}}</td>

                                            <td>{{ucwords($stage->enseignant->prenom)}} {{ucwords($stage->enseignant->nom)}} </td>
                                            @if($stage->typeStage->date_limite_depot > $current_date)
                                                @if(\App\Models\DepotMemoire::where('stage_id',$stage->id)->first() == null)
                                                    <td><a class="btn btn-warning btn"
                                                           href="{{ route('deposer',['stage_id'=> $stage->id]) }}">
                                                            <i class="icofont icofont-papers">
                                                                Dépôser
                                                            </i></a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm" data-toggle="tooltip"
                                                                title="Pas encore dépôsé">
                                                            <i class="icofont icofont-question"></i>
                                                        </button>
                                                    </td>
                                                @elseif(\App\Models\DepotMemoire::where('stage_id',$stage->id)->first()->validation_encadrant == -1)
                                                    <td><a class="btn btn-secondary"
                                                           href="{{ route('afficher_details',['depotMemoire'=> \App\Models\DepotMemoire::where('stage_id',$stage->id)->first()]) }}">
                                                            <i class="icofont icofont-papers">
                                                                Afficher les détails
                                                            </i></a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-secondary" data-toggle="tooltip"
                                                                title="Déposé en attente de validation">
                                                            <i class="fa fa-spinner fa-spin"></i>
                                                        </button>
                                                    </td>

                                                @elseif(\App\Models\DepotMemoire::where('stage_id',$stage->id)->first()->validation_encadrant == 1)
                                                    <td><a class="btn btn-primary"
                                                           href="{{ route('afficher_details',['depotMemoire'=> \App\Models\DepotMemoire::where('stage_id',$stage->id)->first()]) }}">
                                                            <i class="fa fa-list">
                                                                Afficher les détails
                                                            </i></a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                                title="Déposé et validé">
                                                            <i class="icofont icofont-ui-check"></i>
                                                        </button>
                                                    </td>
                                                @elseif(\App\Models\DepotMemoire::where('stage_id',$stage->id)->first()->validation_encadrant == 0)
                                                    <td><a class="btn btn-secondary btn"
                                                           href="{{ route('redeposer',['depotMemoire'=> \App\Models\DepotMemoire::where('stage_id',$stage->id)->first()]) }}">
                                                            <i class="fa fa-repeat">
                                                               Redépôser
                                                            </i></a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                                title="Demande dépôt refusée">
                                                            <i class="icofont icofont-ui-close"></i>
                                                        </button>
                                                        <button class="btn btn-secondary btn-sm" data-toggle="tooltip"
                                                                title="Les remarques de l'encadrant">
                                                            <a href="{{ route('remarques_encadrant',['depotMemoire'=> \App\Models\DepotMemoire::where('stage_id',$stage->id)->first()]) }}">
                                                                <i class="icofont icofont-comment"
                                                                   style="color: white"></i>
                                                            </a>
                                                        </button>
                                                    </td>
                                                @endif
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                                <!-- <tr>
                                    <td>Jenette Caldwell</td>
                                    <td>Development Lead</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                    class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a>
                                    </td>
                                    <td><button class="btn btn-primary btn-sm" data-toggle="tooltip" title="demande dépôt confirmée">
                                            <i class="icofont icofont-ui-check"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Yuri Berry</td>
                                    <td>Chief Marketing Officer (CMO)</td>
                                    <td><a class="btn btn-primary" href="#"
                                            class="#">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a>
                                    </td>
                                    <td><button class="btn btn-danger btn-sm" data-toggle="tooltip" title="demande dépôt refusée">
                                            <i class="icofont icofont-ui-close"></i>
                                        </button>
                                        <button class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Les remarques de l'encadrant">
                                               <a href>
                                            <i class="icofont icofont-comment" style="color: white"></i>
                                               </a>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Caesar Vance</td>
                                    <td>Pre-Sales Support</td>
                                    <td><a class="btn btn-primary" href={{ Route('deposer') }}
                                    class="{{ routeActive('deposer') }}">
                                            <i class="icofont icofont-papers">
                                                Gérer le dépôt
                                            </i></a>
                                    </td>
                                    <td><button class="btn btn-primary btn-sm" data-toggle="tooltip" title="demande dépôt confirmée">
                                            <i class="icofont icofont-ui-check"></i>
                                        </button>
                                    </td>
                                </tr> -->
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Type</th>
                                    <th>Encadrant</th>
                                    <th>Gérer le dépôt</th>
                                    <th>Etat</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ajax Generated content for a column end-->
        </div>
    </div>


    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
                integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
        <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
        <script src="{{ asset('assets/js/icons/icons-notify.js') }}"></script>
        <script src="{{ asset('assets/js/icons/icon-clipart.js') }}"></script>
        @if(Session::has('message'))
            @if (Session::get('message')=='deja déposé')

                <script>
                    swal('Erreur', "Vous avez déjà dépôsé le mémoire! Vous devez attendre la décision de vottre encadrant", 'error', {
                        button: 'Ok'
                    })

                </script>
            @endif
        @endif

    @endpush

@endsection

