<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="{{route('profil')}}"><i data-feather="settings"></i></a><img
            class="img-90 rounded-circle" src="{{asset('assets/images/dashboard/1.png')}}" alt="" />
        <div class="badge-bottom"><span class="badge badge-primary">Admin</span></div>
        <a href="">
            <h6 class="mt-3 f-14 f-w-600">{{ucwords(App\Models\Admin::where('user_id',auth()->id())->first()->prenom)}}
                {{ucwords(App\Models\Admin::where('user_id',auth()->id())->first()->nom)}}</h6>
        </a>
        <p class="mb-0 font-roboto" style="color: #ba895d"><strong>{{App\Models\Etablissement::first()->nom}}</strong>
        </p>
        {{-- <ul>
            <li>
                <span><span class="counter">2</span>
                    <p>Stages</p>
            </li>
        </ul>--}}
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
                        <a class="nav-link menu-title link-nav {{ routeActive('dashboard') }}"
                            href="{{ route('dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Administration</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('liste_admin') }}"
                            href="{{ route('liste_admin') }}">
                            <i class="icofont icofont-users-alt-2"></i>&nbsp&nbsp&nbsp<span>La liste des
                                administrateurs</span></a>
                    </li>
                    @super
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('ajouter_admin') }} "
                            href="{{ route('ajouter_admin') }}">
                            <i class="icofont icofont-user-suited"></i>&nbsp&nbsp&nbsp<span>Ajouter un
                                administrateur</span></a>
                    </li>
                    @endsuper


                    <li class="sidebar-main-title">
                        <div>
                            <h6>Stages</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title  {{ in_array(Route::currentRouteName(),
                            ['demandes_stage.sv1lm','demandes_stage.so2l','demandes_stage.so3l',
                            'demandes_stage.so3Info','demandes_stage.so2m','edit','demandes_stage.modifier_demande']) ? 'active' : '' }}"
                            href="javascript:void(0)">
                            <i class="icofont icofont-listing-box"></i>&nbsp&nbsp<span>Les stages-Les
                                demandes</span></a>
                        <ul class="nav-submenu menu-content"
                            style="display: {{ prefixBlock('admin/stage/demandes-stage') }};">
                            <li><a href="{{ route('demandes_stage.sv1lm') }}"
                                    class="{{ routeActive('demandes_stage.sv1lm') }}"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Volontaire (1ère
                                        licence et 1ére mastère)</strong></a> </li>
                            <li><a href="{{ route('demandes_stage.so2lInfo') }}"
                                    class="{{ routeActive('demandes_stage.so2lInfo') }}"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Obligatoire (2ème
                                        licence informatique)</strong></a> </li>
                            <li><a href="{{ route('demandes_stage.so2l') }}"
                                    class="{{ routeActive('demandes_stage.so2l') }}"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Obligatoire (2ème
                                        licence non-informatique)</strong></a> </li>
                            <li><a href="{{ route('demandes_stage.so3l') }}"
                                    class="{{ routeActive('demandes_stage.so3l') }}"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Obligatoire (3ème
                                        licence non-informatique) </strong></a> </li>
                            <li><a href="{{ route('demandes_stage.so3Info') }}"
                                    class="{{ routeActive('demandes_stage.so3Info') }}"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Obligatoire (3ème licence
                                        informatique)</strong></a> </li>
                            <li><a href="{{ route('demandes_stage.so2m') }}"
                                    class="{{ routeActive('demandes_stage.so2m') }}"><strong><i
                                            class="icofont icofont-pen-nib"></i>Stage Obligatoire (2ème
                                        mastère)</strong></a> </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('gerer_cahiers_stages') }}"
                            href="{{ route('gerer_cahiers_stages') }}">
                            <i class="icofont icofont-book-alt"></i>&nbsp&nbsp&nbsp<span>Gérer les cahiers des
                                stages</span></a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Etablissement</h6>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav {{ in_array(Route::currentRouteName(),
                            ['create','departement.edit']) ? 'active' : '' }} {{ routeActive('liste_departements') }}"
                            href="{{ route('liste_departements') }}">
                            <i class="icofont icofont-building"></i>&nbsp<span>Gestion des départements</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav {{ in_array(Route::currentRouteName(),
                            ['ajouter_enseignant','modifier_enseignant']) ? 'active' : '' }} {{ routeActive('liste_enseignants') }} "
                            href="{{ route('liste_enseignants') }}">
                            <i class="icofont icofont-teacher"></i>&nbsp&nbsp&nbsp<span>Gestion des
                                enseignants</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ in_array(Route::currentRouteName(),
                            ['ajouter_specialite','modifier_specialite']) ? 'active' : '' }} {{ routeActive('liste_specialites') }}"
                            href="{{ route('liste_specialites') }}  ">
                            <i class="icofont icofont-list"></i>&nbsp&nbsp&nbsp<span>Gestion des spécialités
                            </span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ in_array(Route::currentRouteName(),
                            ['liste_classes','typeStage.create','typeStage.index','ajouter_classe','modifier_classe']) ? 'active' : '' }}"
                            href="javascript:void(0)">

                            <i class="icofont icofont-users-social"></i>&nbsp&nbsp&nbsp<span>Gestion des
                                classes</span></a>
                        <ul class="nav-submenu menu-content"
                            style="display: {{ prefixBlock('admin/configuration/generale') }};">
                            <li><a {{ in_array(Route::currentRouteName(), ['ajouter_classe','modifier_classe'])
                                    ? 'active' : '' }} href="{{ route('liste_classes') }}"
                                    class="{{ routeActive('liste_classes') }}">
                                    <strong><i class="icofont icofont-users-social"></i>Gérer les classes</strong></a>
                            </li>
                            <li><a {{ in_array(Route::currentRouteName(), ['modifier_type_stage']) ? 'active' : '' }}
                                    href="{{ route('typeStage.index')}}" class="{{ routeActive('typeStage.index') }}">
                                    <strong><i class="icofont icofont-pen-nib"></i>Classe & Type de stage</strong></a>
                            </li>
                        </ul>

                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav   {{ in_array(Route::currentRouteName(),
                            ['ajouter_etudiant','modifier_etudiant']) ? 'active' : '' }} {{ routeActive('liste_etudiants') }}"
                            href="{{ route('liste_etudiants') }}">
                            <i class="icofont icofont-group-students"></i>&nbsp&nbsp&nbsp<span>Gestion des
                                étudiants</span></a>
                    </li>



                    <li class="sidebar-main-title">
                        <div>
                            <h6>Entreprise/Société</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('list_entreprises') }}"
                            href="{{ route('list_entreprises') }}">
                            <i class="icofont icofont-list"></i>&nbsp&nbsp&nbsp<span>La liste des
                                entreprises</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('ajouter_entreprise') }}"
                            href="{{ route('ajouter_entreprise') }}">
                            <i class="icofont icofont-building-alt"></i>&nbsp&nbsp&nbsp<span>Ajouter une
                                entreprise</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Dépôt</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('liste_sessions_depot') }}"
                            href="{{ route('liste_sessions_depot') }}">
                            <i class="icofont icofont-list"></i>&nbsp&nbsp&nbsp<span>Liste sessions de dépôt</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('config_session_depot') }}"
                            href="{{ route('config_session_depot') }}">
                            <i class="icofont icofont-download-alt"></i>&nbsp&nbsp&nbsp<span> Ouvrir une Session
                            </span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('demande_depots') }}"
                            href="{{ route('demande_depots') }}">
                            <i class="icofont icofont-papers"></i>&nbsp&nbsp&nbsp<span>Gérer les dépôts</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Soutenances</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('planifier_soutenance') }}"
                            href="{{ route('planifier_soutenance') }}">
                            <i class="icofont icofont-calendar"></i>&nbsp&nbsp&nbsp<span>Planifier une
                                soutenance</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('list_soutenances_admin') }}"
                            href="{{ route('list_soutenances_admin') }}">
                            <i class="icofont icofont-graduate"></i>&nbsp&nbsp&nbsp<span>La liste des
                                soutenances</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Paiement</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('details_paiement_ens') }}"
                            href="{{ route('details_paiement_ens') }}">
                            <i class="icofont icofont-cur-dollar-plus"></i>&nbsp&nbsp&nbsp<span>Détails de payement
                                d'un enseignant</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Configuration</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title  {{ in_array(Route::currentRouteName(),
                            ['coordonnees','frais_encadrement','ajouter_frais','modifier_frais','dates_stages','liste_grille','configurer_grille']) ? 'active' : '' }}"
                            href="javascript:void(0)">
                            <i class="icofont icofont-university"></i>&nbsp&nbsp&nbsp<span>Configuration
                                générale</span></a>
                        <ul class="nav-submenu menu-content"
                            style="display: {{ prefixBlock('admin/configuration/generale') }};">
                            <li><a href="{{ route('coordonnees') }}" class="{{ routeActive('coordonnees') }}">
                                    <strong><i class="icofont icofont-pen-nib"></i>Cordonnées de
                                        l'établissement</strong></a> </li>

                            <li><a href="{{ route('frais_encadrement') }}"
                                    class="{{ routeActive('frais_encadrement') }}">
                                    <strong><i class="icofont icofont-pen-nib"></i>Frais d'encadrement</strong></a>
                            </li>
                            <!-- <li><a href="{{ route('dates_stages') }}" class="{{ routeActive('dates_stages') }}">

                                    <strong><i class="icofont icofont-pen-nib"></i>Dates des stages selon
                                        Formation</strong></a> </li>-->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('liste_annee_universitaire') }}" class="nav-link menu-title link-nav {{routeActive('liste_annee_universitaire') }}
                              {{ in_array(Route::currentRouteName(),
                            ['config_annee_universitaire','modifier_annee_universitaire']) ? 'active' : '' }}">
                            <i class="icofont icofont-settings"></i>&nbsp&nbsp&nbsp<span>Configuration
                                des années universitaires</span></a>
                    </li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>

