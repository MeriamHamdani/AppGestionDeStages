<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <?php echo e($breadcrumb_title ?? ''); ?>

                <ol class="breadcrumb">

                    <!--<li class="breadcrumb-item"><a href="">Accueil</a></li>-->

                    <?php echo e($slot ?? ''); ?>

                </ol>
            </div>
            <div class="col-lg-6">

            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/components/breadcrumb.blade.php ENDPATH**/ ?>