<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img
            class="img-90 rounded-circle" src="<?php echo e(asset('assets/images/dashboard/1.png')); ?>" alt="" />
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
        <a href="user-profile">
            <h6 class="mt-3 f-14 f-w-600">Admin Nom prenom</h6>
        </a>
        <p class="mb-0 font-roboto">université</p>
        
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
                        <a class="nav-link menu-title <?php echo e(prefixActive('/dashboard')); ?>" href="javascript:void(0)"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Administration</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="<?php echo e(route('liste_admin')); ?>"
                            class="<?php echo e(routeActive('liste_admin')); ?>"><i
                                class="icofont icofont-users-alt-2"></i>&nbsp&nbsp&nbsp<span>La liste des
                                administrateurs</span></a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title " href="<?php echo e(route('ajouter_admin')); ?>"
                            class="<?php echo e(routeActive('ajouter_admin')); ?>"><i
                                class="icofont icofont-user-suited"></i>&nbsp&nbsp&nbsp<span>Ajouter un
                                administrateur</span></a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Stages</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-listing-box"></i>&nbsp&nbsp&nbsp<span>Les demandes de
                                stages</span></a>
                        <ul class="nav-submenu menu-content" style="display: <?php echo e(prefixBlock('/')); ?>;">
                            <li><a href="#"><strong><i class="icofont icofont-pen-nib"></i>Stage volantaire 1ère et 2ème
                                        license et master</strong></a> </li>
                            <li><a href="#"><strong><i class="icofont icofont-pen-nib"></i>Stage obligatoire 2ème
                                        license</strong></a> </li>
                            <li><a href="#"><strong><i class="icofont icofont-pen-nib"></i>Stage obligatoire 3ème
                                        license</strong></a> </li>
                            <li><a href="#"><strong><i class="icofont icofont-pen-nib"></i>Stage obligatoire 3ème
                                        info</strong></a> </li>
                            <li><a href="#"><strong><i class="icofont icofont-pen-nib"></i>Stage obligatoire 2ème
                                        master</strong></a> </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="<?php echo e(route('gerer_cahiers_stages')); ?>"
                            class="<?php echo e(routeActive('gerer_cahiers_stages')); ?>"><i
                                class="icofont icofont-book-alt"></i>&nbsp&nbsp&nbsp<span>Gérer les cahiers des
                                stages</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Etablissement</h6>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-teacher"></i>&nbsp&nbsp&nbsp<span>Gestion des
                                enseignants</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-group-students"></i>&nbsp&nbsp&nbsp<span>Gestion des
                                étudiants</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-building"></i>&nbsp<span>Gestion des départements</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-list"></i>&nbsp&nbsp&nbsp<span>Gestion des spécialités
                            </span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-users-social"></i>&nbsp&nbsp&nbsp<span>Gestion des
                                classes</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Entreprise/Société</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-list"></i>&nbsp&nbsp&nbsp<span>La liste des
                                entreprises</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-building-alt"></i>&nbsp&nbsp&nbsp<span>Ajouter une
                                entreprise</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Dépôt</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-papers"></i>&nbsp&nbsp&nbsp<span>Gérer les dépôts</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Soutenances</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-calendar"></i>&nbsp&nbsp&nbsp<span>Planifier une
                                soutenance</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-graduate"></i>&nbsp&nbsp&nbsp<span>La liste des
                                soutenances</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Paiement</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-cur-dollar"></i>&nbsp&nbsp&nbsp<span>Gérer les
                                paiements</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-cur-dollar-plus"></i>&nbsp&nbsp&nbsp<span>Détails de paiement
                                d'un enseignant</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Configuration</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-university"></i>&nbsp&nbsp&nbsp<span>Configuration
                                générale</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i
                                class="icofont icofont-settings"></i>&nbsp&nbsp&nbsp<span>Configuration des années
                                universitaires</span></a>
                    </li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>

<?php /**PATH C:\Users\Lenovo\gestionDesStages\resources\views/layouts/admin/partials/sidebar.blade.php ENDPATH**/ ?>