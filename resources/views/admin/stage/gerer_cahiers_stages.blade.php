@extends('layouts.admin.master')

@section('title')Gérer les cahiers des stages
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Gérer les cahiers des stages</h3>
        @endslot
        <li class="breadcrumb-item">Stage</li>
        <li class="breadcrumb-item">Gérer les cahiers des stages</li>

    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Les cahiers des stages</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="auto-fill">
                                <thead>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Type de sujet</th>
                                    <th>Etudiant</th>

                                    <th>Année universitaire</th>
                                    <th>Etat de cahier de stage</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($cahiers as $cahierStg)
                                    <tr>
                                        <td>{{ $cahierStg->stage->titre_sujet }} </td>
                                        <td>{{ $cahierStg->stage->type_sujet }}</td>
                                        <td>{{ App\Models\Etudiant::find($cahierStg->stage->etudiant_id)->nom }}&nbsp;{{
                                        App\Models\Etudiant::find($cahierStg->stage->etudiant_id)->prenom }} </td>
                                        <td>{{
                                        App\Models\AnneeUniversitaire::find($cahierStg->stage->annee_universitaire_id)->annee
                                        }}</td>
                                        <td>
                                            @if($cahierStg->etat==1)
                                                <span>Partiellement éditée <progress stype="width:100px;height:10px"
                                                                                     value="45"
                                                                                     max="100"></progress></span>
                                            @else
                                                <span>Pas encore éditée <progress stype="width:100px;height:10px"
                                                                                  value="0"
                                                                                  max="100"></progress></span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="col-sm-6 col-md-6 col-lg-4"
                                                 style="display: table-cell;text-align: center; vertical-align:middle;">
                                                <a
                                                    href="{{ route('cahier_de_stage',['cahier'=>$cahierStg]) }}"
                                                    data-toggle="tooltip" title="consulter"><i
                                                        class="icofont icofont-read-book icon-large"
                                                        style="font-size: 2em; aligne: center"></i></a>
                                                <a class="f-w-600"
                                                   href="{{ route('download_all_cs',['cahier'=>$cahierStg]) }}"
                                                   data-toggle="tooltip" title="Télécharger le cahier"><i
                                                        data-feather="download"
                                                        class="icofont icofont-download-alt"></i></a>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Type de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Année universitaire</th>
                                    <th>Etat de cahier de stage</th>
                                    <th>Action</th>
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
        <script src=" {{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}">
        </script>
        <script src="{{asset('assets/js/datatable/datatable-extension/custom.js')}}">
        </script>
    @endpush

@endsection
