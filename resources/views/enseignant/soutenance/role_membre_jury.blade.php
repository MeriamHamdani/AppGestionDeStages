@extends('layouts.enseignant.master')

@section('title')Les soutenances
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Soutenances</h3>
        @endslot
        <li class="breadcrumb-item">Soutenance</li>
        <li class="breadcrumb-item">Les soutenances</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <!-- Ajax Generated content for a column start-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Les soutenances en tant que membre de jury</h5>
                    </div>
                    <div style="padding-bottom: 16px; padding-right: 30px;">
                        <!--------------------------------------------------------------------------------->
                        @if($errors->any())
                            @foreach ($errors->all() as $err )
                                <div class="alert alert-danger"
                                     role="alert">
                                    {{ $err }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Rôle</th>
                                    <th>Date</th>
                                    <th>Salle</th>
                                    <th>Plus de détails sur la soutenance</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                @foreach($soutenances as $stnc)
                                    <tbody>
                                    <tr>
                                        <td>{{$stnc->stage->titre_sujet}}</td>
                                        <td>{{ucwords($stnc->stage->etudiant->prenom)}} {{ucwords($stnc->stage->etudiant->nom)}}</td>
                                        @if($stnc->president_id==$ens->id)
                                            <td>Président</td>
                                        @elseif($stnc->rapporteur_id==$ens->id)
                                            <td>Rapporteur</td>
                                        @elseif($stnc->deuxieme_membre_id==$ens->id)
                                            <td>Membre</td>
                                        @endif
                                        <td>{{Arr::first((App\Http\Controllers\TypeStageController::decouper_nom($stnc->date)))}} à {{$stnc->start_time}}</td>
                                        <td>{{$stnc->salle}}</td>
                                        <td><a class="btn btn-primary" href={{ Route('info_soutenance_membre',$stnc) }}
                                                class="{{ routeActive('info_soutenance_membre') }}">
                                                <i class="icofont icofont-hat-alt">
                                                    Infos sur la soutenance
                                                </i></a>
                                        </td>
                                        <td>
                                            <a href="{{ Route('telecharger_grille_evaluation',$stnc) }}"
                                               data-title="Télécharger la grille d'évaluation" data-toggle="tooltip"
                                               data-original-title="Télécharger la grille d'évaluation"
                                               title="Télécharger la grille d'évaluation">
                                                <i class="icofont icofont-prescription icon-large"
                                                   style="color:#bf9168 "></i></a>
                                            @if(isset($stnc->stage->depotMemoire->memoire))
                                            <a href="{{route('telecharger_memoire_soutenance',['memoire'=>Str::afterLast($stnc->stage->depotMemoire->memoire,'/'),
                                                                                'code_classe'=>$stnc->stage->etudiant->classe->code,'stage'=>$stnc->stage])}}"
                                               data-title="Télécharger le memoire" data-toggle="tooltip"
                                               data-original-title="Télécharger le mémoire"
                                               title="Télécharger le mémoire">
                                                <i class="icofont icofont-papers icon-large"
                                                   style="color:#bf9168 "></i></a>
                                            @endif
                                            @if($stnc->president_id==$ens->id && $stnc->note == null)
                                                <a href="#"
                                                   data-bs-toggle="modal" data-bs-target="#{{$stnc->id}}"
                                                   data-whatever="@getbootstrap"> <i
                                                        class="icofont icofont-tick-mark icon-large"></i></a>
                                                <a href="#">
                                                    <div class="modal fade" id="{{$stnc->id}}" tabindex="-1"
                                                         role="dialog"
                                                         aria-labelledby="exampleModalLabel" style="display: none;"
                                                         aria-hidden="true">

                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Evaluer la soutenance (Note
                                                                        et
                                                                        mention)</h5>
                                                                    <button class="btn-close" type="button"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Fermez"></button>
                                                                </div>
                                                                <script type="text/javascript">
                                                                    function assignMention(value) {
                                                                        var a = (Math.round(parseFloat(value)*10000000)/10000000);
                                                                        console.log(typeof a,a );
                                                                        if (a == null ) {
                                                                            document.getElementById('mention').value = "";
                                                                        }
                                                                        else if (a >= 0  && a < 10) {
                                                                            document.getElementById('mention').value = "Refusé";
                                                                            @php(request()->mention = "Refusé")
                                                                        } else if (a >= 10 && a < 12) {
                                                                            document.getElementById('mention').value = "Passable";
                                                                        } else if (a >= 12 && a < 14) {
                                                                            document.getElementById('mention').value = "Assez-Bien";
                                                                        } else if (a >= 14 && a < 16) {
                                                                            document.getElementById('mention').value = "Bien";
                                                                        } else if (a >= 16 && a < 18) {
                                                                            document.getElementById('mention').value = "Très Bien";
                                                                        } else if (a >= 18 && a <= 20) {
                                                                            document.getElementById('mention').value = "Excellent";
                                                                        } else if (a > 20 ) {
                                                                            document.getElementById('mention').value = "";
                                                                        }
                                                                    }
                                                                </script>
                                                                <form method="POST"
                                                                      action="{{route('evaluer_soutenance_par_president')}}">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="col-md-12 position-relative">
                                                                            <label class="control-label">Note
                                                                                finale</label>
                                                                            <div class="input-group">
                                                                                <input class="form-control" name="note"
                                                                                       id="note" required
                                                                                       onkeyup="assignMention(this.value);"/>
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="col-md-12 position-relative">
                                                                            <label class="control-label">Mention</label>
                                                                            <div class="input-group">
                                                                                <input class="form-control" id="mention"
                                                                                       name="mention" type="text"
                                                                                       disabled />
                                                                            </div>
                                                                        </div>
                                                                        <input id="stnc" name="stnc"
                                                                               value="{{$stnc->id}}" type="hidden"/>
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <button class="btn btn-secondary" type="button"
                                                                                data-bs-dismiss="modal">Annuler
                                                                        </button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Soumettre
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Rôle</th>
                                    <th>Date</th>
                                    <th>Salle</th>
                                    <th>Plus de détails sur la soutenance</th>
                                    <th>Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ajax Generated content for a column end-->
        </div>
    </div>


    @push('scripts')
        <script src="{{ asset('assets/js/touchspin/vendors.min.js') }}"></script>
        <script src="{{ asset('assets/js/touchspin/touchspin.js') }}"></script>
        <script src="{{ asset('assets/js/touchspin/input-groups.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>

    @endpush

@endsection
