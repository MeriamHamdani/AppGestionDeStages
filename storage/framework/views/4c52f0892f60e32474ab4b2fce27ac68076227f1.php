

<?php $__env->startSection('title'); ?>Gestion des spécialités
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatable-extension.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">


<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Gestion des spécialités</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Etablissement</li>
        <li class="breadcrumb-item">Gestion des spécialités</li>

    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>La liste des Spécialités</h5>
                        <div style="padding-left: 2px">
                            <a href=<?php echo e(route('ajouter_specialite')); ?>>
                                <i class="text-right" aria-hidden="true">
                                    <button class="btn btn-pill btn-success btn-sm pull-right" type="button">
                                        Ajouter une Spécialité
                                    </button>
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="auto-fill">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Spécialité</th>
                                    <th>Déparetement</th>
                                    <th>Cycle</th>
                                    <th>Responsable</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $specialites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(ucwords($specialite->code)); ?></td>
                                        <td><?php echo e(ucwords($specialite->nom)); ?></td>
                                        <?php if( $specialite->departement_id==null): ?>
                                            <td class="text-center">

                                                <a href="<?php echo e(route('modifier_specialite', $specialite)); ?>"
                                                   data-toggle="tooltip"
                                                   title="veuillez editer les informations de cette spécialité pour l'affecter à un
                                        département">
                                                    <i class="icofont icofont-exclamation-tringle"
                                                       style="font-size: 1.3em"></i>
                                                </a>

                                            </td>
                                        <?php else: ?>
                                            <td><?php echo e(ucwords($specialite->departement->nom)); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e(ucwords($specialite->cycle)); ?></td>
                                        <td class="text-center">
                                            <?php if(isset($specialite->enseignant_id)): ?><?php echo e(ucwords($specialite->enseignant->nom)); ?>

                                            <?php echo e(ucwords($specialite->enseignant->prenom)); ?>

                                            <?php else: ?>
                                                <a href="<?php echo e(route('modifier_specialite', $specialite)); ?>"
                                                   data-toggle="tooltip"
                                                   title="veuillez editer les informations de cette spécialité pour lui affecter un responsable">
                                                    <i class="icofont icofont-exclamation-tringle"
                                                       style="font-size: 1.3em"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo e(route('modifier_specialite', $specialite)); ?>"> <i
                                                    style="font-size: 1.3em;" class='fa fa-edit'></i></a>
                                            <a href="#" data-id="<?php echo e($specialite->id); ?>"
                                               data-name="<?php echo e($specialite->nom); ?>"
                                               class="delete"> <i style="font-size: 1.3em;"
                                                                  class='fa fa-trash delete'></i></a>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Spécialité</th>
                                    <th>Déparetement</th>
                                    <th>Cycle</th>
                                    <th>Responsable</th>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
                integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/icons/icons-notify.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/icons/feather-icon/feather-icon-clipart.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
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
        <?php if(Session::has('message')): ?>
            <script>
                toastr.success("<?php echo Session::get('message'); ?>")
            </script>
        <?php endif; ?>
        <?php if(Session::has('message')): ?>
            <?php if(Session::get('message')=='ok'): ?>

                <script>
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: 'La nouvelle spécialité est sauvegardée avec succées',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    /*swal('Bien','Le nouveau enseignant est sauvegardé','success',{
                        button: 'continuer'
                    })*/

                </script>

            <?php elseif(Session::get('message')=='ko'): ?>
                <script>
                    swal({
                        position: 'center',
                        icon: 'error',
                        title: 'Oups! cette spécialité existe déja ',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    /*swal('Oups','L\'enseignant existe déja','error',{
                    button: 'reéssayer'
                })*/
                </script>
            <?php elseif(Session::get('message')=='update'): ?>
                <script>
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: 'mise à jour éffectué',
                        showConfirmButton: false,
                        timer: 2500
                    })

                </script>
            <?php endif; ?>
        <?php endif; ?>
        <script>
            $('.delete').click(function () {
                var dataId = $(this).attr('data-id');
                var dataName = $(this).attr('data-name');
                //var dataAll =$(this).att('data-all');
                swal({
                    title: "Etes-vous sûr de vouloir supprimer la spécialité " + dataName + " ?",
                    //text: "Une fois supprimé, les classes attachés à cette spécialité seront sans spécialité!",
                    icon: "warning",
                    buttons: true,

                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location = "supprimer-specialite/" + dataId + "";
                            swal("Ok! La spécialité est supprimée!", {
                                icon: "success",
                            });
                        } else {
                            swal("La suppression est annulée!");
                        }
                    })
            });

        </script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/etablissement/specialite/liste_specialites.blade.php ENDPATH**/ ?>