

<?php $__env->startSection('title'); ?>Liste des stages actifs
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatable-extension.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>La liste des stages actifs</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Encadrement</li>
<li class="breadcrumb-item">La liste des stages actifs</li>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Les Stages Actifs</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Etudiant</th>
                                    <th>Type de Stage</th>
                                    <th>Sujet</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Zouhour Ben Ticha</td>
                                    <td>LF3I obligatoire</td>
                                    <td>Application de gestion des stages </td>
                                    <td>01-02-2022</td>
                                    <td>31-05-2022</td>
                                    <td>
                                        <a href="#" data-title="Télécharger la lettre d'affectation" data-toggle="tooltip" data-original-title="Télécharger la lettre d'affectation" title="Télécharger la lettre d'affectation">
                                            <i class="icofont icofont-file-document icon-large" style="color:#bf9168 "></i></a>
                                        <a data-title="Consulter les détails de stage" data-toggle="tooltip" data-original-title="Consulter les détails de stage" title="Consulter les détails de stage"
                                           href=<?php echo e(route('details_stage')); ?>>
                                            <i class="icofont icofont-info-square icon-large"></i></a>
                                        <a data-title="Consulter le cahier de stage" data-toggle="tooltip"  title="Consulter le cahier de stage"
                                           href=<?php echo e(route('cahier_stage_etud')); ?>>
                                            <i class="icofont icofont-book-alt icon-large" style="color:#fd2e64"></i></a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>Meriam Hamdani</td>
                                    <td>LF3I obligatoire</td>
                                    <td>Application de gestion des stages </td>
                                    <td>01-02-2022</td>
                                    <td>31-05-2022</td>
                                    <td>
                                        <a href="#" data-title="Télécharger la lettre d'affectation" data-toggle="tooltip" data-original-title="Télécharger la lettre d'affectation" title="Télécharger la lettre d'affectation">
                                            <i class="icofont icofont-file-document icon-large" style="color:#bf9168 "></i></a>
                                        <a data-title="Consulter les détails de stage icon-large" data-toggle="tooltip" data-original-title="Consulter les détails de stage" title="Consulter les détails de stage"
                                           href=<?php echo e(route('details_stage')); ?>>
                                            <i class="icofont icofont-info-square icon-large"></i></a>
                                        <a class="<?php echo e(routeActive('liste_stages_actifs')); ?>" data-title="Consulter le cahier de stage" data-toggle="tooltip"  title="Consulter le cahier de stage"
                                           href=<?php echo e(route('cahier_stage_etud')); ?> >
                                            <i class="icofont icofont-book-alt icon-large" style="color:#fd2e64"></i></a>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Ali Ben Ali</td>
                                    <td>LF3I obligatoire</td>
                                    <td>Application de gestion des stages </td>
                                    <td>01-02-2022</td>
                                    <td>31-05-2022</td>
                                    <td>
                                        <a href="#" data-title="Télécharger la lettre d'affectation" data-toggle="tooltip" data-original-title="Télécharger la lettre d'affectation" title="Télécharger la lettre d'affectation">
                                            <i class="icofont icofont-file-document icon-large" style="color:#bf9168 "></i></a>
                                        <a data-title="Consulter les détails de stage" data-toggle="tooltip" data-original-title="Consulter les détails de stage" title="Consulter les détails de stage"
                                           href=<?php echo e(route('details_stage')); ?>>
                                            <i class="icofont icofont-info-square icon-large"></i></a>
                                        <a class="<?php echo e(routeActive('liste_stages_actifs')); ?>" data-title="Consulter le cahier de stage" data-toggle="tooltip"  title="Consulter le cahier de stage"
                                           href=<?php echo e(route('cahier_stage_etud')); ?> >
                                            <i class="icofont icofont-book-alt icon-large" style="color:#fd2e64"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Etudiant</th>
                                    <th>Type de Stage</th>
                                    <th>Sujet</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
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
<script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/icons/icons-notify.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/icons/flag-icon-clipart.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/icons/icons-notify.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/icons/icon-clipart.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.enseignant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\stageApp\AppGestionDeStages\resources\views/enseignant/encadrement/Liste_stages_actifs.blade.php ENDPATH**/ ?>