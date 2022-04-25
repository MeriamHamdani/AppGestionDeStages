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
                    <form class="form theme-form" method="POST" action="{{ route('update_classe', $classe) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            @if($errors->any())
                                @foreach ($errors->all() as $err )
                                    <div class="alert alert-danger" role="alert">
                                        {{ $err }}
                                    </div>
                                @endforeach
                            @endif
                        <div class="card-body">
                            <div class="row">
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
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <input class="btn btn-light" type="reset" value="Annuler" />
                            <button class="btn btn-primary" type="submit">Valider</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Configurer le stage selon la classe</h5>
                        <div style="padding-left: 800px">
                            <a href=#>
                                <i class="text-right" aria-hidden="true">
                                    <button class="btn btn-primary" type="button"
                                            data-bs-toggle="modal" data-bs-target="#import"
                                            data-whatever="@getbootstrap">
                                        Configurer une classe
                                    </button>
                                    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Configurations d'une classe</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="message-text">Année universitaire</label>
                                                                        <select class="js-example-basic-single col-sm-12">
                                                                            <option value="0'">Séléction d'année</option>
                                                                            <option value="0">2022-2021</option>
                                                                            <option value="1">2021-2020</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="message-text">Type de stage </label>
                                                                        <select class="js-example-basic-single col-sm-12">
                                                                            <option value="0'">Séléction type de stage</option>
                                                                            <option value="0">2eme master blig</option>
                                                                            <option value="1">1ere licence volontaire</option>
                                                                            <option value="2">3eme licence info</option>
                                                                            <option value="3">2eme info oblig</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="message-text">Type de sujet</label>
                                                                        <select class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                                            <option value="0'">Séléction type de sujet</option>
                                                                            <option value="00">Aucun</option>
                                                                            <option value="0">PFE</option>
                                                                            <option value="1">BP</option>
                                                                            <option value="2">PT</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="message-text">Modèle fiche de demande</label>
                                                                        <input class="form-control" type="file" />
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="message-text">Liste des fichiers</label>
                                                                        <select class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                                            <option value="0">Attestation</option>
                                                                            <option value="1">Fiche réponse</option>
                                                                            <option value="2">Fiche plagiat</option>
                                                                            <option value="2">Fiche biblio</option>
                                                                            <option value="3">Mémoire</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Annuler</button>
                                                    <button class="btn btn-primary" type="button">Valider</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="dt-ext table-responsive">
                                <table class="display" id="auto-fill">
                                    <thead>
                                    <tr>
                                        <th>Nom classe</th>
                                        <th>Spécialité</th>
                                        <th>Type de stage</th>
                                        <th>Année universitaire</th>
                                        <th>Modèle fiche de demande</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>2 Licence Comptabilité</td>
                                        <td>Comptabilité</td>
                                        <td>2eme licence non info obligatoire</td>
                                        <td>2021-2022</td>
                                        <td>file</td>
                                        <td></td>
                                    </tr>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Nom classe</th>
                                        <th>Spécialité</th>
                                        <th>Type de stage</th>
                                        <th>Année universitaire</th>
                                        <th>Modèle fiche de demande</th>
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
    </div>


    @push('scripts')
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


