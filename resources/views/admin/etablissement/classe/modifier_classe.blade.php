@extends('layouts.admin.master')

@section('title')Modifier les informations du classe
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">

@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Modifier les informations</h3>
        @endslot
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Modifier  les informations de la classe</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Modifier les informations de la classe <strong>{{$classe->nom}}</strong></h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{ route('update_classe', $classe) }}">
                            @csrf
                            @method('PATCH')
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
                                        <label class="form-label" for="exampleFormControlInput1">Code classe</label>
                                        <input class="form-control" id="code" name="code" type="text" value="{{$classe->code}}" required
                                               placeholder="entrez le code de classe..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Classe</label>
                                        <input class="form-control" id="nom" name="nom" type="text" value="{{$classe->nom}}" required
                                               placeholder="entrez le nom du classe..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                               <div class="col">
                                   <div class="mb-3">
                                       <label class="form-label" for="message-text">Niveau</label>
                                       <select class="js-example-basic-single col-sm-12" id="niveau" name="niveau" required>
                                           <option disabled="disabled" selected="selected">Séléctionnez le niveau</option>
                                           <option value="1" {{ $classe->niveau == "1" ? 'selected' : '' }}>1 ère année</option>
                                           <option value="2" {{ $classe->niveau == "2" ? 'selected' : '' }}>2 ème année</option>
                                           <option value="3" {{ $classe->niveau == "3" ? 'selected' : '' }}>3 ème année</option>
                                       </select>
                                   </div>
                               </div>
                               <div class="col">
                                   <div class="mb-3">
                                       <label class="form-label" for="message-text">Cycle/Type de formation</label>
                                       <select class="js-example-basic-single col-sm-12" id="cycle" name="cycle">
                                           <option disabled="disabled" selected="selected">Séléctionnez le cycle/type de formation</option>
                                           <option value="license" {{ $classe->cycle == "1" ? 'selected' : '' }}>Licence</option>
                                           <option value="master" {{ $classe->cycle == "2" ? 'selected' : '' }}>Mastère</option>
                                           <option value="doctorat" {{ $classe->cycle == "3" ? 'selected' : '' }}>Doctorat</option>
                                           <option value="ingeniorat" {{ $classe->cycle == "4" ? 'selected' : '' }}>Ingéniorat</option>
                                       </select>
                                   </div>
                               </div>
                           </div>
                             <div class="row align-items-center">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Spécialité</label>
                                        <select class="js-example-basic-single col-sm-12" id="specialite_id" name="specialite_id"  required>
                                            <option disabled="disabled" selected="selected">Sélectionnez la spécialité</option>
                                            @foreach(\App\Models\Specialite::all() as $specialite)
                                                <option value="{{ $specialite->id }}"
                                                    {{ old('specialite_id', $classe->specialite_id) == $specialite->id ? 'selected' : '' }}>
                                                    {{ ucwords($specialite->nom) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>--}}
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Code classe</label>
                                <input class="form-control" id="code" name="code" type="text"
                                       value="{{$classe->code}}"  required="" />
                                <div class="invalid-tooltip">Entrez le code du classe svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Classe</label>
                                <input class="form-control" id="nom" name="nom" type="text"
                                       value="{{$classe->nom}}"  required="" />
                                <div class="invalid-tooltip">Entrez le nom du classe svp!</div>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Niveau</label>
                                <select class="js-example-basic-single col-sm-12" id="niveau" name="niveau" required>
                                    <option disabled="disabled" selected="selected">Séléctionnez le niveau</option>
                                    <option value="1" {{ $classe->niveau == "1" ? 'selected' : '' }}>1 ère année</option>
                                    <option value="2" {{ $classe->niveau == "2" ? 'selected' : '' }}>2 ème année</option>
                                    <option value="3" {{ $classe->niveau == "3" ? 'selected' : '' }}>3 ème année</option>
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le niveau svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Cycle/Type de Formation</label>
                                <select class="js-example-basic-single col-sm-12" id="cycle" name="cycle">
                                    <option disabled="disabled" selected="selected">Séléctionnez le cycle/type de formation</option>
                                    <option value="license" {{ $classe->cycle == "licence" ? 'selected' : '' }}>Licence</option>
                                    <option value="master" {{ $classe->cycle == "master" ? 'selected' : '' }}>Mastère</option>
                                    <option value="doctorat" {{ $classe->cycle == "doctorat" ? 'selected' : '' }}>Doctorat</option>
                                    <option value="ingenierie" {{ $classe->cycle == "ingenierie" ? 'selected' : '' }}>Ingénierie</option>
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le cycle svp!</div>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Spécialité</label>
                                <select class="js-example-basic-single col-sm-12" id="specialite_id" name="specialite_id"  required>
                                    <option disabled="disabled" selected="selected">Sélectionnez la spécialité</option>
                                    @foreach(\App\Models\Specialite::all() as $specialite)
                                        <option value="{{ $specialite->id }}"
                                            {{ old('specialite_id', $classe->specialite_id) == $specialite->id ? 'selected' : '' }}>
                                            {{ ucwords($specialite->nom) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">Séléctionnez la spécialité svp!</div>
                            </div>

                            <div class="card-footer text-end">
                                <a class="btn btn-light" href="{{ route('liste_classes') }}">Annuler</a>
                                <button class="btn btn-primary" type="submit">Valider</button>
                            </div>
                        </form>>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
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


