<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img
            class="img-90 rounded-circle" src="{{asset('assets/images/dashboard/1.png')}}" alt="" />
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
        <a href="user-profile">
            <h6 class="mt-3 f-14 f-w-600">Etudiant </h6>
        </a>
        <p class="mb-0 font-roboto">Classe</p>
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
                            <h6>Stage</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{routeActive('demandes_stages')}}"
                            href="{{ route('demandes_stages') }}">
                            <i class="icofont icofont-tasks-alt"></i>&nbsp&nbsp&nbsp<span>Mes demandes de stage</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{routeActive('demander_stage')}}"
                            href="{{ route('demander_stage') }}"><i
                                class="icofont icofont-paper"></i>&nbsp&nbsp&nbsp<span>Demander un stage</span></a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{routeActive('liste_stages')}}"
                            href="{{ route('liste_stages') }}" ><i
                                class="icofont icofont-listine-dots"></i>&nbsp&nbsp&nbsp<span>La liste des
                                stages confirmés</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{routeActive('gestion_cahier_stage')}}"
                            href="{{ route('gestion_cahier_stage') }}" ><i
                                class="icofont icofont-book-alt"></i>&nbsp&nbsp&nbsp<span>Cahiers de
                                stage</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Entreprise</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{routeActive('liste_entreprises')}}" href="{{ route('liste_entreprises') }}"><i
                                class="icofont icofont-list"></i>&nbsp&nbsp&nbsp<span>La liste des
                                entreprises</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{routeActive('ajouter-entreprise')}}" href="{{ route('ajouter-entreprise') }}"><i
                                class="icofont icofont-building-alt"></i>&nbsp&nbsp&nbsp<span>Ajouter une
                                entreprise</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Dépôt</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{routeActive('depot')}}" href="{{ route('depot') }}">
                        <i class="icofont icofont-papers"></i>&nbsp&nbsp&nbsp<span>Gérer le dépôt </span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Soutenance</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ routeActive('liste_soutenances') }}"
                            href="{{ route('liste_soutenances') }}" ><i
                                class="icofont icofont-graduate-alt"></i>&nbsp&nbsp&nbsp<span>Mes
                                soutenances </span></a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>

