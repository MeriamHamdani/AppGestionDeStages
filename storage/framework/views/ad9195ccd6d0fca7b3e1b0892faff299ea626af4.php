

<?php $__env->startSection('title'); ?>Ajouter Département
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Ajouter un département</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Administration</li>
<li class="breadcrumb-item">Ajouter un département</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Ajouter un département</h5>
                </div>
                <div class="card-body">
                    <form class="form theme-form needs-validation" novalidate="" method="POST"
                        action="<?php echo e(route('departement.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <!--
                        <?php if($errors->any()): ?>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo e($err); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                        -->
                        <div class="form-group">
                            <label class="form-label" for="exampleFormControlInput1">Code département </label>
                            <div class="input-group">
                                <input class="form-control" id="exampleFormControlInput1" type="text" name="code"
                                    id="code" placeholder="entrez le code de département..." required="" />
                                <div class="invalid-tooltip">Entrez le code svp!</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="exampleFormControlInput1">Nom département </label>
                            <div class="input-group">
                                <input class="form-control" id="exampleFormControlInput1" type="text" name="nom"
                                    id="nom" placeholder="entrez le nom du département..." required="" />
                                <div class="invalid-tooltip">Entrez le nom svp!</div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a class="btn btn-light" href="<?php echo e(route('liste_departements')); ?>">Annuler</a>
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/etablissement/departement/ajouter_departement.blade.php ENDPATH**/ ?>