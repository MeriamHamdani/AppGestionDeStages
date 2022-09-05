

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
                                <p>Titre sujet</p>
                            </div>
                            <div class="stepwizard-step"><a class="btn btn-light" href="#step-2">2</a>
                                <p>Fichiers nécessaires 1</p>
                            </div>
                            <div class="stepwizard-step"><a class="btn btn-light" href="#step-3">3</a>
                                <p>Mémoire</p>
                            </div>
                            <?php if($stage->type_sujet == "PFE" && $etudiant->classe->cycle =="licence"): ?>
                            <div class="stepwizard-step"><a class="btn btn-light" href="#step-4">4</a>
                                <p>Fichiers nécessaires 2</p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <form action="<?php echo e(route('deposer_memoire',['stage_id'=>$stage->id])); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php if($errors->any()): ?>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo e($err); ?>

                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <div class="setup-content" id="step-1">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Titre de sujet</label>
                                        <input class="form-control" id="titre" name="titre" type="text" required>
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right" type="button">Suivant</button>
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
                                                    <label class="col-sm-3 col-form-label">Fiche de bibliothèque</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" name="fiche_biblio"
                                                            id="fiche_biblio" accept=".docx,.jpeg,.jpg,.png"
                                                            required="required" />
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Rapport de plagiat</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" name="fiche_plagiat"
                                                            id="fiche_plagiat" accept=".docx,.jpeg,.jpg,.png"
                                                            required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right" type="button">Suivant</button>
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
                                                        <input class="form-control" type="file" name="memoire"
                                                            id="memoire" accept=".pdf,.docx" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if($stage->type_sujet == "Projet Tutoré" || $stage->type_sujet == "Business Plan"
                                    || $etudiant->classe->cycle =="master"): ?>
                                    <button class="btn btn-secondary pull-right" type="submit">Términer!
                                    </button>
                                    <?php else: ?>
                                    <button class="btn btn-primary nextBtn pull-right" type="button">Suivant
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if($stage->type_sujet == "PFE" && $etudiant->classe->cycle =="licence"): ?>
                        <div class="setup-content" id="step-4">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Attestation</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" name="attestation"
                                                            id="attestation" accept=".docx,.jpeg,.jpg,.png" />
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">Fiche technique</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="file" name="fiche_tech"
                                                            id="fiche_tech" accept=".docx,.jpeg,.jpg,.png" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="stage_id" value="<?php echo e($stage_id); ?>">
                                    <button class="btn btn-secondary pull-right" type="submit">Terminer!</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
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


<?php echo $__env->make('layouts.etudiant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/etudiant/depot/deposer.blade.php ENDPATH**/ ?>