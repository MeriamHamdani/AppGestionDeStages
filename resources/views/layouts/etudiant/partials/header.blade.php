<div class="page-main-header">
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
                            <p class="f-w-700 mb-0"> Vous avez {{App\Models\Etudiant::where('user_id',auth()->id())->first()->notifications->count()}} notifications dont
                                {{App\Models\Etudiant::where('user_id',auth()->id())->first()->unreadNotifications->count() }} non lus
                                <!--<span class="pull-right badge badge-primary badge-pill">4</span>-->
                            </p>
                        </li>
                        @foreach (App\Models\Etudiant::where('user_id',auth()->id())->first()->notifications as $notification )
                            @if ($notification->type==='App\Notifications\DownloadLettreAffectationNotification')

                                <li class="noti-secondary">
                                    <div class="media">
                                        <span class="notification-bg bg-light-secondary"><i
                                                data-feather="activity"> </i></span>
                                        <div class="media-body">
                                            <p> Lettre d'affectation </p>
                                            <a href={{ route('liste_stages') }}>
                                        <span style="color: #ba895d"><strong>
                                                Vous avez une demande de stage qui ??tait confirm??e</strong><br>
                                            Veuillez la t??l??charger via la liste des stages</span></a>
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
                                            <p> Demande d'encadrement accept??e </p>
                                            <a href={{ route('liste_stages') }}>
                                        <span style="color: #ba895d"><strong>
                                                Votre demande  d'encadrment est accept??e</strong> </span></a>
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
                                                <p> Demande d'encadrement refus??e </p>
                                        <span style="color: #ba895d"><strong>
                                                Votre demande  d'encadrment est refus??e</strong> </span>
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
                                                <p> Demande de stage refus??e </p>
                                                <span style="color: #ba895d"><strong>
                                                Votre demande de stage est refus??e de la part de l'administration</strong> </span>
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
                                            <p> Session d??p??t est ouverte </p>
                                        <span style="color: #ba895d"><strong>
                                                La session de d??p??t dure de {{ $notification->data['date_debut_depot'] }}
                                            jusqu'??  {{ $notification->data['date_limite_depot'] }}</strong> </span>
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
                                                <p> Session d??p??t est mise ?? jour </p>
                                                <span style="color: #ba895d"><strong>
                                                La session de d??p??t a subit des modifications au niveau des dates, le nouvel intervalle: {{ $notification->data['date_debut_depot'] }} ??
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
                                                <p> M??moire valid?? par encadrant </p>
                                                <a href={{ route('depot') }}>
                                        <span style="color: #ba895d"><strong>
                                               Votre m??moire est bien valid?? par votre encadrant</strong></span></a>
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
                                                <p> M??moire est bien d??pos?? </p>
                                                <a href={{ route('depot') }}>
                                        <span style="color: #ba895d"><strong>
                                                Votre m??moire est bien valid??.</strong><br/> L'encadrant et l'administration ont valid?? votre m??moire d??pos??</span></a>
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
                                                <p> M??moire doit ??tre corrig??! </p>
                                                <a href={{ route('depot') }}>
                                        <span style="color: #ba895d"><strong>
                                                Votre m??moire est bien valid??.</strong><br/> L'encadrant a refus?? votre demande de d??p??t de m??moire d??pos??
                                        <br> Vous trouvez les commentaires de l'encadrant dans la liste de demande de d??p??t de m??moire</span></a>
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
                        'form').submit();"><i data-feather="log-out"></i>Se D??connecter</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
