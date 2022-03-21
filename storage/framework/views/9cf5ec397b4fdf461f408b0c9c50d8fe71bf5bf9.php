<?php $__env->startSection('title'); ?>Dépôser mon mémoire
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Dépôser mon mémoire</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Dépôt</li>
<li class="breadcrumb-item active">Dépôt du mémoire</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Dépôser mon mémoire</h5>
                    <span>Le dépôt du mémoire se fait juste avant la soutanance d'une période bien déterminé et dés que
                        vous serez autorisé vous pouvez déposer votre mémoire</span>
                </div>
                <div class="card-body">
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step"><a class="btn btn-primary" href="#step-1">1</a>
                                <p>Etape 1</p>
                            </div>
                            <div class="stepwizard-step"><a class="btn btn-light" href="#step-2">2</a>
                                <p>Etape 2</p>
                            </div>
                            <div class="stepwizard-step"><a class="btn btn-light" href="#step-3">3</a>
                                <p>Etape 3</p>
                            </div>
                            <div class="stepwizard-step"><a class="btn btn-light" href="#step-4">4</a>
                                <p>Etape 4</p>
                            </div>
                        </div>
                    </div>
                    <form action="#" method="POST">
                        <div class="setup-content" id="step-1">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Titre de sujet</label>
                                        <input class="form-control" type="text" required="required">
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="setup-content" id="step-2">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">L'attestation</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" />
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">La fiche technique</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="setup-content" id="step-3">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Le mémoire</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="setup-content" id="step-4">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Fiche Biblio</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" />
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Fiche plagiat</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-secondary pull-right" type="submit">Finish!</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/form-wizard/form-wizard-two.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.etudiant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\gestionDesStages\resources\views/etudiant/depot/deposer.blade.php ENDPATH**/ ?>