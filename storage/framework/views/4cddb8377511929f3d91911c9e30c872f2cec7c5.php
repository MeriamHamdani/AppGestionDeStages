

<?php $__env->startSection('title'); ?>Gestion des etudiants
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatable-extension.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">


<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Gestion des etudiants</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Etablissement</li>
        <li class="breadcrumb-item">Gestion des étudiants</li>

    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>La liste des etudiants</h5>
                        <div style="padding-left: 2px">
                            <a href=<?php echo e(route('ajouter_etudiant')); ?> >
                                <i class="text-right" aria-hidden="true">
                                    <button class="btn btn-pill btn-success btn-sm pull-right" type="button">
                                        Ajouter un étudiant
                                    </button>
                                </i>
                            </a>
                            <a href=#>
                                <i class="text-right" aria-hidden="true">
                                    <button class="btn btn-pill btn-success btn-sm pull-right" type="button"
                                            data-bs-toggle="modal" data-bs-target="#export"
                                            data-whatever="@getbootstrap">
                                        Exporter des étudiants
                                    </button>
                                    <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Exporter la liste des etudiants</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Fermez"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="mb-3">
                                                            <label class="col-form-label" for="recipient-name">Exporter selon la Classe</label>
                                                            <div class="mb-2">
                                                                <select class="js-example-basic-single col-sm-12">
                                                                    <option value="0">Sélectionnez la classe</option>
                                                                    <option value="1">1 master Info</option>
                                                                    <option value="2">2 LCS</option>
                                                                    <option value="3">3 LM</option>
                                                                    <option value="4">2 MF</option>
                                                                </select>
                                                            </div>
                                                            <button class="btn btn-primary" type="button">Exporter</button>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="col-form-label" for="recipient-name">Exporter selon la Spécialité</label>
                                                            <div class="mb-2">
                                                                <select class="js-example-basic-single col-sm-12">
                                                                    <option value="0">Sélectionnez la spécialité</option>
                                                                    <option value="1">Info</option>
                                                                    <option value="2">Comptabilité</option>
                                                                    <option value="3">Finance</option>
                                                                    <option value="4">Eco</option>
                                                                </select>
                                                            </div>
                                                            <button class="btn btn-primary" type="button">Exporter</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Annuler</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </i>
                            </a>
                            <a href=#>
                                <i class="text-right" aria-hidden="true">
                                    <button class="btn btn-pill btn-success btn-sm pull-right" type="button"
                                            data-bs-toggle="modal" data-bs-target="#import"
                                            data-whatever="@getbootstrap">
                                        Importer des étudiants
                                    </button>
                                    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Importer la liste des etudiants</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="mb-3">
                                                            <label class="col-form-label" for="recipient-name">Classe</label>
                                                            <div class="mb-2">
                                                                <select class="js-example-basic-single col-sm-12">
                                                                    <option value="0">Sélectionnez la classe</option>
                                                                    <option value="1">1 master Info</option>
                                                                    <option value="2">2 LCS</option>
                                                                    <option value="3">3 LM</option>
                                                                    <option value="4">2 MF</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="col-form-label" for="message-text">Fichier CSV</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" type="file" />
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Annuler</button>
                                                    <button class="btn btn-primary" type="button">Importer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="dt-ext table-responsive">

                            <table class="display" id="auto-fill">
                                <thead>
                                <tr>
                                    <th>CIN</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Classe</th>
                                    <th>Adresse e-mail</th>
                                    <th>Téléphone</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>123456</td>
                                    <td>Ben Foulen</td>
                                    <td>Foulen</td>
                                    <td>2 LSC</td>
                                    <td>foulene@benfoulen.com</td>
                                    <td>888888</td>
                                    <td><a class=" btn btn-icon-only default" href="#" data-placement="top"
                                           data-toggle="tooltip" title="Désactiver"><img
                                                src="<?php echo e(asset('assets/images/userActive.png')); ?>">

                                        </a>
                                    </td>
                                    <td class="text-center">

                                        <a href="<?php echo e(route('modifier_etudiant')); ?>"> <i style="font-size: 1.3em;"
                                                                                         class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>987456</td>
                                    <td>Ben Foulen</td>
                                    <td>Foulena</td>
                                    <td>3 MP CI</td>
                                    <td>foulena@benfoulen.com</td>
                                    <td>666666</td>
                                    <td><a class=" btn btn-icon-only default" href="#" data-placement="top"
                                           data-toggle="tooltip" title="Désactiver"><img
                                                src="<?php echo e(asset('assets/images/userActive.png')); ?>">

                                        </a>
                                    </td>
                                    <td class="text-center">

                                        <a href="<?php echo e(route('modifier_etudiant')); ?>"> <i style="font-size: 1.3em;"
                                                                                         class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>5656985</td>
                                    <td>Foulen</td>
                                    <td>Foulen</td>
                                    <td>3 IAA</td>
                                    <td>foulene@foulen.com</td>
                                    <td>55555</td>
                                    <td> <a class=" btn btn-icon-only default" href="#" data-placement="top"
                                            data-toggle="tooltip" title="Désactiver"><img
                                                src="<?php echo e(asset('assets/images/usercancled.png')); ?>">

                                        </a></td>
                                    <td class="text-center">

                                        <a href="<?php echo e(route('modifier_etudiant')); ?>"> <i style="font-size: 1.3em;"
                                                                                         class='fa fa-edit'></i></a>
                                        <a href="#"> <i style="font-size: 1.3em;" class='fa fa-trash'></i></a>

                                    </td>

                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>CIN</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Classe</th>
                                    <th>Adresse e-mail</th>
                                    <th>Téléphone</th>
                                    <th>Statut</th>
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

        <script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/icons/icons-notify.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/icons/feather-icon/feather-icon-clipart.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/jszip.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/pdfmake.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/vfs_fonts.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.print.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatable-extension/custom.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\stageApp\AppGestionDeStages\resources\views/admin/etablissement/etudiant/liste_etudiants.blade.php ENDPATH**/ ?>