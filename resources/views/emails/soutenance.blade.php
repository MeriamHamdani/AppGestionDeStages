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

                                                            <h6 class="d-block">{{ ucwords($notifiable->nom) }}&nbsp;{{
                                                                ucwords($notifiable->prenom) }}</h6>

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

                                                @if($post!='etudiant')
                                                <div class="read-group">

                                                    <p>
                                                        @if($post!='encadrant')


                                                        Vous etes affecté(e) comme {{ $post}} pour la soutenance de
                                                        l'étudiant(e) "{{ucwords($etudiant->nom)}}&nbsp;{{
                                                        ucwords($etudiant->prenom) }}"", inscrit au "{{
                                                        App\Models\Classe::find($etudiant->classe_id)->nom }}".<br>
                                                        <hr>
                                                        Le planning est comme suit:

                                                        @else
                                                        Le planning de soutenance de l'étudiant(e) "
                                                        {{ucwords($etudiant->nom)}}&nbsp;{{
                                                        ucwords($etudiant->prenom) }}" qui vous le supervise et qui est
                                                        inscrit au {{
                                                        App\Models\Classe::find($etudiant->classe_id)->nom }}, est comme
                                                        suit:
                                                        @endif
                                                        <br>
                                                        <strong>Date : </strong>{{ $soutenance->date }} <br>
                                                        <strong> Salle :</strong> {{ $soutenance->salle }}<br>
                                                        <strong>Heure : </strong>{{ $soutenance->start_time }}<br>
                                                        @if ($post!='encadrant')
                                                        <strong>Encadrant :</strong> {{
                                                        $encadrant }}<br>
                                                        @endif
                                                        @if ($post!='president')
                                                        @php
                                                        $pres=App\Models\Enseignant::find($soutenance->president_id);
                                                        @endphp
                                                        <strong>Président de jury :</strong> {{ ucwords($pres->nom)
                                                        }}&nbsp;{{
                                                        ucwords($pres->prenom)
                                                        }}<br>
                                                        @endif
                                                        @if ($post!='rapporteur')
                                                        @php
                                                        $rap=App\Models\Enseignant::find($soutenance->rapporteur_id);
                                                        @endphp
                                                        <strong>Rapporteur :</strong> {{
                                                        ucwords($rap->nom) }}&nbsp;{{ucwords( $rap->prenom )}}<br>
                                                        @endif
                                                        @if ($post!='membre')
                                                        @php
                                                        $mem=App\Models\Enseignant::find($soutenance->deuxieme_membre_id);
                                                        @endphp
                                                        <strong>Le 2ème membre :</strong> {{
                                                        ucwords($mem->nom) }}&nbsp;{{ ucwords($mem->prenom) }}
                                                        @endif
                                                    </p>

                                                    <p class="m-t-10">
                                                    </p>
                                                    <p>Cordialement</p>
                                                </div>
                                                @else
                                                <div class="read-group">
                                                    @php
                                                    $mem=App\Models\Enseignant::find($soutenance->deuxieme_membre_id);
                                                    $rap=App\Models\Enseignant::find($soutenance->rapporteur_id);
                                                    $pres=App\Models\Enseignant::find($soutenance->president_id);
                                                    @endphp
                                                    <p>

                                                        Le Planning de votre soutenance est comme suit : <br>

                                                        Date : {{ $soutenance->date }} <br>
                                                        Salle : {{ $soutenance->salle }}<br>
                                                        Heure : {{ $soutenance->start_time }}<br>
                                                        <strong>Encadrant : </strong>{{
                                                        $encadrant }}<br>

                                                        <strong>Président de jury : </strong>{{
                                                        ucwords($rap->nom) }}&nbsp;{{ucwords( $pres->prenom )}}<br>
                                                        <strong>Rapporteur :</strong> {{
                                                        ucwords($rap->nom) }}&nbsp;{{ ucwords($rap->prenom) }}<br>
                                                        <strong>Le 2ème membre : </strong>{{
                                                        ucwords($mem->nom) }}&nbsp;{{ ucwords($mem->prenom) }}
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

