

<?php $__env->startSection('title'); ?>Ajouter admin
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Ajouter un administrateur</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Administration</li>
<li class="breadcrumb-item">Ajouter un administrateur</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Ajouter un admin</h5>
                </div>
                <form class="form theme-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">Nom </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        placeholder="entrez le nom de l'administrateur..." />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">Prénom </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        placeholder="entrez le prénom de l'administrateur..." />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">Numéro de téléphone</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        placeholder="entrez le numéro de téléphone de l'administrateur..." />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">e-mail </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        placeholder="entrez l'adresse mail de l'administrateur..." />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">

                                    <label class="form-label" for="exampleFormControlInput1">Numéro de CIN</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        placeholder="entrez le numéro de CIN de l'administrateur..." />
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Ajouter</button>
                        <input class="btn btn-light" type="reset" value="Annuler" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\gestionDesStages\resources\views/admin/administration/ajouter_admin.blade.php ENDPATH**/ ?>