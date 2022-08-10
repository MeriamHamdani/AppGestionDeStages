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
                                                            src="{{asset('assets/images/user/user.png')}}" alt="" />
                                                        <div class="media-body">
                                                            <h6 class="d-block">{{ $data['nom_ens'] }}</h6>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="email-wrapper">
                                            <div class="emailread-group">
                                                <div class="read-group">
                                                    <p>Bonjour Mme/Mr</p>

                                                </div>

                                                @if($data['post']!='')
                                                <div class="read-group">

                                                    <p>

                                                        Vous etes affecté(e) comme {{ $data['post'] }} <br>
                                                        Planning de soutenance : <br>

                                                        Le planning de soutenance de l'étudiant {{ $data['etud'] }}


                                                        Date : {{ $data['date'] }} <br>
                                                        Salle : {{ $data['salle'] }}<br>
                                                        Heure : {{ $data['heure'] }}<br>
                                                        @if ($date['post']!='encadrant')
                                                        Encadrant : {{ $data['encadrant'] }}<br>
                                                        @endif
                                                        @if ($date['post']!='president')
                                                        Président de jury : {{ $data['president'] }}<br>
                                                        @endif
                                                        @if ($date['post']!='rapporteur')
                                                        Rapporteur : {{ $data['rapporteur'] }}<br>
                                                        @endif
                                                        @if ($date['post']!='membre')
                                                        Le 2ème membre : {{ $data['membre'] }}
                                                        @endif
                                                    </p>

                                                    <p class="m-t-10">
                                                    </p>
                                                    <p>Cordialement</p>
                                                </div>
                                                @else
                                                <div class="read-group">

                                                    <p>

                                                        Le Planning de votre soutenance est comme suit : <br>

                                                        Date : {{ $data['date'] }} <br>
                                                        Salle : {{ $data['salle'] }}<br>
                                                        Heure : {{ $data['heure'] }}<br>
                                                        Encadrant : {{ $data['encadrant'] }}<br>
                                                        Président de jury : {{ $data['president'] }}<br>
                                                        Rapporteur : {{ $data['rapporteur'] }}<br>
                                                        Le 2ème membre : {{ $data['membre'] }}
                                                    </p>

                                                    <p class="m-t-10">
                                                    </p>
                                                    <p>Cordialement</p>
                                                </div>
                                                @endif
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

