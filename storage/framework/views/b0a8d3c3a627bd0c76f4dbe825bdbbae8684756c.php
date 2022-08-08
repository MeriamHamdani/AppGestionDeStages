

<?php $__env->startSection('title'); ?>Ajouter Spécialité
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Ajouter une spécialité</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item">Ajouter une spécialité</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ajouter une spécialité</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate="" method="POST"
                              action="<?php echo e(route('sauvegarder_specialite')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php if($errors->any()): ?>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo e($err); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Code spécialité</label>
                                <input class="form-control" id="code" name="code" type="text"
                                       value="<?php echo e(old('code')); ?>" required=""
                                       placeholder="entrez le code de spécialité......"/>
                                <div class="invalid-tooltip">Entrez le code de spécialité svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Nom spécialité</label>
                                <input class="form-control" id="nom" name="nom" type="text"
                                       value="<?php echo e(old('nom')); ?>" required=""
                                       placeholder="entrez lenom du spécialité..."/>
                                <div class="invalid-tooltip">Entrez le nom du spécialité svp!</div>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Formation</label>
                                <select class="js-example-basic-single col-sm-12" id="cycle" name="cycle"
                                        value="<?php echo e(old('cycle')); ?>" required>
                                    <option disabled="disabled" selected="selected">Sélectionnez le type de formation
                                    </option>
                                    <option
                                        value="licence" <?php echo e(old('cycle') == "licence" ? 'selected' : ''); ?>>
                                        Licence
                                    </option>
                                    <option
                                        value="master" <?php echo e(old('cycle') == "master" ? 'selected' : ''); ?>>
                                        Mastère
                                    </option>
                                    <option
                                        value="doctorat" <?php echo e(old('cycle') == "doctorat" ? 'selected' : ''); ?>>
                                        Doctorat
                                    </option>
                                    <option
                                        value="ingénierie" <?php echo e(old('cycle') == "ingeniorat" ? 'selected' : ''); ?>>
                                        Ingénierie
                                    </option>
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le cycle svp!</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltip01">Département</label>
                                <select class="js-example-basic-single col-sm-12" id="departement_id"
                                        name="departement_id" required>
                                    <option disabled="disabled" selected="selected">Sélectionnez le département</option>
                                    <?php $__currentLoopData = \App\Models\Departement::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($departement->id); ?>"
                                            <?php echo e(old('departement_id') == $departement->id ? 'selected' : ''); ?>

                                        ><?php echo e(ucwords($departement->nom)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le département svp!</div>
                            </div>

                            <div class="col-md-6 position-relative ">
                                <label class="form-label" for="validationTooltip01">Responsable</label>
                                <select class="js-example-basic-single col-sm-12" id="enseignant_id"
                                        name="enseignant_id" >
                                    <option disabled="disabled" selected="selected">Sélectionnez le responsable</option>
                                    <?php $__currentLoopData = \App\Models\Enseignant::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enseignant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($enseignant->id); ?>"
                                            <?php echo e(old('enseignant_id') == $enseignant->id ? 'selected' : ''); ?>

                                        ><?php echo e(ucwords($enseignant->nom)); ?> <?php echo e(ucwords($enseignant->prenom)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le responsable svp!</div>
                            </div>

                            <div class="card-footer text-end">
                                <a class="btn btn-light" href="<?php echo e(route('liste_specialites')); ?>">Annuler</a>
                                <button class="btn btn-primary" type="submit">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>

    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/etablissement/specialite/ajouter_specialite.blade.php ENDPATH**/ ?>