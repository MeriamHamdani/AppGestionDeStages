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
                                                <div class="read-group">

                                                    <p>
                                                        Vous avez une demande d'encadrement de la part de {{
                                                        $data['nom_etud'] }}
                                                        étudiant(e) au {{ $data['classe_etud'] }} à l'{{
                                                        $data['etablissement'] }}.


                                                    </p>
                                                    <p class="m-t-10">
                                                        Merci de consulter votre compte sur l'application pour pouvoir
                                                        bien répondre à cette demande par l'acceptation ou par
                                                        le refus.</p>
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
