<?php $__env->startSection('title'); ?>Comingsoon
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<!-- Loader starts-->
	<div class="loader-wrapper">
	    <div class="theme-loader">
	        <div class="loader-p"></div>
	    </div>
	</div>
	<!-- Loader ends-->
	<!-- page-wrapper Start-->
	<div class="page-wrapper" id="pageWrapper">
	    <!-- Page Body Start-->
	    <div class="container-fluid p-0">
	        <div class="comingsoon auth-bg-video">
	            <video class="bgvideo-comingsoon" id="bgvid" poster="<?php echo e(asset('assets/images/other-images/coming-soon-bg.jpg')); ?>" playsinline="" autoplay="" muted="" loop="">
	                <source src="<?php echo e(asset('assets/video/auth-bg.mp4')); ?>" type="video/mp4" />
	            </video>
	            <div class="comingsoon-inner text-center">
	                <a href="<?php echo e(route('index')); ?>"><img src="<?php echo e(asset('assets/images/logo/logo-1.png')); ?>" alt="" /></a>
	                <h5>WE ARE COMING SOON</h5>
	                <div class="countdown" id="clockdiv">
	                    <ul>
	                        <li><span class="time digits" id="days"></span><span class="title">days</span></li>
	                        <li><span class="time digits" id="hours"></span><span class="title">Hours</span></li>
	                        <li><span class="time digits" id="minutes"></span><span class="title">Minutes</span></li>
	                        <li><span class="time digits" id="seconds"></span><span class="title">Seconds</span></li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/countdown.js')); ?>"></script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.comingsoon.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\theme\resources\views/admin/comingsoon/comingsoon-bg-video.blade.php ENDPATH**/ ?>