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
                                                            <h6 class="d-block">{{ $details['etudiant'] }}</h6>

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
                                                        Votre demande de stage est confirmée.<br>
                                                        @if(isset($details['encadrant']))
                                                        <span>Encadrant: {{$details['encadrant'] }}</span><br>
                                                        @endif
                                                        <span>Stage {{$details['type_stage'] }}</span><br>

                                                    </p>
                                                    <p class="m-t-10">
                                                        Veuillez consulter votre compte sur l'application pour pouvoir
                                                        télécharger votre lettre d'affectation</p>
                                                    <p>Cordialement</p>
                                                </div>
                                            </div>

                                            <!--<div class="emailread-group">
                                                <div class="action-wrapper">
                                                    <ul class="actions">
                                                        <li>
                                                            <a class="btn btn-primary" href="javascript:void(0)"><i
                                                                    class="fa fa-reply me-2"></i>confirmer</a>
                                                        </li>

                                                        <li>
                                                            <a class="btn btn-danger" href="javascript:void(0)"><i
                                                                    class="fa fa-share me-2"></i>refuser</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>-->
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
