

<?php $__env->startSection('title'); ?>Liste de demandes d'encadrement
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatable-extension.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>La liste de demandes d'encadrement</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Encadrement</li>
<li class="breadcrumb-item">La liste de demandes d'encadrement</li>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Les Demandes</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Etudiant</th>
                                    <th>Type de Stage</th>
                                    <th>Sujet</th>
                                    <th>Entreprise</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Confirmation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($stage->confimation_encadrant == null): ?>
                                <tr>
                                    <td><?php echo e(ucwords($stage->etudiant->nom)); ?>&nbsp; <?php echo e(ucwords($stage->etudiant->prenom)); ?>

                                    </td>
                                    <td><?php echo e($stage->etudiant->classe->typeStage->nom); ?></td>
                                    <td><?php if(isset($stage->type_sujet)): ?><?php echo e($stage->type_sujet); ?><?php endif; ?></td>
                                    <?php if(isset($stage->entreprise)): ?>
                                    <td><?php echo e($stage->entreprise->nom); ?></td>
                                    <?php else: ?>
                                        <td class="text-center">
                                            <i class="icofont icofont-exclamation-tringle" style="font-size: 1.3em"></i>
                                        </td>
                                    <?php endif; ?>
                                    <td><?php echo e($stage->date_debut); ?></td>
                                    <td><?php echo e($stage->date_fin); ?></td>
                                    <td>
                                        <div style="align-content: center">
                                            
                                            <a href="<?php echo e(route('confirmer_demande_enseignant',$stage)); ?>">
                                                <button class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                    title="confirmer la demande">
                                                    <i class="icofont icofont-ui-check"></i>
                                                </button>
                                            </a>
                                            <a href="<?php echo e(route('refuser_demande_enseignant',$stage)); ?>">
                                                <button class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                    title="refuser la demande">
                                                    <i class="icofont icofont-ui-close"></i>
                                                </button>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Etudiant</th>
                                    <th>Type de Stage</th>
                                    <th>Sujet</th>
                                    <th>Entreprise</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Confirmation</th>
                                </tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.enseignant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/enseignant/encadrement/Liste_demandes_encadrement.blade.php ENDPATH**/ ?>