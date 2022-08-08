

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
                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate="" method="POST" action="<?php echo e(route('sauvegarder_etudiant')); ?>">
                                <?php echo csrf_field(); ?>
                            <?php if($errors->any()): ?>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo e($err); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Numero CIN/Passeport</label>
                                <input class="form-control" id="numero_CIN" name="numero_CIN" type="number"
                                       value="<?php echo e(old('numero_CIN')); ?>" required="" placeholder="entrez le num cin..."/>
                                <div class="invalid-tooltip">Entrez le N°CIN svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Nom</label>
                                <input class="form-control" id="nom" name="nom" type="text"
                                       value="<?php echo e(old('nom')); ?>" required=""
                                       placeholder="entrez le nom de l'étudiant..."/>
                                <div class="invalid-tooltip">Entrez le nom svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Prénom</label>
                                <input class="form-control" id="prenom" name="prenom" type="text"
                                       value="<?php echo e(old('prenom')); ?>" required=""
                                       placeholder="entrez le prénom de létudiant..."/>
                                <div class="invalid-tooltip">Entrez le prénom svp!</div>
                            </div>

                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Email</label>
                                <input class="form-control" id="email" name="email" type="email"
                                       value="<?php echo e(old('email')); ?>" required=""
                                       placeholder="entrez l'email de l'étudiant..."/>
                                <div class="invalid-tooltip">Entrez l'email svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Numero de téléphone</label>
                                <input class="form-control" id="numero_telephone" name="numero_telephone" type="number"
                                       value="<?php echo e(old('numero_telephone')); ?>" required=""
                                       placeholder="entrez le numéro de téléphone de l'étudiant..."/>
                                <div class="invalid-tooltip">Entrez le N° de téléphone svp!</div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label class="form-label" for="validationTooltip01">Classe</label>
                                <select class="js-example-basic-single col-sm-12" id="classe_id" name="classe_id" required>
                                    <option disabled="disabled" selected="selected">Sélectionnez la classe</option>
                                    <?php $__currentLoopData = \App\Models\Classe::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($classe->id); ?>"
                                            <?php echo e(old('classe_id') == $classe->id ? 'selected' : ''); ?>>
                                            <?php echo e(ucwords($classe->nom)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-tooltip">Séléctionnez le classe svp!</div>
                            </div>

                            <div class="card-footer text-end">
                                <a class="btn btn-light" href="<?php echo e(route('liste_etudiants')); ?>">Annuler</a>
                                <button class="btn btn-primary" type="submit">Ajouter</button>
                            </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/etablissement/etudiant/ajouter_etudiant.blade.php ENDPATH**/ ?>