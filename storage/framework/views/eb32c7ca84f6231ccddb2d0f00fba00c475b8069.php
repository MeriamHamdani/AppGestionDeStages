<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">


            <div class="logo-wrapper"><a href=""><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo.png')); ?>"
                        alt=""></a></div>
            <div class="dark-logo-wrapper"><a href=""><img class="img-fluid"
                        src="<?php echo e(asset('assets/images/logo/dark-logo.png')); ?>" alt=""></a></div>

            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">
                </i></div>

        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav">
                <li>
                            <form class="g-6 needs-validation" novalidate="" method="POST"
                                  action="<?php echo e(route('filtre_par_an')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php if($errors->any()): ?>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo e($err); ?>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <div style="width: 200px" class="col-md-6 position-relative">
                                    <select class="js-example-basic-single col-sm-4" id="annee_universitaire"
                                            name="annee_universitaire"
                                            required>
                                        <option disabled="disabled" selected="selected">Année Universitaire
                                        </option>
                                        <?php $__currentLoopData = \App\Models\AnneeUniversitaire::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anneeUniv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($anneeUniv->id); ?>"  <?php echo e(old('annee_universitaire') == $anneeUniv->id ? 'selected' : ''); ?>>
                                                <?php echo e(ucwords($anneeUniv->annee)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="col-md-6 position-relative" style=" margin-left: 75px;padding-top: 3px">
                                        <button class="btn-sm btn-secondary " type="submit">OK</button>
                                    </div>
                                </div>

                            </form>
                </li>
                <?php if(session()->get('annee')): ?>
                <li>
                    <div class="onhover-dropdown p-0"><button class="btn-sm btn-secondary disabled:opacity-0"><?php echo e(session()->get('annee')->annee); ?></button></div>
                </li>
            <?php endif; ?>
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>


                <li class="onhover-dropdown p-0" style="margin-right: 8px">

                    <form method="GET" action="<?php echo e(route('deconnexion')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-primary-light" type="button" href=<?php echo e(route('deconnexion')); ?> onclick="event.preventDefault();
                        this.closest('form').submit();"><i data-feather="log-out"></i>Se Déconnecter</button>
                    </form>

                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
<?php $__env->startPush('css'); ?>
    .col-md-6 btn {
    margin-top: 25px;
    }
<?php $__env->stopPush(); ?>

<?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/layouts/admin/partials/header.blade.php ENDPATH**/ ?>