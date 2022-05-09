

<?php $__env->startSection('title'); ?>Liste des administrateurs
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatable-extension.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>La liste des administrateurs</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Administration</li>
<li class="breadcrumb-item">La liste des administrateurs</li>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Les Administrateurs</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>N°CIN</th>
                                    <th>Numéro de téléphone</th>
                                    <th>Adresse mail</th>
                                    <th>Statut</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $adminIsActive; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(ucwords( $aia["admin"]->nom )); ?> <?php echo e(ucwords( $aia["admin"]->prenom)); ?></td>
                                    <td><?php echo e($aia["user"]->numero_CIN); ?></td>
                                    <td><?php echo e($aia["admin"]->numero_telephone); ?></td>
                                    <td><?php echo e($aia["admin"]->email); ?></td>
                                    <td class="text-center">
                                        <?php if( $aia["user"]->is_active): ?>
                                        <a class=" btn btn-icon-only default" href="#" data-placement="top"
                                            data-toggle="tooltip" title="admin active"><img
                                                src="<?php echo e(asset('assets/images/userActive.png')); ?>">
                                        </a>
                                        <?php else: ?>
                                        <a class=" btn btn-icon-only default" href="#" data-placement="top"
                                            data-toggle="tooltip" title="admin inactive"><img
                                                src="<?php echo e(asset('assets/images/usercancled.png')); ?>">
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('admin.edit',['id_admin'=>$aia['admin']->id])); ?>"
                                            data-title="Modifer les coordonnées de cet admin" data-toggle="tooltip"
                                            title="Modifer les coordonnées de cet admin"><i
                                                class="icofont icofont-ui-edit icon-large"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.destroy',['id_user'=>$aia['user']->id])); ?>"
                                            data-title="supprimer" data-toggle="tooltip"
                                            data-original-title="supprimer cet admin" title="Supprimer cet admin">
                                            <i class="icofont icofont-trash icon-large"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>N°CIN</th>
                                    <th>Numéro de téléphone</th>
                                    <th>Adresse mail</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
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

<script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/icons/icons-notify.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/icons/feather-icon/feather-icon-clipart.js')); ?>"></script>

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


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDeStages\resources\views/admin/administration/liste_des_admin.blade.php ENDPATH**/ ?>