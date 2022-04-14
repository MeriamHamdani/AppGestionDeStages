

<?php $__env->startSection('title'); ?>Mes soutenances
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Mes soutenances</h3>
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
                        <h5>Mes soutenances</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Informations sur ma soutenance</th>
                                </tr>
                                </thead>

                                <tbody>

                                <tr>
                                    <td>Dai Rios</td>
                                    <td>Personnel Lead</td>
                                    <td><a class="btn btn-primary" href=<?php echo e(Route('info_soutenance')); ?>

                                            class="<?php echo e(routeActive('info_soutenance')); ?>">
                                            <i class="icofont icofont-hat-alt">
                                                Infos sur ma soutenance
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Gavin Cortez</td>
                                    <td>Team Leader</td>
                                    <td><a class="btn btn-primary" href="/depot/gerer_depot/{stage}">
                                            <i class="icofont icofont-hat-alt">
                                                Infos sur ma soutenance
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Martena Mccray</td>
                                    <td>Post-Sales support</td>
                                    <td><a class="btn btn-primary" href="/depot/gerer_depot/{stage}">
                                            <i class="icofont icofont-hat-alt">
                                                Infos sur ma soutenance
                                            </i></a></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Informations sur ma soutenance</th>
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
        <script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/icons/icons-notify.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/icons/icon-clipart.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.etudiant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\stageApp\AppGestionDeStages\resources\views/etudiant/soutenance/liste_soutenances.blade.php ENDPATH**/ ?>