@extends('login.log_master')

@section('title')Connexion
{{ $title }}
@endsection

@push('css')
@endpush

{{--@section('content')
<section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form class="theme-form login-form  needs-validation" novalidate="" method="GET" action="{{ route('connexion') }}">
                        @csrf
                        <h4>Connexion</h4>
                        <!--<h6>Welcome back! Log in to your account.</h6>-->
                        <div class="form-group">
                            <label>Numero de CIN </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="text" required="" id="numero_CIN" name="numero_CIN" />
                                <div class="invalid-tooltip">Entrez votre N°CIN svp!</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" required="" id="password"
                                    placeholder="*********" />
                                <div class="invalid-tooltip">Entrez votre N°CIN svp!</div>
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

<script>
    (function () {
        "use strict";
        window.addEventListener(
            "load",
            function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName("needs-validation");
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener(
                        "submit",
                        function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                });
            },
            false
        );
    })();
</script>



@push('scripts')
@endpush

@endsection--}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/1.jpg') }}" alt="looginpage" /></div>
            <div class="col-xl-7 p-0">
                <div class="login-card">
                    <form class="theme-form login-form needs-validation" novalidate="" method="GET" action="{{ route('connexion') }}">
                        <h4 style="text-align: center;color: #24695c">Connexion</h4>
                        <div class="form-group">
                            <label>Numero de CIN</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icofont icofont-id-card"></i></span>
                                <input class="form-control" type="text" required="" id="numero_CIN" name="numero_CIN" />
                                <div class="invalid-tooltip">Entrez votre N°CIN svp!</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" required="" id="password"/>
                                <div class="invalid-tooltip">Entrez le mot de passe svp!</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function () {
            "use strict";
            window.addEventListener(
                "load",
                function () {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName("needs-validation");
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener(
                            "submit",
                            function (event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add("was-validated");
                            },
                            false
                        );
                    });
                },
                false
            );
        })();
    </script>


    @push('scripts')
    @endpush

@endsection

