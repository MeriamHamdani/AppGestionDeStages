fd<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper"><a href=""><img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}"
                                                      alt=""></a></div>
            <div class="dark-logo-wrapper"><a href=""><img class="img-fluid"
                                                           src="{{asset('assets/images/logo/dark-logo.png')}}"
                                                           alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">
                </i></div>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li class="onhover-dropdown">
                    <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
                    <ul class="notification-dropdown onhover-show-div">
                        <li>
                            <p class="f-w-700 mb-0"> Vous avez {{App\Models\Etudiant::where('user_id',auth()->id())->latest()->first()->notifications->count()}} notifications dont
                                {{App\Models\Etudiant::where('user_id',auth()->id())->first()->unreadNotifications->count() }} non lus

                                <!--<span class="pull-right badge badge-primary badge-pill">4</span>-->
                            </p>
                        </li>
                        @foreach (App\Models\Etudiant::where('user_id',auth()->id())->latest()->first()->notifications as $notification )
                            @if ($notification->type==='App\Notifications\DownloadLettreAffectationNotification')

                                <li class="noti-secondary">
                                    <div class="media">
                                        <span class="notification-bg bg-light-secondary"><i
                                                data-feather="activity"> </i></span>
                                        <div class="media-body">
                                            <p> Lettre d'affectation </p>
                                            <a href={{ route('liste_stages') }}>
                                        <span style="color: #ba895d"><strong>
                                                Vous avez une demande de stage qui était confirmée</strong><br>
                                            Veuillez la télécharger via la liste des stages</span></a>
                                            <hr>
                                            <span>{{ $notification->data['date'] }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($notification->type=='App\Notifications\EncadrementAccepteNotifiaction')
                                <li class="noti-secondary">
                                    <div class="media">
                                        <span class="notification-bg bg-light-secondary"><i
                                                data-feather="activity"> </i></span>
                                        <div class="media-body">
                                            <p> Demande d'encadrement acceptée </p>
                                            <a href={{ route('liste_stages') }}>
                                        <span style="color: #ba895d"><strong>
                                                Votre demande  d'encadrment est acceptée</strong> </span></a>
                                            <hr>
                                            <span>{{ $notification->data['date'] }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                                @if($notification->type=='App\Notifications\EncadrementRefuseNotifiaction')
                                    <li class="noti-secondary">
                                        <div class="media">
                                        <span class="notification-bg bg-light-secondary"><i
                                                data-feather="activity"> </i></span>
                                            <div class="media-body">
                                                <p> Demande d'encadrement refusée </p>
                                        <span style="color: #ba895d"><strong>
                                                Votre demande  d'encadrment est refusée</strong> </span>
                                                <hr>
                                                <span>{{ $notification->data['date'] }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if($notification->type=='App\Notifications\DemandeStageRefuseNotification')
                                    <li class="noti-secondary">
                                        <div class="media">
                                        <span class="notification-bg bg-light-danger"><i
                                                data-feather="activity"> </i></span>
                                            <div class="media-body">
                                                <p> Demande de stage refusée </p>
                                                <span style="color: #ba895d"><strong>
                                                Votre demande de stage est refusée de la part de l'administration</strong> </span>
                                                <hr>
                                                <span>{{ $notification->data['date'] }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @if($notification->type=='App\Notifications\SessionDepotOuverteNotification')
                                <li class="noti-secondary">
                                    <div class="media">
                                        <span class="notification-bg bg-light-secondary"><i
                                                data-feather="activity"> </i></span>
                                        <div class="media-body">
                                            <p> Session dépôt est ouverte </p>
                                        <span style="color: #ba895d"><strong>
                                                La session de dépôt dure de {{ $notification->data['date_debut_depot'] }}
                                            jusqu'à  {{ $notification->data['date_limite_depot'] }}</strong> </span>
                                            <hr>
                                            <span>{{ $notification->data['date'] }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                                @if($notification->type=='App\Notifications\SessionDepotModifieNotification')
                                    <li class="noti-secondary">
                                        <div class="media">
                                        <span class="notification-bg bg-light-secondary"><i
                                                data-feather="activity"> </i></span>
                                            <div class="media-body">
                                                <p> Session dépôt est mise à jour </p>
                                                <span style="color: #ba895d"><strong>
                                                La session de dépôt a subit des modifications au niveau des dates, le nouvel intervalle: {{ $notification->data['date_debut_depot'] }} à
                                          {{ $notification->data['date_limite_depot'] }}</strong> </span>
                                                <hr>
                                                <span>{{ $notification->data['date'] }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if ($notification->type==='App\Notifications\DepotMemoireValideParEncadrantNotification')

                                    <li class="noti-secondary">
                                        <div class="media">
                                        <span class="notification-bg bg-light-secondary"><i
                                                data-feather="activity"> </i></span>
                                            <div class="media-body">
                                                <p> Mémoire validé par encadrant </p>
                                                <a href={{ route('depot') }}>
                                        <span style="color: #ba895d"><strong>
                                               Votre mémoire est bien validé par votre encadrant</strong></span></a>
                                                <hr>
                                                <span>{{ $notification->data['date'] }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if ($notification->type==='App\Notifications\DepotMemoireValideParAdminNotification')

                                    <li class="noti-secondary">
                                        <div class="media">
                                        <span class="notification-bg bg-light-secondary"><i
                                                data-feather="activity"> </i></span>
                                            <div class="media-body">
                                                <p> Mémoire est bien déposé </p>
                                                <a href={{ route('depot') }}>
                                        <span style="color: #ba895d"><strong>
                                                Votre mémoire est bien validé.</strong><br/> L'encadrant et l'administration ont validé votre mémoire déposé</span></a>
                                                <hr>
                                                <span>{{ $notification->data['date'] }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if ($notification->type==='App\Notifications\DepotMemoireRefuseParEncadrantNotification')

                                    <li class="noti-secondary">
                                        <div class="media">
                                        <span class="notification-bg bg-light-secondary"><i
                                                data-feather="activity"> </i></span>
                                            <div class="media-body">
                                                <p> Mémoire doit être corrigé! </p>
                                                <a href={{ route('depot') }}>
                                        <span style="color: #ba895d"><strong>
                                                Votre mémoire est bien validé.</strong><br/> L'encadrant a refusé votre demande de dépôt de mémoire déposé
                                        <br> Vous trouvez les commentaires de l'encadrant dans la liste de demande de dépôt de mémoire</span></a>
                                                <hr>
                                                <span>{{ $notification->data['date'] }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if ($notification->type==='App\Notifications\DepotMemoireRefuseParAdminNotification')

                                    <li class="noti-secondary">
                                        <div class="media">
                                        <span class="notification-bg bg-light-danger"><i
                                                data-feather="activity"> </i></span>
                                            <div class="media-body">
                                                <p> Dépôt refusée par l'administration! </p>
                                                <a href={{ route('depot') }}>
                                        <span style="color: #ba895d"><strong>
                                                Demande de dépôt refusée par l'administration.</strong><br/> L'administration a refusé votre demande de dépôt de mémoire déposé
                                        <br> Veuillez redépôser votre mémoire et les fichiers nécessaires.</span></a>
                                                <hr>
                                                <span>{{ $notification->data['date'] }}</span>
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
                        <button class="btn btn-primary-light" type="button"
                                href={{ route('deconnexion') }} onclick="event.preventDefault();
                                this.closest(
                        'form').submit();"><i data-feather="log-out"></i>Se Déconnecter</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
