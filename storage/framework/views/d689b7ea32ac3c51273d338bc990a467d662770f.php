

<?php $__env->startSection('title'); ?>Dépôt
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Dépôt</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Dépôt</li>
        <li class="breadcrumb-item">Traiter les dépôts</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>La Liste des demandes de dépôt</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="advance-1">
                                <thead>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Type sujet</th>
                                    <th>Date début stage</th>
                                    <th>Date fin stage</th>
                                    <th>Date dépôt</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $demandes_depots_memoires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande_depot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($demande_depot->titre); ?></td>
                                    <td><?php echo e(ucwords($demande_depot->stage->etudiant->prenom)); ?> <?php echo e(ucwords($demande_depot->stage->etudiant->nom)); ?></td>
                                    <td><?php echo e($demande_depot->stage->type_sujet); ?></td>
                                    <td><?php echo e($demande_depot->stage->date_debut); ?></td>
                                    <td><?php echo e($demande_depot->stage->date_fin); ?></td>
                                    <td><?php echo e($demande_depot->date_depot); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('telecharger_memoire_ens',['memoire'=>$demande_depot->memoire,
                                                                                'code_classe'=>$demande_depot->stage->etudiant->classe->code,'stage'=>$demande_depot->stage])); ?>" data-title="Consulter le mémoire" data-toggle="tooltip" data-original-title="Consulter le mémoire" title="Consulter le mémoire">
                                            <i class="icofont icofont-papers icon-large" style="color:#bf9168 "></i></a>
                                        <a data-title="Commenter le dépôt" data-toggle="tooltip"  title="Commenter le dépôt"
                                           href=<?php echo e(route('details_depot',['demande_depot'=>$demande_depot])); ?>>
                                            <i class="icofont icofont-comment icon-large"></i></a>
                                        <?php if($demande_depot->validation_encadrant == -1): ?>
                                            <i data-toggle="tooltip" title="mettez votre décision" class="fa fa-hand-o-left large" style="color:darkred"></i>
                                        <?php elseif($demande_depot->validation_encadrant == 0): ?>
                                            <i data-toggle="tooltip" title="demande refusée" class="icofont icofont-ui-close icon-large" style="color:darkred"></i>
                                        <?php elseif($demande_depot->validation_encadrant == 1): ?>
                                            <i data-toggle="tooltip" title="demande confirmée" class="icofont icofont-ui-check icon-large" style="color:darkgreen"></i>
                                        <?php endif; ?>

                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Type sujet</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Date dépôt</th>
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
        <script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
                integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <?php if(Session::has('message')): ?>
            <?php if(Session::get('message')=='deja validé'): ?>

                <script>
                    swal('Erreur', "Vous avez déjà validé le mémoire!", 'error', {
                        button: 'Ok'
                    })

                </script>
            <?php endif; ?>
        <?php endif; ?>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.enseignant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/enseignant/depot/liste-depots.blade.php ENDPATH**/ ?>