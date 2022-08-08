

<?php $__env->startSection('title'); ?>Configuration session de dépôt
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/date-picker.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/buttonload.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Session de dépôt</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Dépôt</li>
        <li class="breadcrumb-item">Ouvrir Session</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ouvrir et configurer une session de dépôt</h5>
                    </div>
                    <div class="card-body">
                        <form class="f1" method="POST"
                              action="<?php echo e(route('new_session_depot')); ?>"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if($errors->any()): ?>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo e($err); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <div class="f1-steps">
                                <div class="f1-progress">
                                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"></div>
                                </div>
                                <div class="f1-step active">
                                    <div class="f1-step-icon"><i class="fa fa-list"></i></div>
                                    <p>Classes</p>
                                </div>
                                <div class="f1-step ">
                                    <div class="f1-step-icon"><i class="fa fa-calendar"></i></div>
                                    <p>Date début de session</p>
                                </div>
                                <div class="f1-step">
                                    <div class="f1-step-icon"><i class="fa fa-calendar"></i></div>
                                    <p>Date fin de session</p>
                                </div>
                            </div>
                            <fieldset>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-type-stage">Liste des types de stage</label>
                                    <?php $__currentLoopData = $tpStg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(($ts->date_debut_depot == null) && ($ts->date_limite_depot == null)): ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="d-block"
                                                           for="f1-type-stage"><input
                                                            class="checkbox_animated"
                                                            id="f1-type-stage"
                                                            type="checkbox"
                                                            name="type_stages[]"
                                                            value=<?php echo e($ts->id); ?>>
                                                        <?php echo e($ts->nom); ?></label>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="f1-buttons">
                                    <button class="btn btn-primary btn-next" type="button">Suivant</button>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label for="f1-dat-debut">Date début dépôt</label>
                                    <input class="datepicker-here form-control digits date-picker"
                                           name="date_debut_depot"
                                           id="f1-dat-debut"
                                           type="text" data-language="en" data-multiple-dates-separator=", "
                                           data-position="top left" placeholder="date début"/>
                                </div>
                                <div class="f1-buttons">
                                    <button class="btn btn-secondary btn-previous" type="button">Retour</button>
                                    <button class="btn btn-primary btn-next" type="button">Suivant</button>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label for="f1-date-limite">Date limite dépôt</label>
                                    <input class="datepicker-here form-control digits date-picker"
                                           name="date_limite_depot"
                                           id="f1-date-limite"
                                           type="text" data-language="en" data-multiple-dates-separator=", "
                                           data-position="top left" placeholder="date limite"/>
                                </div>

                                <div class="f1-buttons">
                                    <button class="btn btn-secondary btn-previous" type="button">Retour</button>
                                    <button class="btn btn-primary btn-submit" type="submit">Valider</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
                integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="<?php echo e(asset('assets/js/form-wizard/form-wizard-three.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/form-wizard/jquery.backstretch.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/icons/icons-notify.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/icons/icon-clipart.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.en.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
        <?php if(Session::has('message')): ?>
            <?php if(Session::get('message')=="l'intervalle des dates est invalide"): ?>
                <script>
                    swal('Oups', "l'intervalle des dates est invalide", 'error', {
                        button: 'Réssayer'
                    })
                </script>
            <?php endif; ?>
        <?php endif; ?>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/configuration/generale/config_session_depot.blade.php ENDPATH**/ ?>