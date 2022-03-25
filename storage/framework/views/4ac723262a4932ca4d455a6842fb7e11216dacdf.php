

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
                                    <th>Type de sujet</th>
                                    <th>Entreprise</th>
                                    <th>Date de debut</th>
                                    <th>Date de fin</th>
                                    <th>Confirmation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Zouhour Ben Ticha</td>
                                    <td>LF3I obligatoire</td>
                                    <td>Application de gestion des stages </td>
                                    <td>PFE</td>
                                    <td>Hyper group</td>
                                    <td>01-02-2022</td>
                                    <td>31-05-2022</td>
                                    <td>
                                        <div style="align-content: center">

                                            <a href="#" data-title="confirmer-demande" data-toggle="tooltip"
                                                title="confirmer la demande" onclick="this.disabled = true">
                                                <i style="background-position: 0 -90px;
                                                        height: 30px;
                                                        width: 23px;
                                                        display:block;
                                                        margin:0 auto;" class="icofont icofont-ui-check"></i>
                                            </a>

                                            <a href="#" data-title='refuser-demande' data-toggle='tooltip'
                                                title="refuser la demande">

                                                <i style="background-position: 0 -90px;
                                            height: 30px;
                                            width: 23px;
                                            display:block;
                                            margin:0 auto;" class="icofont icofont-ui-close"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Meriam Hamdani</td>
                                    <td>LF3I obligatoire</td>
                                    <td>Application de gestion des stages </td>
                                    <td>Projet tutoré</td>
                                    <td>Hyper group</td>
                                    <td>01-02-2022</td>
                                    <td>31-05-2022</td>
                                    <td>
                                        <!--<button class="btn btn-primary job-apply-btn" type="button"
                                            onclick="this.disabled = 'disabled'">
                                            <span><i class="fa fa-check text-white"></i></span> Confirmer
                                        </button>-->
                                        <div style="align-content: center">

                                            <a href="#" data-title="confirmer-demande" data-toggle="tooltip"
                                                title="confirmer la demande" onclick="this.disabled = true">
                                                <i style="background-position: 0 -90px;
                                                            height: 30px;
                                                            width: 23px;
                                                            display:block;
                                                            margin:0 auto;" class="icofont icofont-ui-check"></i>
                                            </a>

                                            <a href="#" data-title='refuser-demande' data-toggle='tooltip'
                                                title="refuser la demande">

                                                <i style="background-position: 0 -90px;
                                                height: 30px;
                                                width: 23px;
                                                display:block;
                                                margin:0 auto;" class="icofont icofont-ui-close"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ali ben ali</td>
                                    <td>LF3I obligatoire</td>
                                    <td>Application de gestion des stages </td>
                                    <td>business plan</td>
                                    <td>Hyper group</td>
                                    <td>01-02-2022</td>
                                    <td>31-05-2022</td>
                                    <td>
                                        <!--<button class="btn btn-primary job-apply-btn" type="button"
                                            onclick="this.disabled = 'disabled'">
                                            <span><i class="fa fa-check text-white"></i></span> Confirmer
                                        </button>-->
                                        <div style="align-content: center">

                                            <a href="#" data-title="confirmer-demande" data-toggle="tooltip"
                                                title="confirmer la demande" onclick="this.disabled = true">
                                                <i style="background-position: 0 -90px;
                                                            height: 30px;
                                                            width: 23px;
                                                            display:block;
                                                            margin:0 auto;" class="icofont icofont-ui-check"></i>
                                            </a>

                                            <a href="#" data-title='refuser-demande' data-toggle='tooltip'
                                                title="refuser la demande">

                                                <i style="background-position: 0 -90px;
                                                height: 30px;
                                                width: 23px;
                                                display:block;
                                                margin:0 auto;" class="icofont icofont-ui-close"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>

                                <!-- <td style=" padding: 10px;
                                    border: 2px solid #3CB371;
                                    border-radius: 5px;
                                    background-color: #e5e5e5;">En cours</td>-->
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Etudiant</th>
                                    <th>Type de Stage</th>
                                    <th>Sujet</th>
                                    <th>Type de sujet</th>
                                    <th>Entreprise</th>
                                    <th>Date de debut</th>
                                    <th>Date de fin</th>
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


<?php echo $__env->make('layouts.enseignant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\gestionDesStages\resources\views/enseignant/encadrement/Liste_demandes_encadrement.blade.php ENDPATH**/ ?>