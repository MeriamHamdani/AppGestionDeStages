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

                                                            <h6 class="d-block"><?php echo e(ucwords($notifiable->nom)); ?>&nbsp;<?php echo e(ucwords($notifiable->prenom)); ?></h6>

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

                                                <?php if($post!='etudiant'): ?>
                                                <div class="read-group">

                                                    <p>
                                                        <?php if($post!='encadrant'): ?>


                                                        Vous etes affecté(e) comme <?php echo e($post); ?> pour la soutenance de
                                                        l'étudiant(e) "<?php echo e(ucwords($etudiant->nom)); ?>&nbsp;<?php echo e(ucwords($etudiant->prenom)); ?>"", inscrit au "<?php echo e(App\Models\Classe::find($etudiant->classe_id)->nom); ?>".<br>
                                                        <hr>
                                                        Le planning est comme suit:

                                                        <?php else: ?>
                                                        Le planning de soutenance de l'étudiant(e) "
                                                        <?php echo e(ucwords($etudiant->nom)); ?>&nbsp;<?php echo e(ucwords($etudiant->prenom)); ?>" qui vous le supervise et qui est
                                                        inscrit au <?php echo e(App\Models\Classe::find($etudiant->classe_id)->nom); ?>, est comme
                                                        suit:
                                                        <?php endif; ?>
                                                        <br>
                                                        <strong>Date : </strong><?php echo e($soutenance->date); ?> <br>
                                                        <strong> Salle :</strong> <?php echo e($soutenance->salle); ?><br>
                                                        <strong>Heure : </strong><?php echo e($soutenance->start_time); ?><br>
                                                        <?php if($post!='encadrant'): ?>
                                                        <strong>Encadrant :</strong> <?php echo e($encadrant); ?><br>
                                                        <?php endif; ?>
                                                        <?php if($post!='president'): ?>
                                                        <?php
                                                        $pres=App\Models\Enseignant::find($soutenance->president_id);
                                                        ?>
                                                        <strong>Président de jury :</strong> <?php echo e(ucwords($pres->nom)); ?>&nbsp;<?php echo e(ucwords($pres->prenom)); ?><br>
                                                        <?php endif; ?>
                                                        <?php if($post!='rapporteur'): ?>
                                                        <?php
                                                        $rap=App\Models\Enseignant::find($soutenance->rapporteur_id);
                                                        ?>
                                                        <strong>Rapporteur :</strong> <?php echo e(ucwords($rap->nom)); ?>&nbsp;<?php echo e(ucwords( $rap->prenom )); ?><br>
                                                        <?php endif; ?>
                                                        <?php if($post!='membre'): ?>
                                                        <?php
                                                        $mem=App\Models\Enseignant::find($soutenance->deuxieme_membre_id);
                                                        ?>
                                                        <strong>Le 2ème membre :</strong>
                                                        <?php if($soutenance->deuxieme_membre_id!=null): ?>
                                                        <?php echo e(ucwords($mem->nom)); ?>&nbsp;<?php echo e(ucwords($mem->prenom)); ?>

                                                        <?php else: ?>
                                                        -----
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                    </p>

                                                    <p class="m-t-10">
                                                    </p>
                                                    <p>Cordialement</p>
                                                </div>
                                                <?php else: ?>
                                                <div class="read-group">
                                                    <?php
                                                    $mem=App\Models\Enseignant::find($soutenance->deuxieme_membre_id);
                                                    $rap=App\Models\Enseignant::find($soutenance->rapporteur_id);
                                                    $pres=App\Models\Enseignant::find($soutenance->president_id);
                                                    ?>
                                                    <p>

                                                        Le Planning de votre soutenance est comme suit : <br>

                                                        Date : <?php echo e($soutenance->date); ?> <br>
                                                        Salle : <?php echo e($soutenance->salle); ?><br>
                                                        Heure : <?php echo e($soutenance->start_time); ?><br>
                                                        <strong>Encadrant : </strong><?php echo e($encadrant); ?><br>

                                                        <strong>Président de jury : </strong><?php echo e(ucwords($rap->nom)); ?>&nbsp;<?php echo e(ucwords( $pres->prenom )); ?><br>
                                                        <strong>Rapporteur :</strong> <?php echo e(ucwords($rap->nom)); ?>&nbsp;<?php echo e(ucwords($rap->prenom)); ?><br>
                                                        <strong>Le 2ème membre :
                                                        </strong><?php if($soutenance->deuxieme_membre_id!=null): ?>
                                                        <?php echo e(ucwords($mem->nom)); ?>&nbsp;<?php echo e(ucwords($mem->prenom)); ?>

                                                        <?php else: ?>
                                                        -----
                                                        <?php endif; ?>
                                                    </p>

                                                    <p class="m-t-10">
                                                    </p>
                                                    <p>Cordialement</p>
                                                </div>
                                                <?php endif; ?>
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
<?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/emails/soutenance.blade.php ENDPATH**/ ?>