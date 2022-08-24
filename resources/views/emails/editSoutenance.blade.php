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
                                                    <p>Bonjour Mme/Mr &nbsp;{{ ucwords($notifiable->nom) }}&nbsp;{{
                                                        ucwords($notifiable->prenom) }}</p>

                                                </div>
                                                @if($etatt=='ancien')
                                                <div class="read-group">

                                                    <p>
                                                        Nous vous informe que vous n'etes plus le {{ $post }} de la
                                                        soutenance
                                                        de l'etudiant "{{ucwords($etudiant->nom)}}&nbsp;{{
                                                        ucwords($etudiant->prenom) }}" qui est le {{ $soutenance->date
                                                        }} à
                                                        {{ $soutenance->start_time }}
                                                    </p>
                                                    <p class="m-t-10">
                                                    </p>
                                                    <p>Cordialement</p>
                                                </div>
                                                @elseif($etatt=='nouveau')
                                                <div class="read-group">

                                                    <p>
                                                        Vous etes affecté(e) comme {{ $post}} pour la soutenance de
                                                        l'étudiant(e) "{{ucwords($etudiant->nom)}}&nbsp;{{
                                                        ucwords($etudiant->prenom) }}", inscrit au "{{
                                                        App\Models\Classe::find($etudiant->classe_id)->nom }}".<br>
                                                        <hr>
                                                        Le planning est comme suit:<br>
                                                        <strong>Date : </strong>{{ $soutenance->date }} <br>
                                                        <strong> Salle :</strong> {{ $soutenance->salle }}<br>
                                                        <strong>Heure : </strong>{{ $soutenance->start_time }}<br>
                                                        @php
                                                        $pres=App\Models\Enseignant::find($soutenance->president_id);
                                                        $rapp=App\Models\Enseignant::find($soutenance->rapporteur_id);
                                                        $membre=App\Models\Enseignant::find($soutenance->deuxieme_membre_id);
                                                        @endphp
                                                        <strong>Président de jury :</strong> {{ ucwords($pres->nom)
                                                        }}&nbsp;{{
                                                        ucwords($pres->prenom)
                                                        }}<br>
                                                        <strong>Rapporteur :</strong> {{
                                                        ucwords($rapp->nom) }}&nbsp;{{ucwords( $rapp->prenom )}}<br>
                                                        <strong>Membre de jury :</strong>
                                                        @if($soutenance->deuxieme_membre_id !=null)
                                                        {{
                                                        ucwords($membre->nom) }}&nbsp;{{ucwords( $membre->prenom )}}<br>
                                                        @else
                                                        --
                                                        @endif
                                                    </p>
                                                    <p class="m-t-10">
                                                    </p>
                                                    <p>Cordialement</p>
                                                </div>
                                                @else
                                                @if($post=='etudiant')
                                                <div class="read-group">
                                                    @php
                                                    $mem=App\Models\Enseignant::find($soutenance->deuxieme_membre_id);
                                                    $rap=App\Models\Enseignant::find($soutenance->rapporteur_id);
                                                    $pres=App\Models\Enseignant::find($soutenance->president_id);
                                                    @endphp
                                                    <p>

                                                        Des modifications sur le Planning de votre soutenance sont
                                                        effectués<<br>
                                                            Le nouveau planning est comme suit : <br>

                                                            Date : {{ $soutenance->date }} <br>
                                                            Salle : {{ $soutenance->salle }}<br>
                                                            Heure : {{ $soutenance->start_time }}<br>
                                                            @php
                                                            $stage=App\Models\stage::find($soutenance->stage_id);
                                                            $encadrant=App\Models\Enseignant::find($stage->enseignant_id);
                                                            @endphp

                                                            <strong>Encadrant : </strong>{{
                                                            ucwords($encadrant->nom) }}&nbsp;{{
                                                            ucwords($encadrant->prenom) }}<br>

                                                            <strong>Président de jury : </strong>{{
                                                            ucwords($rap->nom) }}&nbsp;{{ucwords( $pres->prenom )}}<br>
                                                            <strong>Rapporteur :</strong> {{
                                                            ucwords($rap->nom) }}&nbsp;{{ ucwords($rap->prenom) }}<br>
                                                            @if($soutenance->deuxieme_membre_id)
                                                            <strong>Le 2ème membre : </strong>{{
                                                            ucwords($mem->nom) }}&nbsp;{{ ucwords($mem->prenom) }}
                                                            @else
                                                            <strong>Le 2ème membre : </strong> ----
                                                            @endif
                                                    </p>

                                                    <p class="m-t-10">
                                                    </p>
                                                    <p>Cordialement</p>
                                                </div>
                                                @elseif($post=='encadrant')
                                                <div class="read-group">
                                                    @php
                                                    $mem=App\Models\Enseignant::find($soutenance->deuxieme_membre_id);
                                                    $rap=App\Models\Enseignant::find($soutenance->rapporteur_id);
                                                    $pres=App\Models\Enseignant::find($soutenance->president_id);
                                                    @endphp
                                                    <p>

                                                        Des modifications sur le Planning de la soutenance de l'étudianr
                                                        {{ ucwords($etudiant->nom) }}&nbsp;{{ ucwords($etudiant->prenom)
                                                        }} sont
                                                        effectuées<<br>
                                                            Le nouveau planning est comme suit : <br>

                                                            Date : {{ $soutenance->date }} <br>
                                                            Salle : {{ $soutenance->salle }}<br>
                                                            Heure : {{ $soutenance->start_time }}<br>
                                                            <strong>Président de jury : </strong>{{
                                                            ucwords($rap->nom) }}&nbsp;{{ucwords( $pres->prenom )}}<br>
                                                            <strong>Rapporteur :</strong> {{
                                                            ucwords($rap->nom) }}&nbsp;{{ ucwords($rap->prenom) }}<br>
                                                            @if($soutenance->deuxieme_membre_id)
                                                            <strong>Le 2ème membre : </strong>{{
                                                            ucwords($mem->nom) }}&nbsp;{{ ucwords($mem->prenom) }}
                                                            @else
                                                            <strong>Le 2ème membre : </strong> ----
                                                            @endif
                                                    </p>

                                                    <p class="m-t-10">
                                                    </p>
                                                    <p>Cordialement</p>
                                                </div>
                                                @endif
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
