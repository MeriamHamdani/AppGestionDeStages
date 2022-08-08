

<?php $__env->startSection('title'); ?>Ajouter Enseignant
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Ajouter un enseignant</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Administration</li>
<li class="breadcrumb-item">Ajouter un enseignant</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Ajouter un enseignant</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3 needs-validation" novalidate="" method="POST"
                        action="<?php echo e(route('sauvegarder_enseignant')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php if($errors->any()): ?>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo e($err); ?>

                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Numero CIN</label>
                            <input class="form-control" id="numero_CIN" name="numero_CIN" type="number"
                                value="<?php echo e(old('numero_CIN')); ?>" required="" placeholder="entrez le num cin..." />
                            <div class="invalid-tooltip">Entrez le N°CIN svp!</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Nom</label>
                            <input class="form-control" id="nom" name="nom" type="text" value="<?php echo e(old('nom')); ?>"
                                required="" placeholder="entrez le nom de l'enseignant..." />
                            <div class="invalid-tooltip">Entrez le nom svp!</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label class="form-label" for="validationTooltip01">Prénom</label>
                            <input class="form-control" id="prenom" name="prenom" type="text" value="<?php echo e(old('prenom')); ?>"
                                required="" placeholder="entrez le prénom de l'enseignant..." />
                            <div class="invalid-tooltip">Entrez le prénom svp!</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Numero de téléphone</label>
                            <input class="form-control" id="numero_telephone" name="numero_telephone" type="number"
                                value="<?php echo e(old('numero_telephone')); ?>" required=""
                                placeholder="entrez le numéro de téléphone..." />
                            <div class="invalid-tooltip">Entrez le N° de téléphone svp!</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Email</label>
                            <input class="form-control" id="email" name="email" type="email" value="<?php echo e(old('email')); ?>"
                                required="" placeholder="entrez l'email de l'enseignant..." />
                            <div class="invalid-tooltip">Entrez l'email svp!</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Grade</label>
                            <select class="js-example-basic-single col-sm-12" id="grade" name="grade"
                                value="<?php echo e(old('grade')); ?>" required>
                                <option disabled="disabled" selected="selected">Sélectionnez le grade
                                </option>
                                <option value="maître assistant" <?php echo e(old('grade')=="maitre assistant" ? 'selected' : ''); ?>>
                                    Maître assistant
                                </option>
                                <option value="maître de conférence" <?php echo e(old('grade')=="maitre de conférence"
                                    ? 'selected' : ''); ?>>
                                    Maître de conférence
                                </option>
                                <option value="professeur" <?php echo e(old('grade')=="professeur" ? 'selected' : ''); ?>>
                                    Professeur
                                </option>
                                <option value="assistant" <?php echo e(old('grade')=="assistant" ? 'selected' : ''); ?>>
                                    Assistant
                                </option>
                                <option value="expert" <?php echo e(old('grade')=="expert" ? 'selected' : ''); ?>>
                                    Expert
                                </option>
                            </select>
                            <div class="invalid-tooltip">Séléctionnez le grade svp!</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Département</label>
                            <select class="js-example-basic-single col-sm-12" id="departement_id" name="departement_id"
                                required>
                                <option disabled="disabled" selected="selected">Sélectionnez le
                                    département
                                </option>
                                <?php $__currentLoopData = \App\Models\Departement::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($departement->id); ?>" <?php echo e(old('departement_id')==$departement->id ?
                                    'selected' : ''); ?>

                                    ><?php echo e(ucwords($departement->nom)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="invalid-tooltip">Séléctionnez le Département svp!</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">RIB</label>
                            <input class="form-control" id="rib" name="rib" type="number" value="<?php echo e(old('rib')); ?>"
                                required="" placeholder="entrez le RIB..." />
                            <div class="invalid-tooltip">Entrez le RIB svp!</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip01">Identifiant</label>
                            <input class="form-control" id="identifiant" name="identifiant" type="number"
                                value="<?php echo e(old('identifiant')); ?>" required="" placeholder="entrez l'identifiant..." />
                            <div class="invalid-tooltip">Entrez l'identifiant svp!</div>
                        </div>

                        <div class="card-footer text-end">
                            <a class="btn btn-light" href="<?php echo e(route('liste_enseignants')); ?>">Annuler</a>
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php $__env->startPush('scripts'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>

        <?php if(Session::has('message')): ?>
        <script>
            toastr.success("<?php echo Session::get('message'); ?>")
        </script>
        <?php endif; ?>
        <?php if(Session::has('message')): ?>
        <script>
            swal('Bien', Session::get('message'), {
                //button: 'Continuer',
                showConfirmButton: false,
                timer: 2500
            })

        </script>
        <?php endif; ?>
        <?php $__env->stopPush(); ?>

        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/etablissement/enseignant/ajouter_enseignant.blade.php ENDPATH**/ ?>