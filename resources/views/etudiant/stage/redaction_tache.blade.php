@extends('layouts.etudiant.master')

@section('title')tache
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/summernote.css')}}">
@endpush

@section('content')
@component('components.breadcrumb')
@endcomponent




<div class="container-fluid summer-note">
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action={{ route('rediger',['tache'=>$tache]) }}>
                @csrf
                <div class="card">

                    <div class="card-header pb-0">
                        <h6><span style="float: right">{{ $tache->date }}</span></h6>
                        <h6>Titre de tache </h6>
                        <input class="form-control" id="titre" name="titre" type="text" value={{ $tache->titre }}>
                        <hr>
                        <h6>Déscription de tache </h6>
                    </div>
                    <div class="card-body">
                        <textarea class="summernote" name="contenu">{!! $tache->contenu !!} </textarea>
                        <button class="btn btn-primary" type="submit">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script src="{{asset('assets/js/jquery.ui.min.js')}}"></script>
<script src="{{asset('assets/js/editor/summernote/summernote.js')}}"></script>
<script src="{{asset('assets/js/editor/summernote/summernote.custom.js')}}"></script>
<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
@endpush

@endsection

