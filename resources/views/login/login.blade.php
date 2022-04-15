@extends('login.log_master')

@section('title')connexion
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
<section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form class="theme-form login-form" method="GET" action="{{ route('connexion') }}">
                        @csrf
                        <h4>Connexion</h4>
                        <!--<h6>Welcome back! Log in to your account.</h6>-->
                        <div class="form-group">
                            <label>Numero de CIN </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="text" required="" id="numero_CIN" name="numero_CIN" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" required="" id="password"
                                    placeholder="*********" />
                                <div class="show-hide"><span class="show"> </span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox" />
                                <label for="checkbox1">Remember password</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Connecter</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@push('scripts')
@endpush

@endsection

