@extends('layouts.admin.master')

@section('title')Configuration des payements
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Configuration des payements</h3>
        @endslot
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item">Frais d'encadrement</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Frais d'encadrement</h5>
                        <a href={{ route('ajouter_frais') }}>
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success pull-right" type="button">
                                    Ajouter
                                </button>
                            </i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table">
                            <table class="display" id="auto-fill">
                                <thead>
                                <tr>
                                    <th>Grade</th>
                                    <th>Cycle</th>
                                    <th>Frais par mois</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fraisEncadrements as $frais)
                                <tr>
                                    <td>{{ucwords($frais->grade)}}</td>
                                    <td>{{ucwords($frais->cycle)}}</td>
                                    <td>{{ucwords($frais->frais)}} DT</td>
                                    <td class="text-center"> <a href="{{route('modifier_frais',$frais)}}"> <i
                                                style="font-size: 1.3em;" class='fa fa-edit'></i></a>
                                        <a href="#" data-id="{{ $frais->id }}"
                                           data-name=""
                                           class="delete">
                                            <i style="font-size: 1.3em;color:red" class='fa fa-trash delete'></i></a> </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Grade</th>
                                    <th>Cycle</th>
                                    <th>Frais</th>
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
        <script>
            $('.delete').click(function () {
                var dataId = $(this).attr('data-id');
                swal({
                    title: "Êtes-vous sûr de vouloir supprimer cette ligne ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location = "supprimer-frais/" + dataId + "";
                            swal("Poof! Cette ligne est bien supprimée!", {
                                icon: "success",
                            });
                        } else {
                            swal("La suppression est annulée!");
                        }
                    })
            });

        </script>
        @if (Session::get('message')=='exist')
            <script>
                swal('Oups', 'Cette ligne existe déjà dans la table', 'error', {
                    button: 'OK'
                })

            </script>
        @endif
            @endpush

@endsection

