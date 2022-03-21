<?php $__env->startSection('title'); ?>Sample Page
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  <?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('breadcrumb_title'); ?>
      <h3>Sample Page</h3>
    <?php $__env->endSlot(); ?>
    <li class="breadcrumb-item">Pages</li>
    <li class="breadcrumb-item active">Sample Page</li>
  <?php echo $__env->renderComponent(); ?>
  
  <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="card">
                  <div class="card-header pb-0">
                      <h5>Sample Card</h5>
                      <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                  </div>
                  <div class="card-body">
                      <p>
                          "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                          commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                          id est laborum."
                      </p>
                  </div>
              </div>
          </div>
      </div>
  </div>

  
  <?php $__env->startPush('scripts'); ?>
  <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\essaiEtudiantTheme\resources\views/admin/pages/sample-page.blade.php ENDPATH**/ ?>