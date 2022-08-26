<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="<?php echo e(route('profil_ens')); ?>"><i data-feather="settings"></i></a><img
            class="img-90 rounded-circle" src="<?php echo e(asset('assets/images/dashboard/1.png')); ?>" alt="" />
        <div class="badge-bottom"><span class="badge badge-primary">Enseignant(e)</span></div>
        <a href="">
            <h6 class="mt-3 f-14 f-w-600">
                <?php echo e(ucwords(App\Models\Enseignant::where('user_id',auth()->id())->first()->prenom)); ?>

                <?php echo e(ucwords(App\Models\Enseignant::where('user_id',auth()->id())->first()->nom)); ?></h6>
        </a>
        <p class="mb-0 font-roboto" style="color: #ba895d">
            <strong><?php echo e(ucwords(App\Models\Enseignant::where('user_id',auth()->id())->first()->grade)); ?></strong>
        </p>
        <p class="mb-0 font-roboto" style="color: #ba895d">
            <strong><?php echo e(ucwords(App\Models\Enseignant::where('user_id',auth()->id())->first()->departement->nom)); ?></strong>
        </p>


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
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('liste_demandes')); ?>"
                           href="<?php echo e(route('liste_demandes')); ?>" class="">
                            <i class="icofont icofont-list"></i>&nbsp&nbsp&nbsp<span>La liste des demandes
                                d'encadrement</span></a>

                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav  <?php echo e(routeActive('liste_stages_actifs')); ?>"
                           href="<?php echo e(route('liste_stages_actifs')); ?>">
                            <i class="icofont icofont-listine-dots"></i>&nbsp&nbsp&nbsp<span>La liste des stages
                                actifs</span></a>

                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Dépôt</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav  <?php echo e(routeActive('depots')); ?>" href="<?php echo e(route('depots')); ?>">
                            <i class="icofont icofont-papers"></i>&nbsp&nbsp&nbsp<span>La liste des demandes de dépôt
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

                        <a href="<?php echo e(route('soutenance_role_encadrant')); ?>" class="nav-link menu-title link-nav  <?php echo e(routeActive('soutenance_role_encadrant')); ?>

                        <?php echo e(in_array(Route::currentRouteName(),
                      ['info_soutenance_ens']) ? 'active' : ''); ?>">
                            <i class="icofont icofont-teacher"></i>&nbsp&nbsp&nbsp<span>En tant qu'Encadrant</span></a>

                    </li>
                    <li class="dropdown">
                        <a href="<?php echo e(route('soutenance_role_membre_jury')); ?>" class="nav-link menu-title link-nav <?php echo e(routeActive('soutenance_role_membre_jury')); ?>


                        <?php echo e(in_array(Route::currentRouteName(),
                          ['info_soutenance_membre']) ? 'active' : ''); ?>">

                            <i class="icofont icofont-users-alt-2"></i>&nbsp&nbsp&nbsp<span>En tant que membre de jury
                            </span></a>


                    </li>


                    <li class="sidebar-main-title">
                        <div>
                            <h6>Payement</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('liste_stages_a_paye')); ?>"
                           href="<?php echo e(route('liste_stages_a_paye')); ?>" >
                            <i class="icofont icofont-cur-dollar"></i>&nbsp&nbsp&nbsp<span>Stages
                                et Frais d'encadrement</span></a>

                    </li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
<?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/layouts/enseignant/partials/sidebar.blade.php ENDPATH**/ ?>