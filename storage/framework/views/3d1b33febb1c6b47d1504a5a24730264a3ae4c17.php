

<?php $__env->startSection('title'); ?>La soutenance
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>La soutenance</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Soutenance</li>
        <li class="breadcrumb-item active">Détails</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Informations sur la soutenacne</h5>
                    </div>
                    <div class="card-body">
                        <div class="default-according style-1" id="accordionoc">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link text-white" data-bs-toggle="collapse"
                                                data-bs-target="#collapseicon" aria-expanded="true" aria-controls="collapse11">
                                            <i class="icofont icofont-graduate-alt"></i> Informations générales sur l'étudiant
                                        </button>
                                    </h5>
                                </div>
                                <div class="collapse show" id="collapseicon" aria-labelledby="collapseicon"
                                     data-bs-parent="#accordionoc">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Nom : <strong>Hamdani</strong>
                                            </li>
                                            <li>
                                                Prénom : <strong>Meriam</strong>
                                            </li>
                                            <li>
                                                classe: <strong>3eme genie info</strong>
                                            </li>
                                            <li>
                                                Titre de sujet : <strong>dev app stage</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse"
                                                data-bs-target="#collapseicon1" aria-expanded="false">
                                            <i class="icofont icofont-support"></i>Membres de jury
                                        </button>
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseicon1" aria-labelledby="headingeight"
                                     data-bs-parent="#accordionoc">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Président : <strong>Slim Kenoun</strong>
                                            </li>
                                            <li>
                                                Rapporteur : <strong>Slim Kenoun</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse"
                                                data-bs-target="#collapseicon2" aria-expanded="false"
                                                aria-controls="collapseicon2">
                                            <i class="icofont icofont-tasks-alt"></i> Date et Lieu
                                        </button>
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseicon2" data-bs-parent="#accordionoc">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Date : <strong>30 juin 2022</strong>
                                            </li>
                                            <li>
                                                Heure : <strong>09:00 am</strong>
                                            </li>
                                            <li>
                                                Lieu :<strong> Amphi 6</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php $__env->startPush('scripts'); ?>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.enseignant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDeStages\resources\views/enseignant/soutenance/info_soutenance.blade.php ENDPATH**/ ?>