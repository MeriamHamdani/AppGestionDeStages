@push('css')
@endpush

<div class="container-fluid">
    <div class="email-wrap">
        <div class="row">

            <div class="col-xl-9 col-md-12 xl-60">
                <div class="email-right-aside">
                    <div class="card email-body">
                        <div class="email-profile">
                            <div class="email-right-aside">
                                <div class="email-body">
                                    <div class="email-content">
                                        <div class="email-top">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="media">
                                                        <img class="me-3 rounded-circle"
                                                             src="{{asset('assets/images/user/user.png')}}" alt=""/>
                                                        <div class="media-body">
                                                            <h6 class="d-block">{{ $data['nom_etud'] }}</h6>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="email-wrapper">
                                            <div class="emailread-group">
                                                <div class="read-group">
                                                    <p>
                                                        La session de dépôt de mémoire a subit quelques modifications.
                                                        Voici les détails après mise à jour:
                                                    <ul>
                                                        <li>Date début de dépôt: {{ $data['date_debut_depot'] }} </li>
                                                        <li>Date limite de dépôt: {{ $data['date_limite_depot'] }} </li>
                                                    </ul>
                                                    </p>
                                                    <p>
                                                    Vous devez respecter cet intervalle et déposer votre mémoire et les
                                                    fichiers nécessaires dans les délais.</p>
                                                    <p>Cordialement</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{asset('assets/js/editor/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/js/editor/ckeditor/adapters/jquery.js')}}"></script>
    <script src="{{asset('assets/js/email-app.js')}}"></script>
@endpush
