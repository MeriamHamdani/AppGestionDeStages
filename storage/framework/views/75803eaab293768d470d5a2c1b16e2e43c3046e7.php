<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">


            <div class="logo-wrapper"><a href=""><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo.png')); ?>"
                        alt=""></a></div>
            <div class="dark-logo-wrapper"><a href=""><img class="img-fluid"
                        src="<?php echo e(asset('assets/images/logo/dark-logo.png')); ?>" alt=""></a></div>

            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">
                </i></div>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>

                <li class="onhover-dropdown p-0">

                    <form method="GET" action="<?php echo e(route('deconnexion')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-primary-light" type="button" href=<?php echo e(route('deconnexion')); ?> onclick="event.preventDefault();
                        this.closest('form').submit();"><i data-feather="log-out"></i>Se Déconnecter</button>
                    </form>

                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>

<?php /**PATH C:\Users\Lenovo\Desktop\stageApp\AppGestionDeStages\resources\views/layouts/admin/partials/header.blade.php ENDPATH**/ ?>