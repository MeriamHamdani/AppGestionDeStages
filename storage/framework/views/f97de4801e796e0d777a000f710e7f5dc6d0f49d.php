<?php $__env->startSection('title'); ?>State Color <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>State Color</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Base</li>
        <li class="breadcrumb-item active">State Color</li>
    <?php echo $__env->renderComponent(); ?>

    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Default Color</h5>
              </div>
              <div class="card-body">
                <div class="color-box">
                  <button class="btn btn-primary btn-square digits">#ba895d</button>
                  <button class="btn btn-square digits btn-secondary">#148df6</button>
                  <button class="btn btn-square digits btn-success">#51bb25</button>
                  <button class="btn btn-square digits btn-info">#7a15f7</button>
                  <button class="btn btn-square digits btn-warning">#ff5f24</button>
                  <button class="btn btn-square digits btn-danger">#fd2e64</button>
                  <button class="btn btn-square digits btn-light">#e8ebf2</button>
                  <button class="btn btn-square digits btn-dark">#2c323f</button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header pb-0">
                <h5>Color</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <h6 class="sub-title text-uppercase">Primary</h6>
                    <div class="primary-color">
                      <ul class="m-b-30">
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <h6 class="sub-title text-uppercase">secondary</h6>
                    <div class="secondary-color">
                      <ul class="m-b-30">
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <h6 class="sub-title text-uppercase">Success</h6>
                    <div class="success-color">
                      <ul class="m-b-30">
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <h6 class="sub-title text-uppercase">Info</h6>
                    <div class="info-color">
                      <ul class="m-b-30">
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <h6 class="sub-title text-uppercase">Warning</h6>
                    <div class="yellow-color">
                      <ul>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 xs-mt">
                    <h6 class="sub-title text-uppercase">Danger</h6>
                    <div class="red-color">
                      <ul>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 nav-md-mt">
                    <h6 class="sub-title text-uppercase">Pink</h6>
                    <div class="pink-color">
                      <ul>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 nav-md-mt">
                    <h6 class="sub-title text-uppercase">Grey</h6>
                    <div class="gray-color">
                      <ul>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                        <li><span></span></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>  
        <script src="<?php echo e(asset('assets/js/tooltip-init.js')); ?>"></script>  
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\theme\resources\views/admin/ui-kits/state-color.blade.php ENDPATH**/ ?>