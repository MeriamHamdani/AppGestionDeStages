<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img
            class="img-90 rounded-circle" src="<?php echo e(asset('assets/images/dashboard/1.png')); ?>" alt="" />
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
        <a href="user-profile">
            <h6 class="mt-3 f-14 f-w-600">Etudiant </h6>
        </a>
        <p class="mb-0 font-roboto">Classe</p>
        
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
                            <h6>Général</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav<?php echo e(prefixActive('/dashboard')); ?>"
                            href="javascript:void(0)"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Stage</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" <?php echo e(prefixActive('etudiant/stage')); ?>

                            href="<?php echo e(route('demande_refuse')); ?>" class="<?php echo e(routeActive('demande_refuse')); ?>">
                            <i class="icofont icofont-tasks-alt"></i>&nbsp&nbsp&nbsp<span>Ma demande de stage</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" <?php echo e(prefixActive('etudiant/stage')); ?>href="<?php echo e(route('demander_stage')); ?>"
                            class="<?php echo e(routeActive('demander_stage')); ?>"><i
                                class="icofont icofont-paper"></i>&nbsp&nbsp&nbsp<span>Demander un stage</span></a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" <?php echo e(prefixActive('etudiant/stage')); ?>

                            href="<?php echo e(route('liste_stages')); ?>" class="<?php echo e(routeActive('liste_stages')); ?>"><i
                                class="icofont icofont-listine-dots"></i>&nbsp&nbsp&nbsp<span>La liste des
                                stages</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" <?php echo e(prefixActive('etudiant/stage')); ?>

                            href="<?php echo e(route('gestion_cahier_stage')); ?>"
                            class="<?php echo e(routeActive('gestion_cahier_stage')); ?>"><i
                                class="icofont icofont-book-alt"></i>&nbsp&nbsp&nbsp<span>Gérer le cahier de
                                stage</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Entreprise</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="<?php echo e(route('liste_entreprises')); ?>"
                            class="<?php echo e(routeActive('liste_entreprises')); ?>"><i
                                class="icofont icofont-list"></i>&nbsp&nbsp&nbsp<span>La liste des
                                entreprises</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="<?php echo e(route('ajouter-entreprise')); ?>"
                            class="<?php echo e(routeActive('ajouter-entreprise')); ?>"><i
                                class="icofont icofont-building-alt"></i>&nbsp&nbsp&nbsp<span>Ajouter une
                                entreprise</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Dépôt</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="<?php echo e(route('depot')); ?>"
                            class="<?php echo e(routeActive('depot')); ?>"><i
                                class="icofont icofont-papers"></i>&nbsp&nbsp&nbsp<span>Gérer le dépôt </span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Soutenance</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" <?php echo e(prefixActive('etudiant/soutenance')); ?>

                            href="<?php echo e(route('info_soutenance')); ?>" class="<?php echo e(routeActive('info_soutenance')); ?>"><i
                                class="icofont icofont-graduate-alt"></i>&nbsp&nbsp&nbsp<span>Les infotmations de ma
                                soutenance </span></a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>

<?php /**PATH C:\laragon\www\gestionDesStages\resources\views/layouts/etudiant/partials/sidebar.blade.php ENDPATH**/ ?>