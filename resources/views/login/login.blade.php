@extends('login.log_master')

@section('title')Connexion
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/1.jpg') }}"
                alt="looginpage" /></div>
        <div class="col-xl-7 p-0">
            <div class="login-card">
                <form class="theme-form login-form needs-validation" novalidate="" method="POST"
                    action="{{ route('connexion') }}">
                    @csrf
                    <h4 style="text-align: center;color: #24695c">Connexion</h4>
                    <div class="form-group">
                       <label>Numéro de CIN</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icofont icofont-id-card"></i></span>
                            <input class="form-control" type="text" required="" id="numero_CIN" name="numero_CIN"
                                placeholder="Numéro de CIN" value="{{old('numero_CIN')}}" />
                            <div class="invalid-tooltip">Entrez votre N°CIN svp!</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                            <input class="form-control" type="password" name="password" required="" id="password"
                                placeholder="Mot de passe" />
                            <div class="invalid-tooltip">Entrez le mot de passe svp!</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Se connecter</button>
                    </div>
                    <a href={{ route('mot_de_passe_oublie') }}>mot de passe oublié ?</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::get('message')=='pas de cin')
<script>
    swal({
                position: 'center',
                icon: 'error',
                title: 'Numéro de CIN invalide!',
                button: 'Ok',
                timer: 2500
            })

</script>


@endif
@if (Session::get('message')=='mdp icorrect')
<script>
    swal({
                position: 'center',
                icon: 'error',
                title: 'Mot de passe incorrect!',
                button: 'Ok',
                timer: 2500
            })

</script>


@endif

@endpush

@endsection

