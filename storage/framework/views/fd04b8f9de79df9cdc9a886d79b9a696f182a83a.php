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

                                                    <p>
                                                       Vous avez une demande de dépôt de mémoire de la part de l'étudiant(e)
                                                        <?php echo e($data['nom_etud']); ?> inscrit(e) à la classe <?php echo e($data['classe_etud']); ?>


                                                    </p>
                                                    <p class="m-t-10">
                                                      Veuillez consulter votre espace dans la plateforme pour télécharger le mémoire déposé et mettre votre décision.</p>
                                                    <p>Cordialement</p>
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
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/editor/ckeditor/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/editor/ckeditor/adapters/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/email-app.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/emails/enseignant/demandeDepotMemoire.blade.php ENDPATH**/ ?>