<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="<?php echo e(route('profil')); ?>"><i data-feather="settings"></i></a><img
            class="img-90 rounded-circle" src="<?php echo e(asset('assets/images/dashboard/1.png')); ?>" alt="" />
        <div class="badge-bottom"><span class="badge badge-primary">Admin</span></div>
        <a href="">
            <h6 class="mt-3 f-14 f-w-600"><?php echo e(ucwords(App\Models\Admin::where('user_id',auth()->id())->first()->prenom)); ?>

                <?php echo e(ucwords(App\Models\Admin::where('user_id',auth()->id())->first()->nom)); ?></h6>
        </a>
        <p class="mb-0 font-roboto" style="color: #ba895d"><strong><?php echo e(App\Models\Etablissement::first()->nom); ?></strong>
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
                            <h6>Général</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('dashboard')); ?>"
                            href="<?php echo e(route('dashboard')); ?>"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Administration</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('liste_admin')); ?>"
                            href="<?php echo e(route('liste_admin')); ?>">
                            <i class="icofont icofont-users-alt-2"></i>&nbsp&nbsp&nbsp<span>La liste des
                                administrateurs</span></a>
                    </li>
                    <?php if (\Illuminate\Support\Facades\Blade::check('super')): ?>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('ajouter_admin')); ?> "
                            href="<?php echo e(route('ajouter_admin')); ?>">
                            <i class="icofont icofont-user-suited"></i>&nbsp&nbsp&nbsp<span>Ajouter un
                                administrateur</span></a>
                    </li>
                    <?php endif; ?>


                    <li class="sidebar-main-title">
                        <div>
                            <h6>Stages</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title  <?php echo e(in_array(Route::currentRouteName(),
                            ['demandes_stage.sv1lm','demandes_stage.so2l','demandes_stage.so3l',
                            'demandes_stage.so3Info','demandes_stage.so2m','edit','demandes_stage.modifier_demande']) ? 'active' : ''); ?>"
                            href="javascript:void(0)">
                            <i class="icofont icofont-listing-box"></i>&nbsp&nbsp<span>Les stages-Les
                                demandes</span></a>
                        <ul class="nav-submenu menu-content"
                            style="display: <?php echo e(prefixBlock('admin/stage/demandes-stage')); ?>;">
                            <li><a href="<?php echo e(route('demandes_stage.sv1lm')); ?>"
                                    class="<?php echo e(routeActive('demandes_stage.sv1lm')); ?>"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Volontaire (1ère
                                        licence et 1ére mastère)</strong></a> </li>
                            <li><a href="<?php echo e(route('demandes_stage.so2lInfo')); ?>"
                                    class="<?php echo e(routeActive('demandes_stage.so2lInfo')); ?>"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Obligatoire (2ème
                                        licence informatique)</strong></a> </li>
                            <li><a href="<?php echo e(route('demandes_stage.so2l')); ?>"
                                    class="<?php echo e(routeActive('demandes_stage.so2l')); ?>"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Obligatoire (2ème
                                        licence non-informatique)</strong></a> </li>
                            <li><a href="<?php echo e(route('demandes_stage.so3l')); ?>"
                                    class="<?php echo e(routeActive('demandes_stage.so3l')); ?>"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Obligatoire (3ème
                                        licence non-informatique) </strong></a> </li>
                            <li><a href="<?php echo e(route('demandes_stage.so3Info')); ?>"
                                    class="<?php echo e(routeActive('demandes_stage.so3Info')); ?>"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Obligatoire (3ème licence
                                        informatique)</strong></a> </li>
                            <li><a href="<?php echo e(route('demandes_stage.so2m')); ?>"
                                    class="<?php echo e(routeActive('demandes_stage.so2m')); ?>"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Obligatoire (2ème
                                        mastère)</strong></a> </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('gerer_cahiers_stages')); ?>"
                            href="<?php echo e(route('gerer_cahiers_stages')); ?>">
                            <i class="icofont icofont-book-alt"></i>&nbsp&nbsp&nbsp<span>Gérer les cahiers des
                                stages</span></a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Etablissement</h6>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(in_array(Route::currentRouteName(),
                            ['create','departement.edit']) ? 'active' : ''); ?> <?php echo e(routeActive('liste_departements')); ?>"
                            href="<?php echo e(route('liste_departements')); ?>">
                            <i class="icofont icofont-building"></i>&nbsp<span>Gestion des départements</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(in_array(Route::currentRouteName(),
                            ['ajouter_enseignant','modifier_enseignant']) ? 'active' : ''); ?> <?php echo e(routeActive('liste_enseignants')); ?> "
                            href="<?php echo e(route('liste_enseignants')); ?>">
                            <i class="icofont icofont-teacher"></i>&nbsp&nbsp&nbsp<span>Gestion des
                                enseignants</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(in_array(Route::currentRouteName(),
                            ['ajouter_specialite','modifier_specialite']) ? 'active' : ''); ?> <?php echo e(routeActive('liste_specialites')); ?>"
                            href="<?php echo e(route('liste_specialites')); ?>  ">
                            <i class="icofont icofont-list"></i>&nbsp&nbsp&nbsp<span>Gestion des spécialités
                            </span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title <?php echo e(in_array(Route::currentRouteName(),
                            ['liste_classes','typeStage.create','typeStage.index','ajouter_classe','modifier_classe']) ? 'active' : ''); ?>"
                            href="javascript:void(0)">

                            <i class="icofont icofont-users-social"></i>&nbsp&nbsp&nbsp<span>Gestion des
                                classes</span></a>
                        <ul class="nav-submenu menu-content"
                            style="display: <?php echo e(prefixBlock('admin/configuration/generale')); ?>;">
                            <li><a <?php echo e(in_array(Route::currentRouteName(), ['ajouter_classe','modifier_classe'])
                                    ? 'active' : ''); ?> href="<?php echo e(route('liste_classes')); ?>"
                                    class="<?php echo e(routeActive('liste_classes')); ?>">
                                    <strong><i class="icofont icofont-users-social"></i>Gérer les classes</strong></a>
                            </li>
                            <li><a <?php echo e(in_array(Route::currentRouteName(), ['modifier_type_stage']) ? 'active' : ''); ?>

                                    href="<?php echo e(route('typeStage.index')); ?>" class="<?php echo e(routeActive('typeStage.index')); ?>">
                                    <strong><i class="icofont icofont-pen-nib"></i>Classe & Type de stage</strong></a>
                            </li>
                        </ul>

                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav   <?php echo e(in_array(Route::currentRouteName(),
                            ['ajouter_etudiant','modifier_etudiant']) ? 'active' : ''); ?> <?php echo e(routeActive('liste_etudiants')); ?>"
                            href="<?php echo e(route('liste_etudiants')); ?>">
                            <i class="icofont icofont-group-students"></i>&nbsp&nbsp&nbsp<span>Gestion des
                                étudiants</span></a>
                    </li>



                    <li class="sidebar-main-title">
                        <div>
                            <h6>Entreprise/Société</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('list_entreprises')); ?>"
                            href="<?php echo e(route('list_entreprises')); ?>">
                            <i class="icofont icofont-list"></i>&nbsp&nbsp&nbsp<span>La liste des
                                entreprises</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('ajouter_entreprise')); ?>"
                            href="<?php echo e(route('ajouter_entreprise')); ?>">
                            <i class="icofont icofont-building-alt"></i>&nbsp&nbsp&nbsp<span>Ajouter une
                                entreprise</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Dépôt</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('liste_sessions_depot')); ?>"
                            href="<?php echo e(route('liste_sessions_depot')); ?>">
                            <i class="icofont icofont-list"></i>&nbsp&nbsp&nbsp<span>Liste sessions de dépôt</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('config_session_depot')); ?>"
                            href="<?php echo e(route('config_session_depot')); ?>">
                            <i class="icofont icofont-download-alt"></i>&nbsp&nbsp&nbsp<span> Ouvrir une Session
                            </span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('demande_depots')); ?>"
                            href="<?php echo e(route('demande_depots')); ?>">
                            <i class="icofont icofont-papers"></i>&nbsp&nbsp&nbsp<span>Gérer les dépôts</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Soutenances</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('planifier_soutenance')); ?>"
                            href="<?php echo e(route('planifier_soutenance')); ?>">
                            <i class="icofont icofont-calendar"></i>&nbsp&nbsp&nbsp<span>Planifier une
                                soutenance</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('list_soutenances_admin')); ?>"
                            href="<?php echo e(route('list_soutenances_admin')); ?>">
                            <i class="icofont icofont-graduate"></i>&nbsp&nbsp&nbsp<span>La liste des
                                soutenances</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Paiement</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('details_paiement_ens')); ?>"
                            href="<?php echo e(route('details_paiement_ens')); ?>">
                            <i class="icofont icofont-cur-dollar-plus"></i>&nbsp&nbsp&nbsp<span>Détails de payement
                                d'un enseignant</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Configuration</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title  <?php echo e(in_array(Route::currentRouteName(),
                            ['coordonnees','frais_encadrement','ajouter_frais','modifier_frais','dates_stages','liste_grille','configurer_grille']) ? 'active' : ''); ?>"
                            href="javascript:void(0)">
                            <i class="icofont icofont-university"></i>&nbsp&nbsp&nbsp<span>Configuration
                                générale</span></a>
                        <ul class="nav-submenu menu-content"
                            style="display: <?php echo e(prefixBlock('admin/configuration/generale')); ?>;">
                            <li><a href="<?php echo e(route('coordonnees')); ?>" class="<?php echo e(routeActive('coordonnees')); ?>">
                                    <strong><i class="icofont icofont-pen-nib"></i>Cordonnées de
                                        l'établissement</strong></a> </li>

                            <li><a href="<?php echo e(route('frais_encadrement')); ?>"
                                    class="<?php echo e(routeActive('frais_encadrement')); ?>">
                                    <strong><i class="icofont icofont-pen-nib"></i>Frais d'encadrement</strong></a>
                            </li>
                            <!-- <li><a href="<?php echo e(route('dates_stages')); ?>" class="<?php echo e(routeActive('dates_stages')); ?>">

                                    <strong><i class="icofont icofont-pen-nib"></i>Dates des stages selon
                                        Formation</strong></a> </li>-->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="<?php echo e(route('liste_annee_universitaire')); ?>" class="nav-link menu-title link-nav <?php echo e(routeActive('liste_annee_universitaire')); ?>

                              <?php echo e(in_array(Route::currentRouteName(),
                            ['config_annee_universitaire','modifier_annee_universitaire']) ? 'active' : ''); ?>">
                            <i class="icofont icofont-settings"></i>&nbsp&nbsp&nbsp<span>Configuration
                                des années universitaires</span></a>
                    </li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>

<?php /**PATH C:\laragon\www\AppGestionDesStages\AppGestionDeStages\resources\views/layouts/admin/partials/sidebar.blade.php ENDPATH**/ ?>