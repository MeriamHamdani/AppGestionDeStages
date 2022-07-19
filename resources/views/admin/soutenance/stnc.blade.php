@extends('layouts.admin.master')

@section('title')Planification des soutenances
{{ $title }}
@endsection

@push('css')
<!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Planification des soutenances</h3>
@endslot
<li class="breadcrumb-item">Soutenance</li>
<li class="breadcrumb-item active">Planifier une soutenance</li>
@endcomponent

<!-- Modal -->

<div class="modal fade" id="stncModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Planifier une nouvelle soutenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" novalidate="">
                    @if($errors->any())
                    @foreach ($errors->all() as $err )
                    <div class="alert alert-danger" role="alert">
                        {{ $err }}
                    </div>
                    @endforeach
                    @endif
                    <div class="col-md-16 position-relative">
                        <label class="form-label" for="validationTooltip01">Heure</label>
                        <input class="form-control" id="heure" type="time" required>
                        <div id="heurError" class="invalid-tooltip">Entrez l'heure de soutenance svp!</div>
                    </div>
                    <div class="col-md-16 position-relative">
                        <label class="form-label" for="validationTooltip01">Salle</label>
                        <input class="form-control" type="text" id="salle" required>
                        <span id="salleError" class="text-danger"></span>
                        <div id="salleError" class="invalid-tooltip">Entrez la salle svp !</div><br>
                    </div>
                    <div class="col-md-16 position-relative">
                        <label class="form-label" for="validationTooltip01">Etudiant</label>
                        <select class="js-example-basic-single col-sm-12">
                            @foreach ($etudiants as $etd )
                            <option value={{ $etd->stage_id }} id="stage">{{ ucwords($etd->nom) }}&nbsp;{{
                                ucwords($etd->prenom) }}</option>
                            @endforeach
                        </select>
                        <div id="etudiantError" class="invalid-tooltip">Sélectionnez l'étudiant svp!</div><br>
                    </div>
                    <div class="col-md-16 position-relative">
                        <label class="form-label" for="validationTooltip01">Président de jury</label>
                        <select class="js-example-basic-single col-sm-12" id="president" name="president">
                            @foreach ($enseignants as $ens )
                            <option value={{ $ens->id }} > {{ ucwords($ens->nom) }}&nbsp;{{
                                ucwords($ens->prenom) }}</option>
                            @endforeach
                        </select>
                        <div id="presidentError" class="invalid-tooltip">Sélectionnez le président de jury svp!</div>
                        <br>
                    </div>
                    <div class="col-md-16 position-relative">
                        <label class="form-label" for="validationTooltip01">Membres de jury </label>
                        <select class="js-example-basic-single col-sm-12" name="mbrJury" id="mbrJury" multiple>

                            @foreach ($enseignants as $ens )
                            <option value={{ $ens->id }}>{{ ucwords($ens->nom) }}&nbsp;{{ ucwords($ens->prenom) }}
                            </option>
                            @endforeach
                        </select>
                        <div id="mbrJuryError" class="invalid-tooltip">Sélèctionnez les membres de jury svp!</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" id="saveBtn" class="btn btn-primary">Planifier</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="response"></div>
    <div id='calendar'></div>
</div>
@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var soutenances=@json($stnc);

   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: soutenances,
    selectable: true,
    selectHelper: true,
    select: function(start, end, allDays) {
        $('#stncModal').modal('toggle');

        $('#saveBtn').click(function(){
            var salle= $('#salle').val();
            var heure =$('#heure').val();
            var president =$('#president').val();
            var membresJury =$('#mbrJury').val();
            var date=moment(start).format('DD-MM-YYYY');
            var stage=$('#stage').val();

            /*console.log(typeof(heure));
            console.log(typeof(salle));
            console.log(typeof(membreJury));
            console.log(typeof(stage));
            console.log(typeof(date));*/
            //console.log(typeof(president));

            $.ajax({
                url: "{{ route('creer_soutenance') }}",
                type: "POST",
                dataType: "JSON",

                data: {salle, date, heure, president, membresJury, stage, },
                success:function(response){

                    //console.log(response.etudiant)
                    $('#stncModal').modal('hide')
                   $('#calendar').fullCalendar('renderEvent',{
                    'title': response.start_time + " - " +response.etudiant,
                    'start': response.date,
                    'end': response.date
                   });
                },
                error:function(error){
                    if(error.responseJSON.errors){
                        $("#salleError").html(error.responseJSON.errors.salle);
                        $("#heureError").html(error.responseJSON.errors.heure);
                        $("#presidentError").html(error.responseJSON.errors.president);


                    }
                }
            });
        });
    }

   });
  });

</script>
@endpush

@endsection

