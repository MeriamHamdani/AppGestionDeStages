@extends('layouts.etudiant.master')

@section('title')Cahier de stage
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Cahiers de stage</h3>
@endslot
<li class="breadcrumb-item">Stage</li>
<li class="breadcrumb-item">Gérer le cahier de stage</li>
@endcomponent
<div class="container-fluid">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Stages & Cahier de stage</h5>
                    <span>Ce tableau illustre la liste des stages avec chacun son cahier de stage s'il existe </span>
                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type de stage</th>
                                    <th>Cahier de stage</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($cahiers_stage as $cs)
                                <tr>
                                    <td> {{ $cs->stage->titre_sujet }} </td>
                                    <td>{{App\Models\TypeStage::findOrFail($cs->stage->type_stage_id)->nom }}</td>
                                    <td><a class="btn btn-primary" href={{
                                            route('nouvelle_cahier_stage',['stage'=>$cs->stage]) }}>
                                            <i class="icofont icofont-book-alt">
                                                Cahier de stage
                                            </i></a></td>
                                </tr>
                                @endforeach




                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type de stage</th>
                                    <th>Cahier de stage</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
</div>


@push('scripts')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@endpush

@endsection

