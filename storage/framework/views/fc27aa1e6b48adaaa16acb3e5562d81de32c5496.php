

<?php $__env->startSection('title'); ?>Mes soutenances
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Soutenances</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Soutenance</li>
        <li class="breadcrumb-item">Mes soutenances</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Ajax Generated content for a column start-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Mes soutenances en tant que membre de jury</h5>
                    </div>
                    <div style="padding-bottom: 16px; padding-right: 30px;">
                        <!--------------------------------------------------------------------------------->

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Rôle</th>
                                    <th>Informations sur la soutenance</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <?php $__currentLoopData = $soutenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stnc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tbody>
                                    <tr>
                                        <td><?php echo e($stnc->stage->titre_sujet); ?></td>
                                        <td><?php echo e(ucwords($stnc->stage->etudiant->prenom)); ?> <?php echo e(ucwords($stnc->stage->etudiant->nom)); ?></td>
                                        <?php if($stnc->president_id==$ens->id): ?>
                                            <td>Président</td>
                                        <?php elseif($stnc->rapporteur_id==$ens->id): ?>
                                            <td>Rapporteur</td>
                                        <?php elseif($stnc->deuxieme_membre_id==$ens->id): ?>
                                            <td>Membre</td>
                                        <?php endif; ?>
                                        <td><a class="btn btn-primary" href=<?php echo e(Route('info_soutenance_membre',$stnc)); ?>

                                                class="<?php echo e(routeActive('info_soutenance_membre',$stnc)); ?>">
                                                <i class="icofont icofont-hat-alt">
                                                    Infos sur la soutenance
                                                </i></a>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(Route('telecharger_grille_evaluation',$stnc)); ?>"
                                               data-title="Télécharger la grille d'évaluation" data-toggle="tooltip"
                                               data-original-title="Télécharger la grille d'évaluation"
                                               title="Télécharger la grille d'évaluation">
                                                <i class="icofont icofont-prescription icon-large"
                                                   style="color:#bf9168 "></i></a>

                                            <?php if($stnc->president_id==$ens->id): ?>
                                                <a href="#"
                                                   data-bs-toggle="modal" data-bs-target="#<?php echo e($stnc->id); ?>"
                                                   data-whatever="@getbootstrap"> <i
                                                        class="icofont icofont-tick-mark icon-large"></i></a>
                                                <a href="#">
                                                    <div class="modal fade" id="<?php echo e($stnc->id); ?>" tabindex="-1" role="dialog"
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
                                                                <form method="POST"
                                                                      action="<?php echo e(route('evaluer_soutenance_par_president')); ?>">
                                                                    <?php echo csrf_field(); ?>
                                                                    <?php if($errors->any()): ?>
                                                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <div class="alert alert-danger"
                                                                                 role="alert">
                                                                                <?php echo e($err); ?>

                                                                            </div>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                    <div class="modal-body">
                                                                        <div class="col-md-12 position-relative">
                                                                            <label class="control-label">Note
                                                                                finale</label>
                                                                            <div class="input-group">
                                                                                <input class="touchspin" name="note"
                                                                                       id="note" type="number"
                                                                                       value="" required/>
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="col-md-12 position-relative">
                                                                            <label class="control-label">Mention</label>
                                                                            <div class="input-group">
                                                                                <input class="form-control" id="mention"
                                                                                       name="mention" type="text"
                                                                                       required
                                                                                       disabled value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <input id="stnc" name="stnc" value="<?php echo e($stnc->id); ?>" type="hidden"/>
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
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tfoot>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Rôle</th>
                                    <th>Informations sur la soutenance</th>
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


    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('assets/js/touchspin/vendors.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/touchspin/touchspin.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/touchspin/input-groups.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
        <script type="text/javascript">
            var input = document.getElementById('note');
            input.addEventListener('oninput', function(){
                console.log('oninput event ');
            }, false);
            var input2 = document.getElementById('mention');
            input.addEventListener('oninput', function(){
                console.log('oninput event ');
            }, false);
        </script>

    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.enseignant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\stageApp\AppGestionDeStages\resources\views/enseignant/soutenance/role_membre_jury.blade.php ENDPATH**/ ?>