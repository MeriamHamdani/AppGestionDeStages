<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper"><a href=""><img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}"
                        alt=""></a></div>
            <div class="dark-logo-wrapper"><a href=""><img class="img-fluid"
                        src="{{asset('assets/images/logo/dark-logo.png')}}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">
                </i></div>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li class="onhover-dropdown">
                    <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
                    <ul class="notification-dropdown onhover-show-div">
                        <!--<li>
                            <p class="f-w-700 mb-0"> Vous
                                avez
                                {{App\Models\Enseignant::where('user_id',auth()->id())->first()->notifications->count()}}
                                notifications
                                dont {{
                                App\Models\Enseignant::where('user_id',auth()->id())->first()->unreadNotifications->count()}}
                                non lus

                            </p>
                        </li>-->
                        @foreach (App\Models\Enseignant::where('user_id',auth()->id())->first()->notifications as
                        $notification )
                        @if ($notification->type==='App\Notifications\DemandeEncadrementNotification')
                        <li class="noti-secondary">
                            <div class="media">
                                <span class="notification-bg bg-light-secondary"><i data-feather="user"> </i></span>
                                <div class="media-body">
                                    <p> Demande d'encadrement</p>
                                    <a href={{ route('liste_demandes') }}>
                                        <span style="color: #ba895d"><strong>{{ $notification->data['nom_etud'] }} -
                                                {{ $notification->data['classe_etud'] }}</strong></span></a>
                                    <hr>
                                    <span>{{ $notification->data['date'] }}</span>
                                </div>
                            </div>
                        </li>
                        @endif
                        @if ($notification->type==='App\Notifications\DownloadFicheEncadrementNotification')

                        <li class="noti-secondary">
                            <div class="media">
                                <span class="notification-bg bg-light-secondary"><i data-feather="activity"> </i></span>
                                <div class="media-body">
                                    <p> Fiche d'encadrement </p>
                                    <a href={{ route('liste_stages_actifs') }}>
                                        <strong style="color: #ba895d"><span>
                                                Le stage de l'étudiant {{ $notification->data['etudiant'] }} est
                                                confirmé par l'administration, vous pouvez télécharger la fiche
                                                d'encadrement </span> </strong></a>
                                    <hr>
                                    <span>{{ $notification->data['date'] }}</span>
                                </div>
                            </div>
                        </li>
                        @endif
                        @if ($notification->type==='App\Notifications\DemandeDepotMemoireNotification')
                        <li class="noti-secondary">
                            <div class="media">
                                <span class="notification-bg bg-light-secondary"><i data-feather="user"> </i></span>
                                <div class="media-body">
                                    <p> Demande de dépôt de mémoire</p>
                                    <a href={{ route('depots') }}>
                                        <span style="color: #ba895d"><strong>{{ $notification->data['nom_etud'] }} -
                                                {{ $notification->data['classe_etud'] }} a dépôsé son mémoire. Veuillez
                                                consulter la liste des demandes pour mettre votre
                                                décision</strong></span></a>
                                    <hr>
                                    <span>{{ $notification->data['date'] }}</span>
                                </div>
                            </div>
                        </li>
                        @endif
                        @if ($notification->type==='App\Notifications\DemandeRedepotMemoireNotification')
                        <li class="noti-secondary">
                            <div class="media">
                                <span class="notification-bg bg-light-secondary"><i data-feather="user"> </i></span>
                                <div class="media-body">
                                    <p> Dépôt de mémoire corrigé</p>
                                    <a href={{ route('depots') }}>
                                        <span style="color: #ba895d"><strong>{{ $notification->data['nom_etud'] }} -
                                                {{ $notification->data['classe_etud'] }} a dépôsé son mémoire corrigé.
                                                Veuillez consulter la liste des demandes pour remettre votre
                                                décision</strong></span></a>
                                    <hr>
                                    <span>{{ $notification->data['date'] }}</span>
                                </div>
                            </div>
                        </li>
                        @endif
                        @if($notification->type==='App\Notifications\SoutenanceNotification')
                        <li class="noti-secondary">
                            <div class="media">
                                <span class="notification-bg bg-light-secondary"><i data-feather="user"> </i></span>
                                <div class="media-body">
                                    <p>
                                        planification de soutenance: {{
                                        $notification->data['post'] }}
                                    </p>

                                    @php
                                    $pst=str_replace(' ', '-', $notification->data['post']);
                                    @endphp

                                    <span style="color: #ba895d"><strong> Vous etes affecter comme {{
                                            $notification->data['post'] }} d'une soutenance.
                                            Veuillez consulter votre boite e-mail pour cosulter les
                                            informations
                                            de
                                            cette soutenance.</strong></span>

                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>
                <li class="onhover-dropdown p-0">

                    <form method="GET" action="{{ route('deconnexion') }}">
                        @csrf
                        <button class="btn btn-primary-light" type="button" href={{ route('deconnexion') }} onclick="event.preventDefault();
                                this.closest('form').submit();"><i data-feather="log-out"></i>Se Déconnecter</button>
                    </form>

                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>

