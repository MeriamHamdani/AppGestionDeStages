<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<div class="container-fluid">
    <div class="email-wrap">
        <div class="row">

            <div class="col-xl-9 col-md-12 xl-60">
                <div class="email-right-aside">
                    <div class="card email-body">
                        <div class="email-profile">
                            <div class="email-right-aside">
                                <div class="email-body">
                                    <div class="email-content">
                                        <div class="email-top">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="media">
                                                        <img class="me-3 rounded-circle"
                                                            src="<?php echo e(asset('assets/images/user/user.png')); ?>" alt="" />
                                                        <div class="media-body">
                                                            <h6 class="d-block"><?php echo e($data['nom_ens']); ?></h6>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="email-wrapper">
                                            <div class="emailread-group">
                                                <div class="read-group">
                                                    <p>Bonjour Mme/Mr</p>

                                                </div>
                                                <div class="read-group">

                                                    <p>
                                                        Vous avez une demande d'encadrement de la part de <?php echo e($data['nom_etud']); ?>

                                                        étudiant(e) au <?php echo e($data['classe_etud']); ?> à l'<?php echo e($data['etablissement']); ?>.


                                                    </p>
                                                    <p class="m-t-10">
                                                        Merci de consulter votre compte sur l'application pour pouvoir
                                                        bien répondre à cette demande par l'acceptation ou par
                                                        le refus.</p>
                                                    <p>Cordialement</p>
                                                </div>
                                            </div>

                                            <!--<div class="emailread-group">
                                                <div class="action-wrapper">
                                                    <ul class="actions">
                                                        <li>
                                                            <a class="btn btn-primary" href="javascript:void(0)"><i
                                                                    class="fa fa-reply me-2"></i>confirmer</a>
                                                        </li>

                                                        <li>
                                                            <a class="btn btn-danger" href="javascript:void(0)"><i
                                                                    class="fa fa-share me-2"></i>refuser</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/editor/ckeditor/ckeditor.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/editor/ckeditor/adapters/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/email-app.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\AppGestionDeStages\resources\views/emails/confirmationEncadrement.blade.php ENDPATH**/ ?>