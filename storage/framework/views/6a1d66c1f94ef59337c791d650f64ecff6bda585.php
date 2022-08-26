

<?php $__env->startSection('title'); ?>Dépôt
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/buttonload.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Dépôt</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Dépôt</li>
<li class="breadcrumb-item">Gérer les dépôts</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Listes des demandes de dépôt</h5>
                </div>
                <a href="#">
                    <i class="text-right" aria-hidden="true">
                        <button class="btn btn-pill btn-success pull-right" type="button"
                                style="margin-right: 0.5cm" data-bs-toggle="modal" data-bs-target="#liste_stnc"
                                data-whatever="@getbootstrap">
                           Exporter la liste des mémoires déposés
                        </button>
                        <div class="modal fade" id="liste_stnc" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> Exporter la liste des mémoires déposés</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Fermez"></button>
                                    </div>
                                    <form method="POST" action="<?php echo e(route('exporter_liste_depots')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="recipient-name">Selon la
                                                    Classe-Spécialité</label>
                                                <div class="mb-2">
                                                        <select class="js-example-basic-single col-sm-12"
                                                                id="classe_id" name="classe_id" required>
                                                            <option value="tous" selected="selected">
                                                                Exportez tous
                                                            </option>
                                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($classe->id); ?>" <?php echo e(old('classe_id')==$classe->id ? 'selected' :
                                                                ''); ?>

                                                            ><?php echo e(ucwords($classe->nom)); ?> </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                    data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary"
                                                    type="button">Télécharger</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </i>
                </a>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="advance-1">
                            <thead>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Classe</th>
                                    <th>Déposé le</th>
                                    <th>Encadrant</th>
                                    <th>Confirmation de l'encadrant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead> <!--dd(App\Models\DepotMemoire::find(5)->memoire)-->
                            <tbody>
                            <?php $__currentLoopData = $demandesDepotC; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($demande->titre); ?></td>
                                    <td><?php echo e(ucwords($demande->stage->etudiant->prenom)); ?> <?php echo e(ucwords($demande->stage->etudiant->nom)); ?></td>
                                    <td><?php echo e($demande->stage->etudiant->classe->code); ?></td>
                                    <td><?php echo e($demande->date_depot); ?></td>
                                    <td><?php echo e(ucwords($demande->stage->enseignant->prenom)); ?> <?php echo e(ucwords($demande->stage->enseignant->nom)); ?></td>
                                    <?php if($demande->validation_encadrant == -1): ?>
                                    <td class="text-center">
                                        <button class="buttonload btn btn-warning btn-sm" data-toggle="tooltip" title="demande en attente">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </button>
                                    </td>
                                    <?php elseif($demande->validation_encadrant == 0): ?>
                                        <td class="text-center">
                                            <button class="buttonload btn btn-danger btn-sm" data-toggle="tooltip" title="demande refusée en attente de mise à jour">
                                                <i class="icofont icofont-close-squared icon-large"></i>
                                            </button>
                                        </td>
                                    <?php elseif($demande->validation_encadrant == 1): ?>
                                        <td class="text-center">
                                            <button class="buttonload btn btn-primary btn-sm" data-toggle="tooltip" title="demande validée">
                                                <i class="icofont icofont-checked icon-large"></i>
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('telecharger_memoire_adm',['memoire'=>$demande->memoire,
                                                                                'code_classe'=>$demande->stage->etudiant->classe->code,'stage'=>$demande->stage])); ?>" data-toggle="tooltip"
                                            data-original-title="Télécharger le mémoire" title="Télécharger le mémoire">
                                            <i class="icofont icofont-papers icon-large" style="color: #8a6d3b"></i></a>
                                        <a href="<?php echo e(route('telecharger_fiche_plagiat',['fiche_plagiat'=>$demande->fiche_plagiat,
                                                                                'code_classe'=>$demande->stage->etudiant->classe->code,'stage'=>$demande->stage])); ?>" data-toggle="tooltip"
                                           data-original-title="Télécharger le fiche plagiat" title="Télécharger le fiche plagiat">
                                            <i class="icofont icofont-paper icon-large" style="color: #8a6d3b"></i></a>
                                        <a href="<?php echo e(route('telecharger_fiche_biblio',['fiche_biblio'=>$demande->fiche_biblio,
                                                                                'code_classe'=>$demande->stage->etudiant->classe->code,'stage'=>$demande->stage])); ?>" data-toggle="tooltip"
                                           data-original-title="Télécharger le fiche biblio" title="Télécharger le fiche biblio">
                                            <i class="icofont icofont-file-text icon-large" style="color: #8a6d3b"></i></a> <br>
                                        <?php if(isset($demande->attestation) && isset($demande->fiche_tech)): ?>
                                            <a href="<?php echo e(route('telecharger_fiche_tech',['fiche_tech'=>$demande->fiche_tech,
                                                                                'code_classe'=>$demande->stage->etudiant->classe->code,'stage'=>$demande->stage])); ?>" data-toggle="tooltip"
                                               data-original-title="Télécharger le fiche technique" title="Télécharger le fiche technique">
                                                <i class="icofont icofont-ui-copy icon-large" style="color: #8a6d3b"></i></a>
                                            <a href="<?php echo e(route('telecharger_attestation',['attestation'=>$demande->attestation,
                                                                                'code_classe'=>$demande->stage->etudiant->classe->code,'stage'=>$demande->stage])); ?>" data-toggle="tooltip"
                                               data-original-title="Télécharger l'attestation" title="Télécharger l'attestation">
                                                <i class="icofont icofont-ui-file icon-large" style="color: #8a6d3b"></i></a><br>
                                        <?php endif; ?>
                                        <?php if($demande->validation_admin == -1): ?>
                                        <a href="<?php echo e(route('valider_par_admin',['demande_depot'=>$demande])); ?>" data-title="Valider le dépôt du mémoire" data-toggle="tooltip"
                                            title="Valider le dépôt du mémoire">
                                            <i class="icofont icofont-checked icon-large"></i></a>
                                            <a href="<?php echo e(route('refuser_par_admin',['demande_depot'=>$demande])); ?>" data-title="Refuser le dépôt du mémoire" data-toggle="tooltip"
                                               title="Refuser le dépôt du mémoire" style="color: darkred">
                                                <i class="icofont icofont-close-squared icon-large"></i></a>

                                       <!-- <a href="#" data-title="Refuser le dépôt du mémoire" data-toggle="tooltip"
                                            title="Refuser le dépôt du mémoire" style="color: darkred">
                                            <i class="icofont icofont-close-squared icon-large"></i></a> -->
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Titre de sujet</th>
                                    <th>Etudiant</th>
                                    <th>Classe</th>
                                    <th>Déposé le</th>
                                    <th>Encadrant</th>
                                    <th>Confirmation de l'encadrant</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php if(Session::has('message')): ?>
    <?php if(Session::get('message')=='attend validation encadrant'): ?>

        <script>
            swal('Erreur', "Validation d'encadrant requise!", 'error', {
                button: 'Ok'
            })

        </script>
    <?php endif; ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/depot/gerer_depot.blade.php ENDPATH**/ ?>