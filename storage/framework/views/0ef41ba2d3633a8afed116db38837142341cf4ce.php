

<?php $__env->startSection('title'); ?>Gestion des départements
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatable-extension.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/sweetalert2.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Gestion des départements</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item">Etablissement</li>
<li class="breadcrumb-item">Gestion des départements</li>

<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>La liste des départements</h5>
                    <div style="padding-left: 2px">
                        <a href=<?php echo e(route('departement.create')); ?>>
                            <i class="text-right" aria-hidden="true">
                                <button onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-8']);"
                                    class="btn btn-pill btn-success btn-sm pull-right" type="button">
                                    Ajouter un département
                                </button>
                            </i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="auto-fill">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Département</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($departements->count()>0): ?>
                                <?php $__currentLoopData = $departements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                <tr>
                                    <td><?php echo e($d->code); ?></td>
                                    <td><?php echo e($d->nom); ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('departement.edit',['id' => $d->id])); ?>"> <i
                                                style="font-size: 1.3em;" class='fa fa-edit'></i></a>
                                        <a href="#" data-id="<?php echo e($d->id); ?>" data-name="<?php echo e($d->nom); ?>" class="delete"> <i
                                                style="font-size: 1.3em;" class='fa fa-trash delete'></i></a>

                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>



                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Code</th>
                                    <th>Département</th>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

<?php if(Session::has('message')): ?>
<script>
    toastr.success("<?php echo Session::get('message'); ?>")
</script>
<?php endif; ?>
<?php if(Session::has('message')): ?>
<?php if(Session::get('message')=='ok'): ?>

<script>
    swal({
  position: 'center',
  icon: 'success',
  title: 'Ajout avec succées',
  showConfirmButton: false,
  timer: 2500
})


</script>

<?php elseif(Session::get('message')=='ko'): ?>
<script>
    swal({
  position: 'center',
  icon: 'error',
  title: 'Le département existe déja',
  showConfirmButton: false,
  timer: 2500
})
</script>
<?php elseif(Session::get('message')=='update'): ?>
<script>
    swal({
  position: 'center',
  icon: 'success',
  title: 'Le département est mis à jour',
  showConfirmButton: false,
  timer: 2500
})
    /*swal('Bien','Le département est mis à jour','success',{
    button: 'continuer'
})*/
</script>
<?php endif; ?>
<?php endif; ?>
<script>
    $('.delete').click(function(){
        var dataId=$(this).attr('data-id');
        var dataName=$(this).attr('data-name');
        swal({
                    title: "Etes-vous sur de vouloir supprimer le departement "+dataName+" ?",
                    //text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        //window.location=route('departement.destroy', ['id'=>dataId]);
                        window.location="supprimer-departement/"+dataId+"";
                        swal("OK! Le departement est bien supprimer!", {
                            icon: "success",
                        });
                    } else {
                        swal("La suppression est annulée!");
                    }
                })
});

</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/admin/etablissement/departement/liste_departements.blade.php ENDPATH**/ ?>