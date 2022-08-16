@extends('layouts.admin.master')

@section('title')Ajouter classe
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
<h3>Ajouter une classe</h3>
@endslot
<li class="breadcrumb-item">Etablissement</li>
<li class="breadcrumb-item">Gestion des classes</li>
<li class="breadcrumb-item">Gérer les classes</li>
<li class="breadcrumb-item">Ajouter une classe</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <!--<div class="card-header pb-0">
                    <h5>Ajouter une classe</h5>
                </div>-->
                <div>@foreach ($errors as $err)
                    <div>{{ $err }}</div>
                    @endforeach


                </div>
                <div class="card-body">
                    <form class="row g-3 needs-validation" novalidate="" method="POST"
                        action="{{ route('sauvegarder_classe') }}">
                        @csrf
                        @if($errors->any())
                        @foreach ($errors->all() as $err )
                        <div class="alert alert-danger" role="alert">
                            {{ $err }}
                        </div>
                        @endforeach
                        @endif
                        {{--<div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="message-text">Code classe </label>
                                    <input class="form-control" id="code" name="code" type="text"
                                        placeholder="entrez le code de la classe..." />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="message-text">Nom classe </label>
                                    <input class="form-control" id="nom" name="nom" type="text"
                                        placeholder="entrez le nom de la classe..." />
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="message-text">Niveau</label>
                                    <select class="js-example-basic-single col-sm-12" id="niveau" name="niveau"
                                        required>
                                        <option disabled="disabled" selected="selected">Séléctionnez le niveau
                                        </option>
                                        <option value="1">1 ère année</option>
                                        <option value="2">2 ème année</option>
                                        <option value="3">3 ème année</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="message-text">Cycle/Type de formation</label>
                                    <select class="js-example-basic-single col-sm-12" id="cycle" name="cycle">
                                        <option disabled="disabled" selected="selected">Séléctionnez le cycle/type
                                            de
                                            formation
                                        </option>
                                        <option value="1">Licence</option>
                                        <option value="2">Mastère</option>
                                        <option value="3">Doctorat</option>
                                        <option value="4">Ingénieurie</option>
                                    </select>
                                </div>
                            </div>
                        </div>--}}
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Niveau</label>
                            <select class="js-example-basic-single col-sm-12" id="niveau" name="niveau"
                                value="{{old('niveau')}}" required>
                                <option disabled="disabled" selected="selected">Sélectionnez le niveau
                                </option>
                                <option value="1" {{ old('niveau')=="1" ? 'selected' : '' }}>
                                    1 ère année
                                </option>
                                <option value="2" {{ old('niveau')=="2" ? 'selected' : '' }}>
                                    2 ème année
                                </option>
                                <option value="3" {{ old('niveau')=="3" ? 'selected' : '' }}>
                                    3 ème année
                                </option>
                            </select>
                            <div class="invalid-tooltip">Séléctionnez le niveau svp!</div>
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
                            <label class="form-label" for="validationTooltip01">Spécialité</label>
                            <select class="js-example-basic-single col-sm-12" id="specialite_id" name="specialite_id"
                                required>
                                <option disabled="disabled" selected="selected">Sélectionnez la spécialité
                                </option>
                                @foreach (\App\Models\Specialite::all() as $specialite)
                                <option value="{{ $specialite->id }}" {{ old('specialite_id')==$specialite->id ?
                                    'selected' : '' }}
                                    >{{ ucwords($specialite->nom) }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">Séléctionnez la spécialité svp!</div>
                        </div>
                        <!--<div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Code classe</label>
                            <input class="form-control" id="code" name="code" type="text" value="{{old('code')}}"
                                required="" placeholder="entrez le code du classe....." />
                            <div class="invalid-tooltip">Entrez le code du classe svp!</div>
                        </div>-->
                        <div class="card-footer text-end">
                            <a class="btn btn-light" href="{{ route('liste_classes') }}">Annuler</a>
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
@if(Session::has('message'))
<script>
    toastr.success("{!! Session::get('message') !!}")
</script>
@endif
@if(Session::has('message'))
@if (Session::get('message')=='notMatchCycle')
<script>
    swal('Oups', 'La spécialite '.Session::get('sp').' ne peut pas etre attribuée au cycle '.Session::get('cycle'), 'error', {
                            button: 'Reéssayer'
                        })
</script>
{{ Session::forget('message') }}
@endif
@endif

@endpush

@endsection

