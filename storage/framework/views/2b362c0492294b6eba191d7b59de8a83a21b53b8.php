<?php $__env->startSection('title'); ?>Cahier de stage
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Cahiers de stage</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Stage</li>
<li class="breadcrumb-item">Gérer le cahier de stage</li>
<?php echo $__env->renderComponent(); ?>
<div class="container-fluid">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Stages & Cahier de stage</h5>
                    <span>Ce tableau illustre la liste des stages avec chacun son cahier de stage s'il existe </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Cahier de stage</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td> sujet abc </td>
                                    <td>Type pfe_oblig_volont</td>
                                    <td><a class="btn btn-primary" href="/stage/cahiers_de_stage/{cahier}">
                                            <i class="icofont icofont-book-alt">
                                                Cahier de stage
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Bradley Greer</td>
                                    <td>Software Engineer</td>
                                    <td><a class="btn btn-primary" <?php echo e(prefixActive('etudiant/stage')); ?>

                                            href="<?php echo e(route('cahier_stage')); ?>" class="<?php echo e(routeActive('cahier_stage')); ?>">
                                            <i class="icofont icofont-book-alt">
                                                Cahier de stage
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Dai Rios</td>
                                    <td>Personnel Lead</td>
                                    <td><a class="btn btn-primary" <?php echo e(prefixActive('etudiant/stage')); ?>

                                            href="<?php echo e(route('cahier_stage')); ?>" class="<?php echo e(routeActive('cahier_stage')); ?>">
                                            <i class="icofont icofont-book-alt">
                                                Cahier de stage
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Jenette Caldwell</td>
                                    <td>Development Lead</td>
                                    <td><a class="btn btn-primary" <?php echo e(prefixActive('etudiant/stage')); ?>

                                            href="<?php echo e(route('cahier_stage')); ?>" class="<?php echo e(routeActive('cahier_stage')); ?>">
                                            <i class="icofont icofont-book-alt">
                                                Cahier de stage
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Yuri Berry</td>
                                    <td>Chief Marketing Officer (CMO)</td>
                                    <td><a class="btn btn-primary" <?php echo e(prefixActive('etudiant/stage')); ?>

                                            href="<?php echo e(route('cahier_stage')); ?>" class="<?php echo e(routeActive('cahier_stage')); ?>">
                                            <i class="icofont icofont-book-alt">
                                                Cahier de stage
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Caesar Vance</td>
                                    <td>Pre-Sales Support</td>
                                    <td><a class="btn btn-primary" <?php echo e(prefixActive('etudiant/stage')); ?>

                                            href="<?php echo e(route('cahier_stage')); ?>" class="<?php echo e(routeActive('cahier_stage')); ?>">
                                            <i class="icofont icofont-book-alt">
                                                Cahier de stage
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Doris Wilder</td>
                                    <td>Sales Assistant</td>
                                    <td><a class="btn btn-primary" <?php echo e(prefixActive('etudiant/stage')); ?>

                                            href="<?php echo e(route('cahier_stage')); ?>" class="<?php echo e(routeActive('cahier_stage')); ?>">
                                            <i class="icofont icofont-book-alt">
                                                Cahier de stage
                                            </i></a></td>
                                </tr>
                                <tr>
                                    <td>Angelica Ramos</td>
                                    <td>Chief Executive Officer (CEO)</td>
                                    <td><a class="btn btn-primary" <?php echo e(prefixActive('etudiant/stage')); ?>

                                            href="<?php echo e(route('cahier_stage')); ?>" class="<?php echo e(routeActive('cahier_stage')); ?>">
                                            <i class="icofont icofont-book-alt">
                                                Cahier de stage
                                            </i></a></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Cahier de stage</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
</div>


<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.etudiant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\gestionDesStages\resources\views/etudiant/stage/gestion_cahier_stage.blade.php ENDPATH**/ ?>