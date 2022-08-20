@extends('layouts.etudiant.master')

@section('title')Dépôser mon mémoire
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Dépôser mon mémoire</h3>
        @endslot
        <li class="breadcrumb-item">Dépôt</li>
        <li class="breadcrumb-item active">Dépôt du mémoire</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Redépôser mon mémoire</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('update_depot',$depotMemoire)}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            @if($errors->any())
                                @foreach ($errors->all() as $err )
                                    <div class="alert alert-danger" role="alert">
                                        {{ $err }}
                                    </div>
                                @endforeach
                            @endif
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3 row">
                                                        <label class="col-sm-3 col-form-label">Le mémoire</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" type="file" name="memoire" id="memoire" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-secondary pull-right" type="submit">Terminer!</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script src="{{asset('assets/js/form-wizard/form-wizard-two.js')}}"></script>
    @endpush

@endsection

