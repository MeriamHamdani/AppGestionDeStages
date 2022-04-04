@extends('layouts.etudiant.master')

@section('title')Liste des entreprises
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>La liste des entreprises</h3>
@endslot
<li class="breadcrumb-item">Entreprise</li>
<li class="breadcrumb-item">La liste des entreprises</li>
<!--<li class="breadcrumb-item active">Auto fill</li>-->
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Les Entreprises</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td>A2SOFT</td>
                                    <td>sfax rue 07 novembre , immeuble la courounne 3eme étage</td>
                                    <td>2365511</td>
                                    <td>email@gmail.com</td>
                                </tr>
                                <tr>
                                    <td>adenium</td>
                                    <td>Sakiet Ezzit Sfax</td>
                                    <td>2365511</td>
                                    <td>email@gmail.com</td>

                                </tr>
                                <tr>
                                    <td>Cabinet Anwer Abdallah-Comptable et commissaire aux comptes</td>
                                    <td>Darchaabene el fehri-nabeul</td>
                                    <td>2365511</td>
                                    <td>email@gmail.com</td>

                                </tr>
                                <tr>
                                    <td>Zouhaier Marrakchi Consulting</td>
                                    <td>Avenue Sidi Lakhmi, Résidence El Ferdows, Mezzanine, Bureau n° 3 Sfax el Jadida
                                        3027 BP 45 3027 Sfax, Tunisie</td>
                                    <td>2365511</td>
                                    <td>email@gmail.com</td>

                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
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
@endpush

@endsection

