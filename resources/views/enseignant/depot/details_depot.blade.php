@extends('layouts.enseignant.master')

@section('title')Décision sur le dépôt
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/scrollable.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/timepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/photoswipe.css')}}">

@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Mettre votre décision sur le dépôt de
    : {{ ucwords($demande_depot->stage->etudiant->prenom) }} {{ ucwords($demande_depot->stage->etudiant->nom) }}</h3>
@endslot
<li class="breadcrumb-item">Enacdrement</li>
<li class="breadcrumb-item active">Mettre votre décision le dépôt</li>
@endcomponent
<div class="container-fluid">
    <div class="user-profile social-app-profile">
        <div class="col-md-8 col-sm-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5>
                        Mettre votre décision sur le dépôt de:
                        <strong> {{ ucwords($demande_depot->stage->etudiant->prenom) }} {{
                            ucwords($demande_depot->stage->etudiant->nom) }}</strong>
                    </h5>
                </div>
                <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2" data-parent="#accordion">

                    <div class="card-body filter-cards-view">
                        <div class="filter-view-group">
                            @foreach($commentaires as $commentaire)

                            <span class="f-w-600" style="color: #2b786a">{{ucwords($commentaire->enseignant->prenom)}}
                                {{ucwords($commentaire->enseignant->nom)}} </span>
                            <p style="color: #0c0c0c">
                                {{$commentaire->contenu}}
                            </p>
                            <p class="f-w-600"> {{$commentaire->created_at}}</p> <br>
                            @endforeach
                        </div>
                        <div class="form theme-form">
                            <div class="row">
                                <div class="col">
                                    <div class="text-end">
                                        <a class="btn btn-success me-3"
                                            href="{{ route('valider_depot',$demande_depot) }}">Valider le mémoire</a>
                                        <a class="btn btn-danger" onclick="toggleText()">Mettre à jour le mémoire
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('refuser_depot',$demande_depot) }}">
                                @csrf
                                <div class="row" id="commentField" style="display:none">
                                    <div class="col">
                                        <div class="mb-3">
                                            <br>
                                            <label style="color: #d22d3d">Ajoutez un commentaire en cas de refus de
                                                mémoire</label>
                                            <textarea class="form-control" rows="3"
                                                placeholder="écrivez vos remarques ici..." required id="contenu"
                                                name="contenu"></textarea>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <button class="btn btn-secondary me-3" type="submit">Envoyer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    function toggleText() {
                var x = document.getElementById("commentField");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
</script>
@if(Session::has('message'))
@if (Session::get('message')=='deja validé')

<script>
    swal('Erreur', "Vous avez déjà validé le mémoire!", 'error', {
                        button: 'Ok'
                    })

</script>
@endif
@endif
@endpush

@endsection

