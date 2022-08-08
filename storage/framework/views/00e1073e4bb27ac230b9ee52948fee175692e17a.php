

<?php $__env->startSection('title'); ?>Gestion des enseignants
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/date-picker.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatable-extension.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">


<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Gestion des enseignants</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Etablissement</li>
<li class="breadcrumb-item">Gestion des enseignants</li>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>La liste des Enseignants</h5>
                    <div style="padding-left: 2px">
                        <a href=<?php echo e(route('ajouter_enseignant')); ?>>
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success btn-sm pull-right" type="button">
                                    Ajouter un Enseignant
                                </button>
                            </i>
                        </a>
                        <a href=#>
                            <div class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success btn-sm pull-right" type="button"
                                    data-bs-toggle="modal" data-bs-target="#export" data-whatever="@getbootstrap">
                                    Exporter des enseignants
                                </button>
                                <div class="modal fade" id="export" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Exporter la liste des enseignants</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Fermez"></button>
                                            </div>
                                            <form method="POST" action="<?php echo e(route('file-export')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <div class="mb-2">
                                                            <select class="js-example-basic-single col-sm-12"
                                                                id="departement_id" name="departement_id" required>
                                                                <option disabled="disabled" selected="selected">
                                                                    Sélectionnez le département
                                                                </option>
                                                                <?php $__currentLoopData = \App\Models\Departement::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($departement->id); ?>" <?php echo e(old('departement_id')==$departement->id ? 'selected'
                                                                    : ''); ?>

                                                                    ><?php echo e(ucwords($departement->nom)); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-bs-dismiss="modal">Annuler
                                                    </button>
                                                    
                                                    <button class="btn btn-primary" type="submit">Exporter</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href=#>
                            <i class="text-right" aria-hidden="true">
                                <button class="btn btn-pill btn-success btn-sm pull-right" type="button"
                                    data-bs-toggle="modal" data-bs-target="#import" data-whatever="@getbootstrap">
                                    Importer des enseignants
                                </button>
                                <div class="modal fade" id="import" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Importer la liste des enseignants</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="<?php echo e(route('file-import')); ?>" method="POST"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <?php if($errors->any()): ?>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?php echo e($err); ?>

                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="col-form-label"
                                                            for="recipient-name">Département</label>
                                                        <div class="mb-2">
                                                            <select class="js-example-basic-single col-sm-12"
                                                                id="departement_id" name="departement_id" required>
                                                                <option disabled="disabled" selected="selected">
                                                                    Sélectionnez le département
                                                                </option>
                                                                <?php $__currentLoopData = \App\Models\Departement::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($departement->id); ?>" <?php echo e(old('departement_id')==$departement->id ? 'selected'
                                                                    : ''); ?>

                                                                    ><?php echo e(ucwords($departement->nom)); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label" for="message-text">Fichier
                                                            CSV</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" name="file" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-bs-dismiss="modal">Annuler
                                                    </button>
                                                    <button class="btn btn-primary" type="submit">Importer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>Département</th>
                                    <th>Grade</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $enseignants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enseignant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(ucwords($enseignant->nom)); ?> <?php echo e(ucwords($enseignant->prenom)); ?> </td>
                                    <td><?php if(isset($enseignant->departement_id)): ?><?php echo e(ucwords($enseignant->departement->nom)); ?><?php endif; ?>
                                    </td>
                                    <td><?php echo e(ucwords($enseignant->grade)); ?></td>
                                    <td><?php echo e(ucwords($enseignant->email)); ?></td>
                                    <td><?php echo e(($enseignant->numero_telephone)); ?></td>
                                    <?php if(App\Models\User::find($enseignant->user_id)->is_active == 1): ?>
                                    <td><a class=" btn btn-icon-only default" href="#" data-placement="top"
                                            data-toggle="tooltip" title="Active"><img
                                                src="<?php echo e(asset('assets/images/userActive.png')); ?>">
                                        </a>
                                    </td>
                                    <?php else: ?>
                                    <td><a class=" btn btn-icon-only default" href="#" data-placement="top"
                                            data-toggle="tooltip" title="Active"><img
                                                src="<?php echo e(asset('assets/images/usercancled.png')); ?>">
                                        </a>
                                    </td>
                                    <?php endif; ?>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('modifier_enseignant', $enseignant)); ?>"> <i
                                                style="font-size: 1.3em;" class='fa fa-edit'></i></a>
                                        
                                        <a href="#" data-id="<?php echo e($enseignant->id); ?>"
                                            data-name="<?php echo e($enseignant->prenom); ?> <?php echo e($enseignant->nom); ?>" class="delete">
                                            <i style="font-size: 1.3em;" class='fa fa-trash delete'></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>Département</th>
                                    <th>Grade</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.en.js')); ?>">
</script>
<script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.custom.js')); ?>">
</script>
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
    swal('Bien', "L'enseignant est bien ajouté", 'success', {
                        //button: 'Continuer',
                        showConfirmButton: false,
                        timer: 2500
                    })

</script>

<?php elseif(Session::get('message')=='ko'): ?>
<script>
    swal('Oups', "L'enseignant existe déja", 'error', {
                        button: 'Reéssayer'
                    })
</script>
<?php elseif(Session::get('message')=='update'): ?>
<script>
    swal('Bien', "L'enseignant est bien mis à jour", 'success', {
                        button: 'Continuer'
                    })
</script>
<?php else: ?>
<script>
    swal('Bien', Session::get('message'), 'success', {
                    button: 'Continuer'
                })
</script>
<?php endif; ?>
<?php endif; ?>

<script>
    $('.delete').click(function () {
                var dataId = $(this).attr('data-id');
                var dataName = $(this).attr('data-name');
                swal({
                    title: "Êtes-vous  sûr de vouloir supprimer l'enseignant " + dataName + " ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location = "supprimer-enseignant/" + dataId + "";
                            swal("Poof! L'enseignant est bien supprimé!", {
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/etablissement/enseignant/liste_enseignants.blade.php ENDPATH**/ ?>