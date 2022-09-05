

<?php $__env->startSection('title'); ?>Mes demandes de stage
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatable-extension.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Mes demandes des stage</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Stage</li>
<li class="breadcrumb-item">Mes demandes des stage</li>
<!--<li class="breadcrumb-item active">Auto fill</li>-->
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Mes demandes</h5>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Année universitaire</th>
                                    <th>Entreprise</th>
                                    <th>Encadrant</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Etat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $demandes_classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($demande->typeStage->nom); ?></td>
                                    <td><?php echo e(App\Models\AnneeUniversitaire::find($demande->annee_universitaire_id)->annee); ?>

                                    </td>
                                    <?php if(isset($demande->entreprise_id)): ?>
                                    <td><?php echo e(App\Models\Entreprise::find($demande->entreprise_id)->nom); ?></td>
                                    <?php else: ?>
                                    <td class="text-center">
                                    </td>
                                    <?php endif; ?>
                                    <?php if(isset($demande->enseignant->prenom)): ?>
                                    <td><?php echo e(ucwords($demande->enseignant->prenom)); ?> <?php echo e(ucwords($demande->enseignant->nom)); ?>

                                    </td>
                                    <?php else: ?>
                                    <td class="text-center">
                                    </td>
                                    <?php endif; ?>
                                    <td><?php echo e($demande->date_debut); ?></td>
                                    <td><?php echo e($demande->date_fin); ?></td>
                                    <td>
                                        <?php if($demande->confirmation_admin == 0): ?>
                                        <button class="btn btn-warning btn-sm" data-toggle="tooltip"
                                            title="demande en attente">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </button>
                                        <?php if($demande->confirmation_encadrant == -1): ?>
                                        <button class="btn btn-outline-danger btn-sm" data-toggle="tooltip"
                                            title="demande encadrement refusée">
                                            <i class="icofont icofont-ui-close"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm"> <a
                                                href="<?php echo e(route('modifier_demande',['stage_id'=>$demande->id])); ?>"
                                                data-title="Modifer" data-toggle="tooltip"
                                                title="choisir un autre encadrant"> <i
                                                    class="icofont icofont-ui-edit icon-large"></i> </a></button>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($demande->confirmation_admin == 1): ?>
                                        <button class="btn btn-primary btn-sm" data-toggle="tooltip"
                                            title="demande confirmée">
                                            <i class="icofont icofont-ui-check"></i>
                                        </button>
                                        <?php endif; ?>
                                        <?php if($demande->confirmation_admin == -1): ?>
                                        <!-- demande refusée -->
                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip"
                                            title="demande refusée">
                                            <i class="icofont icofont-ui-close"></i>
                                        </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Type</th>
                                    <th>Année universitaire</th>
                                    <th>Entreprise</th>
                                    <th>Encadrant</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Etat</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php if(Session::has('message')): ?>
<script>
    toastr.success("<?php echo Session::get('message'); ?>")
</script>
<?php endif; ?>
<?php if(Session::has('message')): ?>
<?php if(Session::get('message')=='stage exist'): ?>

<script>
    swal('oups', "Vous avez deja une demande de stage en attente, vous ne pouvez pas envoyer une autre avant que l'administration l'accepter ou la refuser ", 'error', {
                button: 'Continuer'
                //showConfirmButton: false,
  //timer: 2500
            })

</script>
<?php endif; ?>
<?php endif; ?>

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.etudiant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/etudiant/stage/demandes_stages.blade.php ENDPATH**/ ?>