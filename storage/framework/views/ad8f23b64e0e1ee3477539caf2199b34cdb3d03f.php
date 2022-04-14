

<?php $__env->startSection('title'); ?>Cahier de stage
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
            <h3>Détails de stage de : l'etudiant</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Enacdrement</li>
        <li class="breadcrumb-item active">Détails de stage de : l'etudiant</li>
    <?php echo $__env->renderComponent(); ?>
    <div class="container-fluid">
        <div class="user-profile social-app-profile">
            <div class="col-md-6 col-sm-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Détails de stage de : l'etudiant
                        </h5>
                    </div>
                    <div class="collapse show" id="collapseicon1" data-parent="#accordion" aria-labelledby="collapseicon1">
                        <div class="card-body social-status filter-cards-view">
                            <div class="media">
                                <div class="media-body">
                                    <span class="d-block">Nom et prénom</span>
                                    <span class="f-w-600 d-block" style="color:#bf9168  ">Meriam Hamdani</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <span class="d-block">Sujet</span>
                                    <input class="form-control" placeholder="Taper votre sujet..." type="text" value="Dev app gestion des stages"/>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <span class="d-block">Type de Stage</span>
                                    <span class="f-w-600 d-block" style="color:#bf9168">2eme licence info oblig</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <span class="d-block">Date début</span>
                                    <span class="f-w-600 d-block" style="color:#bf9168">01-02-2022</span>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <span class="d-block">Date fin</span>
                                    <span class="f-w-600 d-block" style="color:#bf9168">01-06-2022</span>
                                </div>
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


<?php echo $__env->make('layouts.enseignant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\stageApp\AppGestionDeStages\resources\views/enseignant/encadrement/details_stage.blade.php ENDPATH**/ ?>