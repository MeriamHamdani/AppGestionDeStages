

<?php $__env->startSection('title'); ?>Liste des années universitaires
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatable-extension.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/buttonload.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Liste des années universitaires </h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item">Liste des années universitaires</li>


    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Les années universitaires</h5>
                        <div style="padding-left: 2px">
                            <a href=<?php echo e(route('config_annee_universitaire')); ?>>
                                <i class="text-right" aria-hidden="true">
                                    <button class="btn btn-pill btn-success btn-sm pull-right" type="button">
                                        Ajouter l'année universitaire actuelle
                                    </button>
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext">
                            <table class="display" id="auto-fill">
                                <thead>
                                <tr>
                                    <th>Année Universitaire </th>
                                    <th>Lettre d'affectation</th>
                                    <th>Fiche d'encadrement</th>
                                    <th>Les grilles</th>
                                    <th>Les Pvs</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $annees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $annee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($annee->annee); ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('telecharger_lettre_affectation',Str::after($annee->lettre_affectation, '/'))); ?>"
                                                                data-toggle="tooltip" title="Télécharger le model de la lettre d'affectation">
                                            <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i>
                                        </a></td>
                                    <td class="text-center"> <a href="<?php echo e(route('telecharger_fiche_encadrement',Str::after($annee->fiche_encadrement, '/'))); ?>"
                                                                data-toggle="tooltip" title="Télécharger le model de la fiche d'encadrement">
                                            <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i></i>
                                        </a></td>
                                    <td class="text-center"> <a href="<?php echo e(route('telecharger_grille_licence',Str::after($annee->grille_evaluation_licence, '/'))); ?>"
                                                                data-toggle="tooltip" title="Télécharger le model de la grille d'évaluation licence">
                                            <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i></i>
                                        </a>
                                      <a href="<?php echo e(route('telecharger_grille_info',Str::after($annee->grille_evaluation_info, '/'))); ?>"
                                         data-toggle="tooltip" title="Télécharger le model de la grille d'évaluation licence informatique">
                                          <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i></i>
                                        </a>
                                        <a href="<?php echo e(route('telecharger_grille_master',Str::after($annee->grille_evaluation_master, '/'))); ?>"
                                         data-toggle="tooltip" title="Télécharger le model de la grille d'évaluation mastère">
                                            <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i>
                                        </a></td>
                                        <td class="text-center">
                                            <a href="<?php echo e(route('telecharger_pv_individuel',Str::after($annee->pv_individuel, '/'))); ?>"
                                                                    data-toggle="tooltip" title="Télécharger le model de PV individuel">
                                                <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i></i> </a>
                                            <a href="<?php echo e(route('telecharger_pv_global',Str::after($annee->pv_global, '/'))); ?>"
                                                                    data-toggle="tooltip" title="Télécharger le model de PV global">
                                                <i style="font-size: 2em;color:#bf9168" class="icofont icofont-file-word icon-large"></i></a>
                                        </td>

                                    <td class="text-center">
                                            <a href=<?php echo e(route('modifier_annee_universitaire',$annee)); ?>> <i style="font-size: 1.3em;" class='icofont icofont-edit icon-large'
                                                          data-toggle="tooltip" title="Editer"></i></a>
                                        </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Année Universitaire </th>
                                    <th>Lettre d'affectation</th>
                                    <th>Fiche d'encadrement</th>
                                    <th>Les grilles</th>
                                    <th>Les Pvs</th>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
                integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <?php if(Session::has('message')): ?>
            <script>
                toastr.success("<?php echo Session::get('message'); ?>")
            </script>
        <?php endif; ?>
        <?php if(Session::has('message')): ?>
            <?php if(Session::get('message')=='attend_encadrant'): ?>

                <script>
                    swal('C\'est interdit', 'Il faut que l\'encadrant confirme la demande d\'abord', 'warning', {
                        button: 'error'
                    })

                </script>
            <?php endif; ?>
        <?php endif; ?>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/configuration/liste_annees_univ.blade.php ENDPATH**/ ?>