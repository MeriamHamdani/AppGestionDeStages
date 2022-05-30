@extends('layouts.etudiant.master')

@section('title')Détails dépôt
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Détails dépôt</h3>
        @endslot
        <li class="breadcrumb-item">Dépôt</li>
        <li class="breadcrumb-item">Détails dépôt</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <!-- Ajax Generated content for a column start-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Détails dépôt</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm col-xl-8">
                            <table class=" xl-10"  id="basic-1">
                                <thead>
                                <tr>
                                    <th>Titre sujet</th>
                                    <th>Mémoire</th>
                                </tr>
                                </thead>

                                <tbody>
                                        <tr>
                                            <td>{{$depotMemoire->titre}}</td>

                                            <td> <a class="btn btn-secondary btn-sm" href="{{route('telecharger_memoire',['memoire'=>$mem, 'code_classe'=>$depotMemoire->stage->etudiant->classe->code])}}" data-title="Consulter le mémoire" data-toggle="tooltip" data-original-title="Consulter le mémoire" title="Télécharger le mémoire">
                                                    <i class="fa fa-file-text-o large" style="color:whitesmoke "></i></a>
                                            </td>
                                        </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Titre sujet</th>
                                    <th>Mémoire</th>
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

    @endpush

@endsection

