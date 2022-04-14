

<?php $__env->startSection('title'); ?>Ajouter Etudiant
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Ajouter un etudiant</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Ajouter un etudiant</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ajouter un etudiant</h5>
                    </div>
                    <form class="form theme-form">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Numero CIN/Passeport</label>
                                        <input class="form-control" id="message-text" type="number"
                                               placeholder="entrez le num cin" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="message-text">Nom </label>
                                        <input class="form-control" id="message-text" type="text"
                                               placeholder="entrez le nom de l'etudiant..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="message-text">Prénom </label>
                                        <input class="form-control" id="message-text" type="text"
                                               placeholder="entrez le prénom de l'etudiant..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="message-text">Numéro de téléphone</label>
                                        <input class="form-control" id="message-text" type="number"
                                               placeholder="entrez le numéro de téléphone de l'etudiant..." />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label" for="message-text">E-mail </label>
                                        <input class="form-control" id="message-text" type="email"
                                               placeholder="entrez l'adresse mail de l'etudiant..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Classe</label>
                                        <select class="js-example-basic-single col-sm-12">
                                            <option value="0">Sélectionnez la classe</option>
                                            <option value="1">2 Comp</option>
                                            <option value="2">1 Gest</option>
                                            <option value="3">2 info</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="message-text">Numéro d'inscription</label>
                                        <input class="form-control" id="message-text" type="number"
                                               placeholder="entrez le Numéro d'inscription de l'etudiant..." />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-light" type="reset" value="Annuler" />
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\stageApp\AppGestionDeStages\resources\views/admin/etablissement/etudiant/ajouter_etudiant.blade.php ENDPATH**/ ?>