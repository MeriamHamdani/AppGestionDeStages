@extends('layouts.admin.master')

@section('title')Liste des administrateurs
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>La liste des administrateurs</h3>
@endslot
<li class="breadcrumb-item">Administration</li>
<li class="breadcrumb-item">La liste des administrateurs</li>

@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Les Administrateurs</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>CIN</th>
                                    <th>Numéro de téléphone</th>
                                    <th>Adresse mail</th>
                                    <th>Statut</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adminIsActive as $aia)


                                <tr>
                                    <td>{{ $aia["admin"]->nom }}</td>
                                    <td>{{ $aia["admin"]->prenom }}</td>
                                    <td>{{ $aia["user"]->numero_CIN }}</td>
                                    <td>{{ $aia["admin"]->numero_telephone }}</td>
                                    <td>{{ $aia["admin"]->email }}</td>

                                    <td class="text-center">
                                        @if ( $aia["user"]->is_active)
                                        <a class=" btn btn-icon-only default" href="#" data-placement="top"
                                            data-toggle="tooltip" title="admin active"><img
                                                src="{{ asset('assets/images/userActive.png') }}">

                                        </a>
                                        @else
                                        <a class=" btn btn-icon-only default" href="#" data-placement="top"
                                            data-toggle="tooltip" title="admin inactive"><img
                                                src="{{ asset('assets/images/usercancled.png') }}">
                                        </a>
                                        @endif


                                    </td>
                                    <td class="text-center">

                                        @if (!$aia["user"]->is_active)
                                        <a href={{ route('activer_desactiver_admin',['id'=>$aia["user"]->id])
                                            }} data-title="activer cet
                                            admin"
                                            data-toggle="tooltip"
                                            title="activer cet admin">
                                            <i class="icofont icofont-checked icon-large"></i>
                                        </a>
                                        @else
                                        <a href={{ route('activer_desactiver_admin',['id'=>$aia["user"]->id])
                                            }} data-title="desactiver cet admin" data-toggle="tooltip"
                                            title="desactiver cet admin">
                                            <i class="icofont icofont-ui-block icon-large"></i>
                                        </a>
                                        @endif


                                        <a href="{{ route('admin.edit',['id_admin'=>$aia['admin']->id]) }}"
                                            data-title="Modifer les coordonnées de cet admin" data-toggle="tooltip"
                                            title="Modifer les coordonnées de cet admin"><i
                                                class="icofont icofont-ui-edit icon-large"></i>
                                        </a>
                                        <a href="{{ route('admin.destroy',['id_admin'=>$aia['admin']->id]) }}"
                                            data-title="supprimer" data-toggle="tooltip"
                                            data-original-title="supprimer cet admin" title="Supprimer cet admin">
                                            <i class="icofont icofont-trash icon-large"></i>
                                        </a>


                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>CIN</th>
                                    <th>Numéro de téléphone</th>
                                    <th>Adresse mail</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
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
@endpush

@endsection