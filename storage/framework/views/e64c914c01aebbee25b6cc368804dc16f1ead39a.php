

<?php $__env->startSection('title'); ?>Commenter le dépôt
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/date-picker.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/scrollable.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/timepicker.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/photoswipe.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Commenter le dépôt de : l'etudiant</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Enacdrement</li>
        <li class="breadcrumb-item active">Commenter le dépôt de : l'etudiant</li>
    <?php echo $__env->renderComponent(); ?>
    <div class="container-fluid">
        <div class="user-profile social-app-profile">
            <div class="col-md-6 col-sm-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Commenter le dépôt de : l'etudiant
                        </h5>
                            </div>
                            <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2" data-parent="#accordion">
                                <div class="card-body filter-cards-view">

                                    <div class="filter-view-group">
                                        <span class="f-w-600" style="color: #2b786a">Nom de l'enseignant </span>
                                        <p style="color: #0c0c0c">
                                            J'espere que vous corrigez la partie 1 de chapitre1
                                        </p>
                                        <span class="f-w-600"> 22-02-2022</span>
                            </div>
                            <div class="filter-view-group">
                                <span class="f-w-600" style="color: #2b786a">Nom de l'enseignant </span>
                                <p style="color: #0c0c0c">
                                    Bien recu c bien le mémoire est bien corrigé
                                </p>
                                <span class="f-w-600"> 31-02-2022</span>

                            </div>
                            <div class="form theme-form">
                                <form action="">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label style="color: #d22d3d">Ajoutez un commentaire en cas de refus de dépôt</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea4" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-end">
                                                <a class="btn btn-success me-3" href="#">Accepter le dépôt</a><a class="btn btn-danger" href="#">Mettre à jour le dépôt</a></div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('assets/js/photoswipe/photoswipe.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/photoswipe/photoswipe-ui-default.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/photoswipe/photoswipe.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.enseignant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\stageApp\AppGestionDeStages\resources\views/enseignant/depot/details_depot.blade.php ENDPATH**/ ?>