@extends('layouts.admin.master')

@section('title')Liste sessions dépôt
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert2.css')}}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Liste sessions dépôt</h3>
        @endslot
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item">Liste sessions dépôt</li>

    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>La liste des sessions de dépôt</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table">
                            <table class="display" id="auto-fill">
                                <thead>
                                <tr>
                                    <th>Type Stage</th>
                                    <th>Date début session</th>
                                    <th>Date limite session</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sessionsOuvertes as $session )
                                        <tr>
                                            <td>{{ $session->nom }}</td>
                                            <td>{{ $session->date_debut_depot }}</td>
                                            <td>{{ $session->date_limite_depot }}</td>
                                            <td class="text-center">
                                                <a href="{{route('modifier_session',$session->id )}}"> <i
                                                        style="font-size: 1.3em;" class='fa fa-edit'></i></a>
                                                <a href="#" data-id="{{ $session->id }}" data-name="{{ $session->nom }}" class="delete"> <i
                                                        style="font-size: 1.3em;" class='fa fa-trash delete'></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Type Stage</th>
                                    <th>Date début session</th>
                                    <th>Date limite session</th>
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
                        title: 'Ajout avec succée',
                        showConfirmButton: false,
                        timer: 2500
                    })


                </script>

            @elseif (Session::get('message')=='ko')
                <script>
                    swal({
                        position: 'center',
                        icon: 'error',
                        title: 'Le département existe déja',
                        showConfirmButton: false,
                        timer: 2500
                    })
                </script>
            @elseif (Session::get('message')=='update')
                <script>
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: 'Le département est mis à jour',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    /*swal('Bien','Le département est mis à jour','success',{
                    button: 'continuer'
                })*/
                </script>
            @endif
        @endif
        <script>
            $('.delete').click(function(){
                var dataId=$(this).attr('data-id');
                var dataName=$(this).attr('data-name');
                swal({
                    title: "Etes-vous sûr de vouloir supprimer cette session "+dataName+" ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            //window.location=route('departement.destroy', ['id'=>dataId]);
                            window.location="session-depot/supprimer/"+dataId+"";
                            swal("OK! La session est bien supprimée!", {
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
