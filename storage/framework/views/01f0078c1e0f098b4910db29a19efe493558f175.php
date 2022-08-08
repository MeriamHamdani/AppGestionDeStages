

<?php $__env->startSection('title'); ?>Ajouter classe
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatable-extension.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Ajouter une classe</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Administration</li>
<li class="breadcrumb-item">Ajouter une classe</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Ajouter une classe</h5>
                </div>
                <div><?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div><?php echo e($err); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>
                <div class="card-body">
                    <form class="row g-3 needs-validation" novalidate="" method="POST"
                        action="<?php echo e(route('sauvegarder_classe')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php if($errors->any()): ?>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo e($err); ?>

                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Niveau</label>
                            <select class="js-example-basic-single col-sm-12" id="niveau" name="niveau"
                                value="<?php echo e(old('niveau')); ?>" required>
                                <option disabled="disabled" selected="selected">Sélectionnez le niveau
                                </option>
                                <option value="1" <?php echo e(old('niveau')=="1" ? 'selected' : ''); ?>>
                                    1 ère année
                                </option>
                                <option value="2" <?php echo e(old('niveau')=="2" ? 'selected' : ''); ?>>
                                    2 ème année
                                </option>
                                <option value="3" <?php echo e(old('niveau')=="3" ? 'selected' : ''); ?>>
                                    3 ème année
                                </option>
                            </select>
                            <div class="invalid-tooltip">Séléctionnez le niveau svp!</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Cycle/Type de Formation</label>
                            <select class="js-example-basic-single col-sm-12" id="cycle" name="cycle"
                                value="<?php echo e(old('cycle')); ?>" required>
                                <option disabled="disabled" selected="selected">Sélectionnez le type de formation
                                </option>
                                <option value="licence" <?php echo e(old('cycle')=="licence" ? 'selected' : ''); ?>>
                                    Licence
                                </option>
                                <option value="master" <?php echo e(old('cycle')=="master" ? 'selected' : ''); ?>>
                                    Mastère
                                </option>
                                <option value="doctorat" <?php echo e(old('cycle')=="doctorat" ? 'selected' : ''); ?>>
                                    Doctorat
                                </option>
                                <option value="ingenierie" <?php echo e(old('cycle')=="ingeniorat" ? 'selected' : ''); ?>>
                                    Ingénierie
                                </option>
                            </select>
                            <div class="invalid-tooltip">Séléctionnez le cycle svp!</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Spécialité</label>
                            <select class="js-example-basic-single col-sm-12" id="specialite_id" name="specialite_id"
                                required>
                                <option disabled="disabled" selected="selected">Sélectionnez la spécialité
                                </option>
                                <?php $__currentLoopData = \App\Models\Specialite::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($specialite->id); ?>" <?php echo e(old('specialite_id')==$specialite->id ?
                                    'selected' : ''); ?>

                                    ><?php echo e(ucwords($specialite->nom)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="invalid-tooltip">Séléctionnez la spécialité svp!</div>
                        </div>
                        <!--<div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Code classe</label>
                            <input class="form-control" id="code" name="code" type="text" value="<?php echo e(old('code')); ?>"
                                required="" placeholder="entrez le code du classe....." />
                            <div class="invalid-tooltip">Entrez le code du classe svp!</div>
                        </div>-->
                        <div class="card-footer text-end">
                            <a class="btn btn-light" href="<?php echo e(route('liste_classes')); ?>">Annuler</a>
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
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
<?php if(Session::get('message')=='notMatchCycle'): ?>
<script>
    swal('Oups', 'La spécialite '.Session::get('sp').' ne peut pas etre attribuée au cycle '.Session::get('cycle'), 'error', {
                            button: 'Reéssayer'
                        })
</script>
<?php echo e(Session::forget('message')); ?>

<?php endif; ?>
<?php endif; ?>

<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/etablissement/classe/ajouter_classe.blade.php ENDPATH**/ ?>