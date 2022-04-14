

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
                    <h5>Stage</h5>
                </div>
                <form class="form theme-form">
                    <div class="card-body">
                        <div class="alert alert-primary dark" role="alert">
                            <p><i class="icofont icofont-exclamation-tringle"></i>
                                Prière de télécharger la fiche de demande de stage, la remplir,
                                la signer avec le responsable de l entreprise ( avec cachet )
                                et la scanner puis la dépôser dans ce formulaire.</p>
                            <p> <a href="#"><strong style="color:white">Télécharger la fiche de demande de stage</strong></a></p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Le sujet</label>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Taper votre sujet..." type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="message-text">Type de sujet</label>
                                <select class="js-example-basic-single col-sm-12">
                                    <option value="0'">Séléctionner le type de sujet</option>
                                    <option value="0">PFE</option>
                                    <option value="1">BP</option>
                                    <option value="2">PT</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le nom de
                                        l'Encadrant</label>
                                    <select class="js-example-basic-single col-sm-12" id="encadrant">
                                        <option><a value="+" onclick="ajouterZoneTexte()">
                                                Choisir l'encadrant académique </a></option>
                                        <option>enseignant 1</option>
                                        <option>enseignant 2</option>
                                        <option>enseignant 3</option>
                                        <option>enseignant 4</option>
                                        <option>enseignant 5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Le nom de
                                        l'entreprise</label>
                                    <select class="js-example-basic-single col-sm-12" id="entreprise">
                                        <option><a value="+" onclick="ajouterZoneTexte()">
                                                Ajouter une entreprise </a></option>
                                        <option>a entreprise 1</option>
                                        <option>b entreprise 2</option>
                                        <option>c entreprise 3</option>
                                        <option>d entreprise 4</option>
                                        <option>e entreprise 5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Date début de stage</label>
                                    <input class="datepicker-here form-control digits" placeholder="mm/jj/aaaa" type="text" data-language="en" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Date fin de stage</label>
                                    <input class="datepicker-here form-control digits" placeholder="mm/jj/aaaa" type="text" data-language="en" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">La fiche de demande de stage scannée</label>
                                    <div class="mb-3">
                                        <input class="form-control" type="file" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Envoyer</button>
                        <input class="btn btn-light" type="reset" value="Annuler" />
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.etudiant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\stageApp\AppGestionDeStages\resources\views/etudiant/stage/demander_stage.blade.php ENDPATH**/ ?>