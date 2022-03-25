

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
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>CIN</th>
                                    <th>Numéro de téléphone</th>
                                    <th>Adresse mail</th>
                                    <th>statut</th>
                                    <th>action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ben Foulen</td>
                                    <td>Foulen</td>
                                    <td>88888888</td>
                                    <td>66666666</td>
                                    <td>Foulen@foulen.com</td>
                                    <td>

                                        <div class="media">
                                            <a data-title="inactif" data-toggle="tooltip" title="admin inactif">
                                                <i data-feather="pause"></i></a>
                                        </div>

                                    </td>
                                    <td>


                                        <div class="media">
                                            <a href="#" data-title="désactiver" data-toggle="tooltip"
                                                title="désactiver"> <i data-feather="pause-circle"></i></a>

                                        </div>


                                        <div class="media">
                                            <a href="#" data-title="activer" data-toggle="tooltip" title="activer">
                                                <i data-feather="play-circle"></i></a>

                                        </div>
                                        <div class="media">
                                            <a href="#" data-title="supprimer" data-toggle="tooltip" title="supprimer">
                                                <i data-feather="delete"></i></a>

                                        </div>


                                    </td>
                                </tr>
                                <tr>
                                    <td>Ben Foulen</td>
                                    <td>Foulen</td>
                                    <td>88888888</td>
                                    <td>66666666</td>
                                    <td>Foulen@foulen.com</td>
                                    <td>

                                        <div class="media">
                                            <a data-title="actif" data-toggle="tooltip" title="Admin actif">
                                                <i data-feather="play"></i></a>
                                        </div>

                                    </td>

                                    <td>

                                        <div class="media">
                                            <a disabled href="#" data-title="désactiver" data-toggle="tooltip"
                                                title="désactiver"> <i data-feather="pause-circle"></i></a>

                                        </div>


                                        <div class="media">
                                            <a href="#" data-title="activer" data-toggle="tooltip" title="activer">
                                                <i data-feather="play-circle"></i></a>

                                        </div>

                                        <div class="media">
                                            <a href="#" data-title="supprimer" data-toggle="tooltip" title="supprimer">
                                                <i data-feather="delete"></i></a>

                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Ben Foulen</td>
                                    <td>Foulen</td>
                                    <td>88888888</td>
                                    <td>66666666</td>
                                    <td>Foulen@foulen.com</td>
                                    <td>

                                        <div class="media">
                                            <a data-title="inactif" data-toggle="tooltip" title="admin inactif">
                                                <i data-feather="pause"></i></a>
                                        </div>

                                    </td>
                                    <td>

                                        <div class="media">
                                            <a href="#" data-title="désactiver" data-toggle="tooltip"
                                                title="désactiver"> <i data-feather="pause-circle"></i></a>

                                        </div>


                                        <div class="media">
                                            <a href="#" data-title="activer" data-toggle="tooltip" title="activer">
                                                <i data-feather="play-circle"></i></a>

                                        </div>
                                        <div class="media">
                                            <a href="#" data-title="supprimer" data-toggle="tooltip" title="supprimer">
                                                <i data-feather="delete"></i></a>

                                        </div>

                                    </td>
                                </tr>




                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>CIN</th>
                                    <th>Numéro de téléphone</th>
                                    <th>Adresse mail</th>
                                    <th>statut</th>
                                    <th>action</th>
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\gestionDesStages\resources\views/admin/administration/liste_des_admin.blade.php ENDPATH**/ ?>