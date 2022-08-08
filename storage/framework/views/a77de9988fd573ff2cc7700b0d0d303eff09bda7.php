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
                                                            <h6 class="d-block"><?php echo e($data['nom_etud']); ?></h6>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="email-wrapper">
                                            <div class="emailread-group">
                                                <div class="read-group">

                                                    <p>
                                                       Une session de dépôt de mémoire est ouverte de  <?php echo e($data['date_debut_depot']); ?> jusqu'à <?php echo e($data['date_limite_depot']); ?>


                                                    </p>
                                                     Vous devez respecter cet intervalle et déposer votre mémoire et les fichiers nécessaires dans les délais.</p>
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
<?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/emails/etudiant/sessionOuverte.blade.php ENDPATH**/ ?>