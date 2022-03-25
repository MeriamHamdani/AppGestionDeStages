<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img
            class="img-90 rounded-circle" src="<?php echo e(asset('assets/images/dashboard/1.png')); ?>" alt="" />
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
        <a href="user-profile">
            <h6 class="mt-3 f-14 f-w-600">Enseignant Nom et prénom</h6>
        </a>
        <p class="mb-0 font-roboto">Grade</p>


    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Encadrement</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" <?php echo e(prefixActive('enseignant/encadrement')); ?>

                            href="<?php echo e(route('liste_demandes')); ?>" class="<?php echo e(routeActive('liste_demandes')); ?>"><i
                                class="icofont icofont-listine-dots"></i>&nbsp&nbsp&nbsp<span>La liste des demandes
                                d'encadrement</span></a>

                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="<?php echo e(route('liste_stages_actifs')); ?>"
                            class="<?php echo e(routeActive('liste_stages_actifs')); ?>"><i
                                class="icofont icofont-listine-dots"></i>&nbsp&nbsp&nbsp<span>La liste des stages
                                actifs</span></a>

                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Dépôt</h6>
                        </div>
                    </li>
                    <li class="dropdown">



                        <a class="nav-link menu-title" <?php echo e(prefixActive('enseignant/depot')); ?>

                            href="<?php echo e(route('depots')); ?>" class="<?php echo e(routeActive('depots')); ?>"><i
                                class="icofont icofont-papers"></i>&nbsp&nbsp&nbsp<span>La liste des demandes de dépot
                                de memoire </span></a>


                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Soutenance</h6>
                        </div>
                    </li>
                    <li class="dropdown">


                    </li>
                    <li class="dropdown">

                        <a class="nav-link menu-title" <?php echo e(prefixActive('enseignant/soutenance')); ?>

                            href="<?php echo e(route('role_encadrant')); ?>" class="<?php echo e(routeActive('role_encadrant')); ?>"><i
                                class="icofont icofont-teacher"></i>&nbsp&nbsp&nbsp<span>En tant qu'Encadrant</span></a>

                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" <?php echo e(prefixActive('enseignant/soutenance')); ?>

                            href="<?php echo e(route('role_membre_jury')); ?>" class="<?php echo e(routeActive('role_membre_jury')); ?>"><i
                                class="icofont icofont-users-alt-2"></i>&nbsp&nbsp&nbsp<span>En tant que membre de jury
                            </span></a>


                    </li>


                    <li class="sidebar-main-title">
                        <div>
                            <h6>Paiement</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="<?php echo e(route('liste_stages_paye')); ?>"
                            class="<?php echo e(routeActive('liste_stages_paye')); ?>"><i
                                class="icofont icofont-cur-dollar"></i>&nbsp&nbsp&nbsp<span>La liste des stages
                                payés</span></a>

                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title" href="<?php echo e(route('liste_stages_non_paye')); ?>"
                            class="<?php echo e(routeActive('liste_stages_non_paye')); ?>"><i
                                class="icofont icofont-close-squared"></i>&nbsp&nbsp&nbsp<span>La liste des stages
                                non-payés</span></a>

                    </li>


                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header><?php /**PATH C:\laragon\www\AppGestionDeStages\resources\views/layouts/enseignant/partials/sidebar.blade.php ENDPATH**/ ?>