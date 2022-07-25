@extends('layouts.admin.master')

@section('title')Ajouter Enseignant
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Ajouter un enseignant</h3>
@endslot
<li class="breadcrumb-item">Administration</li>
<li class="breadcrumb-item">Ajouter un enseignant</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Ajouter un enseignant</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3 needs-validation" novalidate="" method="POST"
                        action="{{ route('sauvegarder_enseignant') }}">
                        @csrf
                        @if($errors->any())
                        @foreach ($errors->all() as $err )
                        <div class="alert alert-danger" role="alert">
                            {{ $err }}
                        </div>
                        @endforeach
                        @endif

                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Numero CIN</label>
                            <input class="form-control" id="numero_CIN" name="numero_CIN" type="number"
                                value="{{old('numero_CIN')}}" required="" placeholder="entrez le num cin..." />
                            <div class="invalid-tooltip">Entrez le N°CIN svp!</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Nom</label>
                            <input class="form-control" id="nom" name="nom" type="text" value="{{old('nom')}}"
                                required="" placeholder="entrez le nom de l'enseignant..." />
                            <div class="invalid-tooltip">Entrez le nom svp!</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Prénom</label>
                            <input class="form-control" id="prenom" name="prenom" type="text" value="{{old('prenom')}}"
                                required="" placeholder="entrez le prénom de l'enseignant..." />
                            <div class="invalid-tooltip">Entrez le prénom svp!</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Numero de téléphone</label>
                            <input class="form-control" id="numero_telephone" name="numero_telephone" type="number"
                                value="{{old('numero_telephone')}}" required=""
                                placeholder="entrez le numéro de téléphone..." />
                            <div class="invalid-tooltip">Entrez le N° de téléphone svp!</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Email</label>
                            <input class="form-control" id="email" name="email" type="email" value="{{old('email')}}"
                                required="" placeholder="entrez l'email de l'enseignant..." />
                            <div class="invalid-tooltip">Entrez l'email svp!</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Grade</label>
                            <select class="js-example-basic-single col-sm-12" id="grade" name="grade"
                                value="{{old('grade')}}" required>
                                <option disabled="disabled" selected="selected">Sélectionnez le grade
                                </option>
                                <option value="maître assistant" {{ old('grade')=="maitre assistant" ? 'selected' : ''
                                    }}>
                                    Maître assistant
                                </option>
                                <option value="maître de conférence" {{ old('grade')=="maitre de conférence"
                                    ? 'selected' : '' }}>
                                    Maître de conférence
                                </option>
                                <option value="professeur" {{ old('grade')=="professeur" ? 'selected' : '' }}>
                                    Professeur
                                </option>
                                <option value="assistant" {{ old('grade')=="assistant" ? 'selected' : '' }}>
                                    Assistant
                                </option>
                                <option value="expert" {{ old('grade')=="expert" ? 'selected' : '' }}>
                                    Expert
                                </option>
                            </select>
                            <div class="invalid-tooltip">Séléctionnez le grade svp!</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Département</label>
                            <select class="js-example-basic-single col-sm-12" id="departement_id" name="departement_id"
                                required>
                                <option disabled="disabled" selected="selected">Sélectionnez le
                                    département
                                </option>
                                @foreach (\App\Models\Departement::all() as $departement)
                                <option value="{{ $departement->id }}" {{ old('departement_id')==$departement->id ?
                                    'selected' : '' }}
                                    >{{ ucwords($departement->nom) }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">Séléctionnez le Département svp!</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">RIB</label>
                            <input class="form-control" id="rib" name="rib" type="number" value="{{old('rib')}}"
                                required="" placeholder="entrez le RIB..." />
                            <div class="invalid-tooltip">Entrez le RIB svp!</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Identifiant</label>
                            <input class="form-control" id="identifiant" name="identifiant" type="number"
                                value="{{old('identifiant')}}" required="" placeholder="entrez l'identifiant..." />
                            <div class="invalid-tooltip">Entrez l'identifiant svp!</div>
                        </div>

                        <div class="card-footer text-end">
                            <a class="btn btn-light" href="{{ route('liste_enseignants') }}">Annuler</a>
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
        <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>

        @if(Session::has('message'))
        <script>
            toastr.success("{!! Session::get('message') !!}")
        </script>
        @endif
        @if(Session::has('message'))
        <script>
            swal('Bien', Session::get('message'), {
                //button: 'Continuer',
                showConfirmButton: false,
                timer: 2500
            })

        </script>
        @endif
        @endpush

        @endsection