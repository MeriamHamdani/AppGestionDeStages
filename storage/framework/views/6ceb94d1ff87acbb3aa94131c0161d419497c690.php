<?php $__env->startSection('title'); ?>Avatars <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Avatars</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Base</li>
        <li class="breadcrumb-item active">Avatars</li>
    <?php echo $__env->renderComponent(); ?>
    <div class="container-fluid">
        <div class="user-profile">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header pb-0">
                  <h5>Sizing</h5>
                </div>
                <div class="card-body avatar-showcase">
                  <div class="avatars">
                    <div class="avatar"><img class="img-100 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-90 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-80 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-70 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-60 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-50 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-40 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-30 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-20 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header pb-0">
                  <h5>Status Indicator</h5>
                </div>
                <div class="card-body avatar-showcase">
                  <div class="avatars">
                    <div class="avatar"><img class="img-100 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#">
                      <div class="status status-100 bg-primary"> </div>
                    </div>
                    <div class="avatar"><img class="img-90 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#">
                      <div class="status status-90 bg-primary"></div>
                    </div>
                    <div class="avatar"><img class="img-80 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#">
                      <div class="status status-80 bg-primary"></div>
                    </div>
                    <div class="avatar"><img class="img-70 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#">
                      <div class="status status-70 bg-primary"></div>
                    </div>
                    <div class="avatar"><img class="img-60 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#">
                      <div class="status status-60 bg-primary"></div>
                    </div>
                    <div class="avatar"><img class="img-50 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#">
                      <div class="status status-50 bg-primary"> </div>
                    </div>
                    <div class="avatar"><img class="img-40 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#">
                      <div class="status status-40 bg-primary"></div>
                    </div>
                    <div class="avatar"><img class="img-30 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#">
                      <div class="status status-30 bg-primary"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header pb-0">
                  <h5>Initials</h5>
                </div>
                <div class="card-body avatar-showcase">
                  <div class="avatars">
                    <div class="avatar"><img class="img-100 rounded-circle" src="<?php echo e(asset('assets/images/user/16.png')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-90 rounded-circle" src="<?php echo e(asset('assets/images/user/16.png')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-80 rounded-circle" src="<?php echo e(asset('assets/images/user/16.png')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-70 rounded-circle" src="<?php echo e(asset('assets/images/user/16.png')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-60 rounded-circle" src="<?php echo e(asset('assets/images/user/16.png')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-50 rounded-circle" src="<?php echo e(asset('assets/images/user/16.png')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-40 rounded-circle" src="<?php echo e(asset('assets/images/user/16.png')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-30 rounded-circle" src="<?php echo e(asset('assets/images/user/16.png')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-20 rounded-circle" src="<?php echo e(asset('assets/images/user/16.png')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-10 rounded-circle" src="<?php echo e(asset('assets/images/user/16.png')); ?>" alt="#"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-12 xl-100">
              <div class="card">
                <div class="card-header pb-0">
                  <h5>Shape</h5>
                </div>
                <div class="card-body avatar-showcase">
                  <div class="avatars">
                    <div class="avatar"><img class="img-100 b-r-8" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-90 b-r-30" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-80 b-r-35" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-70 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-60 b-r-25" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                    <div class="avatar"><img class="img-50 b-r-15" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header pb-0">
                  <h5>Groups</h5>
                </div>
                <div class="card-body avatar-showcase">
                  <div class="customers d-inline-block avatar-group">
                    <ul>
                      <li class="d-inline-block"><img class="img-70 rounded-circle" src="<?php echo e(asset('assets/images/user/3.jpg')); ?>" alt=""></li>
                      <li class="d-inline-block"><img class="img-70 rounded-circle" src="<?php echo e(asset('assets/images/user/5.jpg')); ?>" alt=""></li>
                      <li class="d-inline-block"><img class="img-70 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt=""></li>
                    </ul>
                  </div>
                  <div class="customers d-inline-block avatar-group">
                    <ul>
                      <li class="d-inline-block"><img class="img-50 rounded-circle" src="<?php echo e(asset('assets/images/user/3.jpg')); ?>" alt=""></li>
                      <li class="d-inline-block"><img class="img-50 rounded-circle" src="<?php echo e(asset('assets/images/user/5.jpg')); ?>" alt=""></li>
                      <li class="d-inline-block"><img class="img-50 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt=""></li>
                    </ul>
                  </div>
                  <div class="customers d-inline-block avatar-group">
                    <ul>
                      <li class="d-inline-block"><img class="img-40 rounded-circle" src="<?php echo e(asset('assets/images/user/3.jpg')); ?>" alt=""></li>
                      <li class="d-inline-block"><img class="img-40 rounded-circle" src="<?php echo e(asset('assets/images/user/5.jpg')); ?>" alt=""></li>
                      <li class="d-inline-block"><img class="img-40 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt=""></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/tooltip-init.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\theme\resources\views/admin/ui-kits/avatars.blade.php ENDPATH**/ ?>