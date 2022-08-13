

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
                        <h5>Mes soutenances en tant qu'Encadrant</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Informations sur la soutenance</th>
                                </tr>
                                </thead>
                                <?php $__currentLoopData = $soutenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stnc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tbody>
                                    <tr>
                                        <td><?php echo e($stnc->stage->titre_sujet); ?></td>
                                        <td><?php echo e(ucwords($stnc->stage->etudiant->prenom)); ?> <?php echo e(ucwords($stnc->stage->etudiant->nom)); ?></td>
                                        <td><a class="btn btn-primary" href=<?php echo e(Route('info_soutenance_ens',$stnc)); ?>

                                                class="<?php echo e(routeActive('info_soutenance_ens')); ?>">
                                                <i class="icofont icofont-hat-alt">
                                                    Infos sur la soutenance
                                                </i></a></td>
                                    </tr>
                                    </tbody>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tfoot>
                                    <tr>
                                        <th>Titre de sujet</th>
                                        <th>Etudiant</th>
                                        <th>Informations sur la soutenance</th>
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
        <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.enseignant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\stageApp\AppGestionDeStages\resources\views/enseignant/soutenance/role_encadrant.blade.php ENDPATH**/ ?>