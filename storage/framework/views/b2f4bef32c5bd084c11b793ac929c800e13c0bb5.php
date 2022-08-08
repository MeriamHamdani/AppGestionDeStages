

<?php $__env->startSection('title'); ?>Demander un stage
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatable-extension.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/date-picker.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Le formulaire de demande de stage</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Stage</li>
        <li class="breadcrumb-item active">Demander un stage</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Demander un Stage</h5>
                    </div>
                    <form class="form theme-form" action=<?php echo e(route('demander_stage')); ?> method="POST"
                          enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <?php if($errors->any()): ?>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo e($err); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if(($etudiant->classe->typeStage->fiche_demande) != null): ?>
                                <div class="alert alert-primary dark" role="alert">
                                    <p><i class="icofont icofont-exclamation-tringle"></i>
                                        Prière de télécharger la fiche de demande de stage, la remplir,
                                        la signer avec le responsable de l entreprise ( avec cachet )
                                        et la scanner puis la dépôser dans ce formulaire.</p>
                                    <p><a href="<?php echo e(route('telecharger_fiche_demande',$fiche_demande)); ?>">
                                            <u style="color:rgb(255, 255, 255)"><i class="icofont icofont-download-alt">Télécharger
                                                    la fiche de demande de stage</i></u>
                                        </a>
                                    </p>
                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <?php if($etudiant->classe->niveau != 1): ?>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Le sujet (champ non obligatoire)</label>
                                            <div class="mb-3">
                                                <input class="form-control" name="titre_sujet" id="titre_sujet"
                                                       placeholder="Taper votre sujet..." value="<?php echo e(old('titre_sujet')); ?>"
                                                       type="text"/>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(($etudiant->classe->niveau == 3 && $etudiant->classe->cycle=="licence") ||
                                    ($etudiant->classe->niveau == 2 && $etudiant->classe->cycle=="master")): ?>
                                    <div class="mb-3">
                                        <label class="form-label" for="type_sujet">Type de sujet</label>
                                        <select class="js-example-basic-single col-sm-12" name="type_sujet"
                                                id="type_sujet">
                                            <option disabled="disabled" selected="selected">Choisissez le type de
                                                sujet
                                            </option>
                                            <?php $__currentLoopData = $typesSujet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    value="<?php echo e($ts); ?>"
                                                    <?php echo e(old('type_sujet') == $ts ? 'selected' : ''); ?>><?php echo e($ts); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if(($etudiant->classe->niveau == 3 && $etudiant->classe->cycle=="licence") ||
                               ($etudiant->classe->niveau == 2 && $etudiant->classe->cycle=="master")  ): ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleFormControlSelect9">Le nom de
                                                l'Encadrant</label>
                                            <select class="js-example-basic-single col-sm-12" id="enseignant_id"
                                                    name="enseignant_id" required>
                                                <option disabled="disabled" selected="selected">Choisissez l'encadrant
                                                    académique
                                                </option>
                                                <?php $__currentLoopData = $enseignants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enseignant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                        value="<?php echo e($enseignant->id); ?>"
                                                        <?php echo e(old('enseignant_id') == $enseignant->id ? 'selected' : ''); ?>

                                                    ><?php echo e(ucwords($enseignant->nom)); ?> <?php echo e(ucwords($enseignant->prenom)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3" id="entrepriseDiv">
                                        <label class="form-label" for="entreprise">Le nom de
                                            l'entreprise</label>
                                        <select class="js-example-basic-single col-sm-12" name="entreprise"
                                                id="entreprise">
                                            <option disabled="disabled" selected="selected">Choisissez l'entreprise
                                            </option>
                                            <?php $__currentLoopData = $entreprises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entreprise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($entreprise->id); ?>"
                                                    <?php echo e(old('entreprise') == $entreprise->id ? 'selected' : ''); ?>><?php echo e($entreprise->nom); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="alert alert-secondary dark round-badge-info" role="alert">
                                    <p><i class="icofont icofont-exclamation-tringle"></i>
                                        Veillez choisir la période de votre stage incluse dans la période définie par le
                                        type de stage</p>
                                    <p> entre <strong><?php echo e($type_stage->date_debut_periode); ?></strong> et
                                        <strong><?php echo e($type_stage->date_limite_periode); ?> </strong></p>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlSelect9">Date début de
                                            stage</label>
                                        <input class="datepicker-here form-control digits" placeholder="mm/jj/aaaa"
                                               value="<?php echo e(old('date_debut')); ?>" type="text" data-language="en"
                                               name="date_debut" id="date_debut"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlSelect9">Date fin de
                                            stage</label>
                                        <input class="datepicker-here form-control digits" placeholder="mm/jj/aaaa"
                                               value="<?php echo e(old('date_fin')); ?>" type="text" data-language="en"
                                               name="date_fin" id="date_fin"/>
                                    </div>
                                </div>
                            </div>
                            <?php if(($etudiant->classe->typeStage->fiche_demande) != null): ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">La fiche de demande de stage scannée (Fiche d'encadrement)</label>
                                            <div class="mb-3">
                                                <input class="form-control" type="file" name="fiche_demande"
                                                       id="fiche_demande"
                                                       required="required" accept=".jpg,.jpeg,.png,.doc,.docx"/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(($etudiant->classe->typeStage->fiche_assurance_type== "requis")): ?>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label">La fiche d'assurance</label>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="file" name="fiche_assurance"
                                                               id="fiche_assurance" required accept=".jpg,.jpeg,.png,.doc,.docx" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            <?php endif; ?>
                                <?php if(($etudiant->classe->typeStage->fiche_2Dinars_type== "requis")): ?>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Fiche 2 Dinars</label>
                                                <div class="mb-3">
                                                    <input class="form-control" type="file" name="fiche_2Dinars"
                                                           id="fiche_2Dinars" required accept=".jpg,.jpeg,.png,.doc,.docx"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        <?php endif; ?>
                            <div class="card-footer text-end">
                                <input class="btn btn-light" type="reset" value="Annuler"/>
                                <button class="btn btn-primary" type="submit">Envoyer</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.en.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.custom.js')); ?>"></script>
        <script src="<?php echo url('/js/jquery.min.js'); ?>"></script>
        <script type="text/javascript">
            $("#type_sujet").change(function () {
                if ($(this).val() == "PFE") {
                    $('#entrepriseDiv').show();
                } else {
                    $('#entrepriseDiv').hide();
                }
            });
            $("#type_sujet").trigger("change");
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.etudiant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/etudiant/stage/demander_stage.blade.php ENDPATH**/ ?>