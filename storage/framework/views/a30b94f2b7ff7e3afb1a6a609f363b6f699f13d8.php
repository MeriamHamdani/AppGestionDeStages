

<?php $__env->startSection('title'); ?>Configuration de type de stage par classe
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/date-picker.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Configurer le type de stages selon la classe</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Gestion des classes</li>
        <li class="breadcrumb-item active">configuration type de stage selon la classe</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Configurer</h5>

                    </div>
                    <div class="card-body">
                        <div class="stepwizard">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step"><a class="btn btn-primary" href="#step-1">1</a>
                                    <p>classe et type de stage</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-2">2</a>
                                    <p>Période de stage</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-3">3</a>
                                    <p>Fiches nécessaires</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-4">4</a>
                                    <p>Cahier de stage</p>
                                </div>
                                <?php if($classe->niveau == 3 && $classe->cycle=="licence" ||$classe->niveau == 2 && $classe->cycle=="master"  ): ?>
                                    
                                    <div class="stepwizard-step"><a class="btn btn-light" href="#step-6">5</a>
                                        <p>Le(s) type(s) de sujet</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if($errors->any()): ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($err); ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <form class="row g-3 needs-validation" action="<?php echo e(route('typeStage.store',$classe)); ?>"
                              method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <?php if(isset($error_message['nom'])): ?>
                            <?php if($error_message['nom']!=""): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($error_message['nom']); ?>

                                </div>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php if(isset($error_message['periode_stage'])): ?>
                            <?php if(($error_message['periode_stage']!="")): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($error_message['periode_stage']); ?>

                                </div>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php if(isset($error_message['duree_max_min'])): ?>
                            <?php if($error_message['duree_max_min']!=""): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo e($error_message['duree_max_min']); ?>

                                </div>
                            <?php endif; ?>
                            <?php endif; ?>
                            <div class="setup-content" id="step-1">
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Classe</label>
                                            <select class="js-example-basic-single col-sm-12" name="nom_classe"
                                                    id="nom_classe">
                                                <option disabled="disabled" selected="selected"
                                                        value="<?php echo e($classe->nom); ?>">
                                                    <?php echo e($classe->nom); ?>

                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Type</label>
                                            <select name="type" id="type" class="js-example-basic-single col-sm-12">
                                                <option disabled="disabled" selected="selected">Sélectionnez le type
                                                </option>
                                                <option value="Obligatoire" <?php echo e(old('type') == "Obligatoire" ? 'selected' : ''); ?>>
                                                    Obligatoire
                                                </option>
                                                <option value="Volontaire" <?php echo e(old('type') == "Volontaire" ? 'selected' : ''); ?>>
                                                    Volontaire
                                                </option>
                                            </select>

                                        </div>
                                        <button class="btn btn-primary nextBtn pull-right" type="button">Suivant
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="setup-content" id="step-2">
                                <div class="col-xs-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Date de début</label>
                                            <input class="datepicker-here form-control digits date-picker" type="text"
                                                   data-language="en" required="required" name="date_debut"
                                                   id="date_debut" value="<?php echo e(old('date_debut')); ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Date de fin</label>
                                            <input class="datepicker-here form-control digits" type="text"
                                                   data-language="en" required="required" name="date_fin"
                                                   id="date_fin" value="<?php echo e(old('date_fin')); ?>"/>
                                        </div>
                                        <div class="col-md-6 position-relative">
                                            <label class="control-label">Durée de stage minimale en mois</label>
                                            <div class="input-group">
                                                <input class="touchspin" name="duree_stage_min" id="duree_stage_min" type="number"
                                                       value="<?php echo e(old('duree_stage_min')); ?>" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 position-relative">
                                            <label class="control-label">Durée de stage maximale en mois</label>
                                            <div class="input-group">
                                                <input class="touchspin" name="duree_stage_max" id="duree_stage_max" type="number"
                                                       value="<?php echo e(old('duree_stage_max')); ?>" required/>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary nextBtn pull-right" type="button">Suivant
                                        </button>
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
                                                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                            <label class="col-sm-3 col-form-label">La fiche de demande
                                                                de stage</label>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline1" type="radio"
                                                                       name="fiche_demande_type" value="requis" <?php echo e(old('fiche_demande_type') == "requis" ? 'checked' : ''); ?>>
                                                                <label class="mb-0" for="radioinline1">Requis</label>
                                                            </div>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline2" type="radio"
                                                                       name="fiche_demande_type" value="non requis" <?php echo e(old('fiche_demande_type') == "non requis" ? 'checked' : ''); ?>>
                                                                <label class="mb-0" for="radioinline2">Non
                                                                    Requis</label>
                                                            </div>
                                                            <input class="form-control" type="file" name="fiche_demande"
                                                                   id="fiche_demande" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3 row">
                                                        <div
                                                            class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                            <label class="col-sm-3 col-form-label">La fiche
                                                                d'assurance</label>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline3" type="radio"
                                                                       name="fiche_assurance_type" value="requis" <?php echo e(old('fiche_assurance_type') == "requis" ? 'checked' : ''); ?>>
                                                                <label class="mb-0" for="radioinline3">Requis</label>
                                                            </div>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline4" type="radio"
                                                                       name="fiche_assurance_type" value="non requis" <?php echo e(old('fiche_assurance_type') == "non requis" ? 'checked' : ''); ?>>
                                                                <label class="mb-0" for="radioinline4">Non
                                                                    Requis</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3 row">
                                                        <div
                                                            class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                            <label class="col-sm-3 col-form-label">La fiche 2 Dinars</label>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline5" type="radio"
                                                                       name="fiche_2Dinars_type" value="requis"  <?php echo e(old('fiche_2Dinars_type') == "requis" ? 'checked' : ''); ?>>
                                                                <label class="mb-0" for="radioinline5">Requis</label>
                                                            </div>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline6" type="radio"
                                                                       name="fiche_2Dinars_type" value="non requis"  <?php echo e(old('fiche_2Dinars_type') == "non requis" ? 'checked' : ''); ?>>
                                                                <label class="mb-0" for="radioinline6">Non
                                                                    Requis</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary nextBtn pull-right"
                                                    type="button">Suivant
                                            </button>
                                        </div>
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
                                                        <div
                                                            class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                            <label class="col-sm-3 col-form-label">Le cahier de stage pour ce type de stage est</label>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline7" type="radio"
                                                                       name="cahier_stage_type" value="requis" <?php echo e(old('cahier_stage_type') == "requis" ? 'checked' : ''); ?>>
                                                                <label class="mb-0" for="radioinline7">Requis</label>
                                                            </div>
                                                            <div class="radio radio-primary">
                                                                <input id="radioinline8" type="radio"
                                                                       name="cahier_stage_type" value="non requis" <?php echo e(old('cahier_stage_type') == "non requis" ? 'checked' : ''); ?>>
                                                                <label class="mb-0" for="radioinline8">Non
                                                                    Requis</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if($classe->niveau == 3 && $classe->cycle=="licence" || $classe->niveau == 2 && $classe->cycle=="master"  ): ?>
                                                <button class="btn btn-primary nextBtn pull-right"
                                                        type="button">Suivant
                                                </button>
                                            <?php else: ?>
                                                <button class="btn btn-secondary pull-right"
                                                        type="submit">Términer!
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($classe->niveau == 3 && $classe->cycle=="licence" ||
                            $classe->niveau == 2 && $classe->cycle=="master"  ): ?>
                                
                                <div class="setup-content" id="step-6">
                                    <div class="col-xs-12 card-body animate-chk">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="d-block" for="chk-ani"><input class="checkbox_animated"
                                                                                            id="chk-ani" type="checkbox"
                                                                                            name="type_sujet[]"
                                                                                            value="PFE">
                                                    PFE</label>
                                            </div>
                                            <div class="form-group">
                                                <label class="d-block" for="chk-ani"><input class="checkbox_animated"
                                                                                            id="chk-ani" type="checkbox"
                                                                                            name="type_sujet[]"
                                                                                            value="Projet Tutoré">
                                                    Projet Tutoré</label>
                                            </div>
                                            <div class="form-group">
                                                <label class="d-block" for="chk-ani"><input class="checkbox_animated"
                                                                                            id="chk-ani" type="checkbox"
                                                                                            name="type_sujet[]"
                                                                                            value="Business Plan">
                                                    Business Plan</label>
                                                <button class="btn btn-secondary pull-right"
                                                        type="submit">Términer!
                                                </button>
                                            </div>
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
        <script src="<?php echo e(asset('assets/js/touchspin/vendors.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/touchspin/touchspin.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/touchspin/input-groups.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/form-wizard/form-wizard-two.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.en.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.custom.js')); ?>"></script>
        <script src="<?php echo url('/js/jquery.min.js'); ?>"></script>
        <script type="text/javascript">
            $("#radioinline2").change(function() {
                if (this.checked) {
                    $('#fiche_demande').hide();
                } else {
                    $('#fiche_demande').show();
                }
            });
            $("#radioinline2").trigger("change");
        </script>
        <script type="text/javascript">
            $("#radioinline1").change(function() {
                if (this.checked) {
                    $('#fiche_demande').show();
                } else {
                    $('#fiche_demande').hide();
                }
            });
            $("#radioinline1").trigger("change");
        </script>


    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/configuration/generale/typeStage_classe.blade.php ENDPATH**/ ?>