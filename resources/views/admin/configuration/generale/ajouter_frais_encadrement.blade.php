@extends('layouts.admin.master')

@section('title')Ajouter frais d'encadrement
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Ajouter frais d'encadrement</h3>
        @endslot
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item">Ajouter un frais d'encadrement</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ajouter un frais d'encadrement</h5>
                    </div>
                    <div>@foreach ($errors as $err)
                            <div>{{ $err }}</div>
                        @endforeach


                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate="" method="POST"
                              action="{{route('sauvegarder_frais')}}">
                            @csrf
                            @if($errors->any())
                                @foreach ($errors->all() as $err )
                                    <div class="alert alert-danger" role="alert">
                                        {{ $err }}
                                    </div>
                                @endforeach
                            @endif
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Grade</label>
                                <select class="js-example-basic-single col-sm-12" id="grade" name="grade"
                                        value="{{old('grade')}}" required>
                                    <option disabled="disabled" selected="selected">Sélectionnez le grade
                                    </option>
                                    <option
                                        value="maître assistant" {{ old('grade') == "maitre assistant" ? 'selected' : '' }}>
                                        Maître assistant
                                    </option>
                                    <option
                                        value="maître de conférence" {{ old('grade') == "maitre de conférence" ? 'selected' : '' }}>
                                        Maître de conférence
                                    </option>
                                    <option
                                        value="professeur" {{ old('grade') == "professeur" ? 'selected' : '' }}>
                                        Professeur
                                    </option>
                                    <option
                                        value="assistant" {{ old('grade') == "assistant" ? 'selected' : '' }}>
                                        Assistant
                                    </option>
                                    <option
                                        value="expert" {{ old('grade') == "expert" ? 'selected' : '' }}>
                                        Expert
                                    </option>
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le grade svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Cycle/Type de Formation</label>
                                <select class="js-example-basic-single col-sm-12" id="cycle" name="cycle"
                                        value="{{old('cycle')}}" required>
                                    <option disabled="disabled" selected="selected">Sélectionnez le type de formation
                                    </option>
                                    <option value="licence" {{ old('cycle')=="licence" ? 'selected' : '' }}>
                                        Licence
                                    </option>
                                    <option value="master" {{ old('cycle')=="master" ? 'selected' : '' }}>
                                        Mastère
                                    </option>
                                    <option value="doctorat" {{ old('cycle')=="doctorat" ? 'selected' : '' }}>
                                        Doctorat
                                    </option>
                                    <option value="ingenierie" {{ old('cycle')=="ingeniorat" ? 'selected' : '' }}>
                                        Ingénierie
                                    </option>
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le cycle svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Frais d'encadrement en DT</label>
                                <input class="form-control" id="frais" name="frais" type="text" value="{{old('frais')}}"
                                       required="" placeholder="Entrez le frais d'encadrement....." />
                                <div class="invalid-tooltip">Entrez le frais d'encadrement svp!</div>
                            </div>
                            <div class="card-footer text-end">
                                <a class="btn btn-light" href="{{route('frais_encadrement')}}">Annuler</a>
                                <button class="btn btn-primary" type="submit">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
                integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
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


    @endpush

@endsection
