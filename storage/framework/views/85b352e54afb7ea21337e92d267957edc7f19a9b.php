<?php $__env->startSection('title'); ?>Vector Maps
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vector-map.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Vector Maps</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item">Maps</li>
		<li class="breadcrumb-item active">Vector Maps</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-sm-6">
	            <div class="card">
	                <div class="card-header pb-0">
	                    <h5>VECTOR WORLD MAP</h5>
	                    <span>Below Map is displaying the world map.</span>
	                </div>
	                <div class="card-body">
	                    <div class="jvector-map-height" id="world-map"></div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="card">
	                <div class="card-header pb-0">
	                    <h5>VECTOR USA MAP</h5>
	                    <span>Below Map is displaying the usa map.</span>
	                </div>
	                <div class="card-body">
	                    <div class="jvector-map-height" id="usa"></div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="card">
	                <div class="card-header pb-0">
	                    <h5>VECTOR CANADA MAP</h5>
	                    <span>Below Map is displaying the canada map.</span>
	                </div>
	                <div class="card-body">
	                    <div class="jvector-map-height" id="canada"></div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="card">
	                <div class="card-header pb-0">
	                    <h5>VECTOR INDIA MAP</h5>
	                    <span>Below Map is displaying the india map.</span>
	                </div>
	                <div class="card-body">
	                    <div class="jvector-map-height" id="india"></div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="card">
	                <div class="card-header pb-0">
	                    <h5>VECTOR ASIA MAP</h5>
	                    <span>Below Map is displaying the asia map.</span>
	                </div>
	                <div class="card-body">
	                    <div class="jvector-map-height" id="asia"></div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="card">
	                <div class="card-header pb-0">
	                    <h5>VECTOR CANADA MAP</h5>
	                    <span>Below Map is displaying the uk map.</span>
	                </div>
	                <div class="card-body">
	                    <div class="jvector-map-height" id="uk"></div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="card">
	                <div class="card-header pb-0">
	                    <h5>VECTOR CHICAGO MAP</h5>
	                    <span>Below Map is displaying the chicago map.</span>
	                </div>
	                <div class="card-body">
	                    <div class="jvector-map-height" id="chicago"></div>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="card">
	                <div class="card-header pb-0">
	                    <h5>VECTOR AUSTRALIA MAP</h5>
	                    <span>Below Map is displaying the australia map.</span>
	                </div>
	                <div class="card-body">
	                    <div class="jvector-map-height" id="australia"></div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	
	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/vector-map/jquery-jvectormap-2.0.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-au-mill.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-in-mill.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map/jquery-jvectormap-asia-mill.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vector-map/map-vector.js')); ?>"></script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\theme\resources\views/admin/miscellaneous/vector-map.blade.php ENDPATH**/ ?>