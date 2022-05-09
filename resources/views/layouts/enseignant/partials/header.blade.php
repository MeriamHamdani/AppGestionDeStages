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
                        <li>
                            <p class="f-w-700 mb-0"> Vous avez {{
                                App\Models\Enseignant::where('user_id',auth()->id())->first()->notifications->count()
                                }} notifications dont {{
                                App\Models\Enseignant::where('user_id',auth()->id())->first()->unreadNotifications->count()
                                }} non lus
                                <!--<span class="pull-right badge badge-primary badge-pill">4</span>-->
                            </p>
                        </li>
                        @foreach (App\Models\Enseignant::where('user_id',auth()->id())->first()->notifications as
                        $notification )
                        @if ($notification->type==='App\Notifications\DemandeEncadrementNotification')


                        <li class="noti-primary">
                            <div class="media">
                                <span class="notification-bg bg-light-primary"><i data-feather="activity"> </i></span>
                                <div class="media-body">
                                    <p> Demande d'encadrement </p>
                                    <a href={{ route('liste_demandes') }}><span>{{ $notification->data['nom_etud'] }} -
                                            {{
                                            $notification->data['classe_etud'] }}</span></a>
                                    <hr>
                                    <span>{{ $notification->data['date'] }}</span>
                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach


                        <!--<li class="noti-secondary">
                            <div class="media">
                                <span class="notification-bg bg-light-secondary"><i data-feather="check-circle">
                                    </i></span>
                                <div class="media-body">
                                    <p>Order Complete</p>
                                    <span>1 hour ago</span>
                                </div>
                            </div>
                        </li>
                        <li class="noti-success">
                            <div class="media">
                                <span class="notification-bg bg-light-success"><i data-feather="file-text"> </i></span>
                                <div class="media-body">
                                    <p>Tickets Generated</p>
                                    <span>3 hour ago</span>
                                </div>
                            </div>
                        </li>
                        <li class="noti-danger">
                            <div class="media">
                                <span class="notification-bg bg-light-danger"><i data-feather="user-check"> </i></span>
                                <div class="media-body">
                                    <p>Delivery Complete</p>
                                    <span>6 hour ago</span>
                                </div>
                            </div>
                        </li>-->
                    </ul>
                </li>
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>
                <li class="onhover-dropdown p-0">

                    <form method="GET" action="{{ route('deconnexion') }}">
                        @csrf
                        <button class="btn btn-primary-light" type="button" href=route('deconnexion')" onclick="event.preventDefault();
                        this.closest('form').submit();"><i data-feather="log-out"></i>Se Déconnecter</button>
                    </form>

                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>

