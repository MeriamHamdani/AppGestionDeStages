<?php $__env->startSection('title'); ?>Base inputs
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Ajouter une entreprise</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Entreprise</li>
<li class="breadcrumb-item">Ajouter une entreprise</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Ajouter une entreprise</h5>
                </div>
                <form class="form theme-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <div class="alert alert-primary dark" role="alert">
                                        <p><i class="icofont icofont-exclamation-tringle"></i>
                                            Vérifiez tout d'abord l'existance du nom d'entreprise dans la liste!!</p>
                                        <p>Pour consulter la liste des entreprises <a
                                                href="<?php echo e(route('liste_entreprises')); ?>"
                                                style="color:white"><strong>cliquez ici </strong></a></p>
                                    </div>
                                    <label class="form-label" for="exampleFormControlInput1">Nom de l'entreprise</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        placeholder="entrez le nom de l'entreprise" />
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Adresse</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                           placeholder="entrez l'adresse de l'entreprise" />
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Email</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="email"
                                           placeholder="entrez l'adresse email de l'entreprise" />
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Téléphone</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="number"
                                           placeholder="entrez le numéro de téléphone de l'entreprise" />
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Valider</button>
                        <input class="btn btn-light" type="reset" value="Annuler" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.etudiant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\gestionDesStages\resources\views/etudiant/entreprise/ajouter_entreprise.blade.php ENDPATH**/ ?>