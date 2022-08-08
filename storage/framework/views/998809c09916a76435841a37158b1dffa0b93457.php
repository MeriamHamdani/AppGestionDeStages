<?php $__env->startSection('title'); ?>Planification des soutenances
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Planification des soutenances</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Soutenance</li>
<li class="breadcrumb-item active">Planifier une soutenance</li>
<?php echo $__env->renderComponent(); ?>

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
                    <?php if($errors->any()): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo e($err); ?>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
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
                        <select class="js-example-basic-single col-sm-12" id="stage" name="stage">
                            <?php $__currentLoopData = $etudiants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value=<?php echo e($etd->stage_id); ?> ><i><?php echo e(ucwords($etd->nom)); ?>&nbsp;<?php echo e(ucwords($etd->prenom)); ?>&nbsp; :</i> <?php echo e(ucwords($etd->sujet)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div id="etudiantError" class="invalid-tooltip">Sélectionnez l'étudiant svp!</div><br>
                    </div>
                    <div class="col-md-16 position-relative">
                        <label class="form-label" for="validationTooltip01">Président de jury</label>
                        <select class="js-example-basic-single col-sm-12" id="president" name="president">
                            <?php $__currentLoopData = $enseignants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ens): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value=<?php echo e($ens->id); ?> > <?php echo e(ucwords($ens->nom)); ?>&nbsp;<?php echo e(ucwords($ens->prenom)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div id="presidentError" class="invalid-tooltip">Sélectionnez le président de jury svp!</div>
                        <br>
                    </div>
                    <div class="col-md-16 position-relative">

                        <label class="form-label" for="validationTooltip01">Rapporteur </label>
                        <select class="js-example-basic-single col-sm-12" name="rapporteur" id="rapporteur">
                            <?php $__currentLoopData = $enseignants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ens): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value=<?php echo e($ens->id); ?>><?php echo e(ucwords($ens->nom)); ?>&nbsp;<?php echo e(ucwords($ens->prenom)); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div id="rapporteurError" class="invalid-tooltip">Sélèctionnez les membres de jury svp!
                        </div>

                        <label class="form-label" for="validationTooltip01">2éme membre de jury </label>
                        <select class="js-example-basic-single col-sm-12" name="2eme_membre" id="2eme_membre">

                            <?php $__currentLoopData = $enseignants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ens): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value=<?php echo e($ens->id); ?>><?php echo e(ucwords($ens->nom)); ?>&nbsp;<?php echo e(ucwords($ens->prenom)); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div id="2eme_membreError" class="invalid-tooltip">Sélèctionnez les membres de jury svp!
                        </div>

                    </div>
                    <div id="selectionError" class="invalid-tooltip"></div>

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
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>

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

        var soutenances=<?php echo json_encode($stnc, 15, 512) ?>;

   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay',

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
            var rapporteur=$('#rapporteur').val();
            var deuxieme_membre=$('#2eme_membre').val();
            var date=moment(start).format('DD-MM-YYYY');
            var stage=$('#stage').val();

            $.ajax({
                url: "<?php echo e(route('creer_soutenance')); ?>",
                type: "POST",
                dataType: "JSON",

                data: {salle, date, heure, president, deuxieme_membre, stage, rapporteur },
                success:function(response){
                    //console.log(response);
                    if(response.error=='soutenance exist'){
                        swal("oups!", "vous avez déja programmer une soutenance pour ce stage!", "error");
                    }
                    if(response.error=='udt'){
                        swal("Echec", "Le rapporteur ne peut pas être ni le président de jury ni le 2éme membre de jury ni l'encadrant de l'étudiant", "error",{
                            button: "réessayer"
                        });
                    }
                    if(response.error=='qc'){
                        swal("Echec","Le deuxieme membre de jury ne peut pas être ni le président de jury ni l'encadrant de l'étudiant","error");
                    }
                    if(response.error=='six'){
                        swal("Echec","Le président de jury ne peut pas être l'encadrant de l'étudiant","error",{
                            button: "réessayer"
                        });
                    }

                    //console.log(response.etudiant)
                    $('#stncModal').modal('hide')
                   $('#calendar').fullCalendar('renderEvent',{
                    'title': response.title,
                    'start': response.date,
                    'end': response.date,
                    'color' : response.color
                   });
                   window.location.reload();


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
    },
    editable: true,
    eventDrop: function(event){
        var id= event.id;
        var date=moment(event.start).format('DD-MM-YYYY');
        $.ajax({

                url: "<?php echo e(route('dragNdDrop','')); ?>"+'/'+id,
                type: "PATCH",
                dataType: "JSON",
                data: {date },

                success:function(response){

                    swal("Bien!", "Soutenance mis a jour avec succée!", "success");

                },
                error:function(error){
                    console.log(error)
                }
            });
    },
    eventClick: function(event){
                    var id = event.id;
                    if(confirm('Êtes-vous sur de vouloir supprimer cette soutenance !')){
                        $.ajax({
                            url:"<?php echo e(route('supprimer_soutenance', '')); ?>" +'/'+ id,
                            type:"DELETE",
                            dataType:'json',
                            success:function(response)
                            {
                                $('#calendar').fullCalendar('removeEvents', response);
                                // swal("Good job!", "Event Deleted!", "success");
                            },
                            error:function(error)
                            {
                                console.log(error)
                            },
                        });
                    }
                },


   });
            $("#stncModal").on("hidden.bs.modal", function () {
                $('#saveBtn').unbind();
            });
  });

</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/soutenance/stnc.blade.php ENDPATH**/ ?>