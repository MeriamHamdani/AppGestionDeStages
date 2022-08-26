<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <title>Modification de mot de passe</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    @includeIf('layouts.etudiant.partials.css')
</head>

<body>

    <div class="page-wrapper" id="pageWrapper">
        <div class="error-wrapper">
            <div class="container">
                <div class="error-page1">
                    <div class="svg-wrraper mb-0">
                        <svg class="svg-60" viewbox="0 0 1920 1080" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path class="warning-color"
                                    d="M600.87,872H156a4,4,0,0,0-3.78,4.19h0a4,4,0,0,0,3.78,4.19H600.87a4,4,0,0,0,3.78-4.19h0A4,4,0,0,0,600.87,872Z">
                                </path>
                                <rect class="warning-color" height="8.39" rx="4.19" ry="4.19" width="513.38" x="680.91"
                                    y="871.98"></rect>
                                <path class="warning-color"
                                    d="M1480,876.17h0c0,2.32,2.37,4.19,5.3,4.19h350.61c2.93,0,5.3-1.88,5.3-4.19h0c0-2.32-2.37-4.19-5.3-4.19H1485.26C1482.33,872,1480,873.86,1480,876.17Z">
                                </path>
                                <rect class="warning-color" height="8.39" rx="4.19" ry="4.19" width="249.8" x="492.21"
                                    y="920.64"></rect>
                                <path class="warning-color"
                                    d="M1549.14,924.84h0a4.19,4.19,0,0,0-4.19-4.19H1067.46a14.66,14.66,0,0,1,.35,3.21v1A4.19,4.19,0,0,0,1072,929h472.94A4.19,4.19,0,0,0,1549.14,924.84Z">
                                </path>
                                <path class="warning-color"
                                    d="M865.5,924.84h0a4.19,4.19,0,0,0,4.19,4.19h82.37a12.28,12.28,0,0,1-.19-2v-2.17a4.19,4.19,0,0,0-4.19-4.19h-78A4.19,4.19,0,0,0,865.5,924.84Z">
                                </path>
                                <rect class="warning-color" height="8.39" rx="4.19" ry="4.19" width="54.72" x="915.6"
                                    y="981.47"></rect>
                                <path class="warning-color"
                                    d="M730.33,985.67h0c0,2.32,4.23,4.19,9.44,4.19h104.3c5.22,0,9.44-1.88,9.44-4.19h0c0-2.32-4.23-4.19-9.44-4.19H739.78C734.56,981.47,730.33,983.35,730.33,985.67Z">
                                </path>
                                <rect class="warning-color" height="8.39" rx="4.19" ry="4.19" width="78.11" x="997.06"
                                    y="981.47"></rect>
                                <g id="round-conf">
                                    <path class="warning-color circle c1"
                                        d="M536.41,155.14a17.77,17.77,0,1,0,17.77,17.77A17.77,17.77,0,0,0,536.41,155.14Zm0,28.68a10.9,10.9,0,1,1,10.9-10.9A10.9,10.9,0,0,1,536.41,183.81Z">
                                    </path>
                                    <path class="warning-color circle c1"
                                        d="M1345.09,82.44a17.77,17.77,0,1,0,17.77,17.77A17.77,17.77,0,0,0,1345.09,82.44Zm0,28.68a10.9,10.9,0,1,1,10.9-10.9A10.9,10.9,0,0,1,1345.09,111.12Z">
                                    </path>
                                    <path class="warning-color circle c1"
                                        d="M70.12,363A17.77,17.77,0,1,0,87.89,380.8,17.77,17.77,0,0,0,70.12,363Zm0,28.68A10.9,10.9,0,1,1,81,380.8,10.9,10.9,0,0,1,70.12,391.7Z">
                                    </path>
                                    <path class="warning-color circle c1"
                                        d="M170.47,751.82a17.77,17.77,0,1,0,17.77,17.77A17.77,17.77,0,0,0,170.47,751.82Zm0,28.68a10.9,10.9,0,1,1,10.9-10.9A10.9,10.9,0,0,1,170.47,780.5Z">
                                    </path>
                                    <path class="warning-color circle c1"
                                        d="M1457.34,762.73a17.77,17.77,0,1,0,17.77,17.77A17.77,17.77,0,0,0,1457.34,762.73Zm0,28.68a10.9,10.9,0,1,1,10.9-10.9A10.9,10.9,0,0,1,1457.34,791.4Z">
                                    </path>
                                    <path class="warning-color circle c1"
                                        d="M1829.15,407.49a17.77,17.77,0,1,0,17.77,17.77A17.77,17.77,0,0,0,1829.15,407.49Zm0,28.68a10.9,10.9,0,1,1,10.9-10.9A10.9,10.9,0,0,1,1829.15,436.17Z">
                                    </path>
                                </g>
                            </g>


                            <g class="bicycle" data-name="Layer 5">
                                <path class="warning-color wheel"
                                    d="M1139.82,780.44a76.59,76.59,0,1,0-57.9,91.53A76.59,76.59,0,0,0,1139.82,780.44Zm-28.12,6.33a47.59,47.59,0,0,1,.83,15.8c-30.14-6.28-47.68-21.65-54.39-52.52A47.73,47.73,0,0,1,1111.69,786.77Zm-70.46-30.9c10.35,26.88,10.14,50.4-13.73,70.77a47.67,47.67,0,0,1,13.73-70.77Zm34.35,88a47.55,47.55,0,0,1-34.94-5.62c16.8-20.36,41.71-25.94,67.09-19.46A47.66,47.66,0,0,1,1075.58,843.85Z">
                                </path>
                                <path class="warning-color wheel"
                                    d="M864.89,789.69a76.59,76.59,0,1,0-66.13,85.78A76.59,76.59,0,0,0,864.89,789.69Zm-28.59,3.7a47.59,47.59,0,0,1-.64,15.81c-29.43-9-45.47-26-49.3-57.33A47.73,47.73,0,0,1,836.3,793.39ZM769,756.1c7.82,27.72,5.43,51.12-20.22,69.2A47.67,47.67,0,0,1,769,756.1Zm26.06,90.78a47.55,47.55,0,0,1-34.27-8.83c18.61-18.72,43.93-22,68.6-13.16A47.66,47.66,0,0,1,795.06,846.88Z">
                                </path>
                                <g>
                                    <rect class="warning-color" height="53.21"
                                        transform="translate(-165.97 273.38) rotate(-16.19)" width="12.87" x="871.39"
                                        y="693.37"></rect>
                                    <path class="secondary-color lighten-5"
                                        d="M813.93,679.35c-3.72-5.2,2.24-18.5,9.16-16.13,33.43,11.46,73.85,10.45,73.85,10.45,8.84.15,14.44,10.34,7.27,15.48-14.36,8.79-33.13,17-56.35,9.76C830.17,693.41,819.83,687.6,813.93,679.35Z">
                                    </path>
                                    <path class="secondary-color opacity-o4"
                                        d="M813.93,679.35c-3.72-5.2,2.24-18.5,9.16-16.13,33.43,11.46,73.85,10.45,73.85,10.45,8.84.15,14.44,10.34,7.27,15.48-14.36,8.79-33.13,17-56.35,9.76C830.17,693.41,819.83,687.6,813.93,679.35Z">
                                    </path>
                                    <path class="secondary-color lighten-5"
                                        d="M817.15,680.06c-3.59-5,1.69-16.51,8.37-14.22,32.3,11.09,71.41,7.83,71.41,7.83,8.54.14,17.45,9.94,7.43,15.88-13.87,8.51-32,16.44-54.44,9.44C832.84,693.67,822.85,688,817.15,680.06Z">
                                    </path>
                                </g>
                                <g>
                                    <circle class="warning-color" cx="1022.66" cy="599.55" r="11.57"
                                        transform="translate(-4.86 8.38) rotate(-0.47)"></circle>
                                    <path class="warning-color"
                                        d="M1069.76,792.37l-34.89-96.74,1.93-.8-1.71-4.15-1.74.72-13.26-36.76,1.27-.42-2.25-6.76,5.94-2-2.57-7.72-9.7,3.22c-11.55-22.55,2-36.33,15-41.86l-5.57-8.81c-23,10.29-29.61,28.75-19.53,54l-9.38,3.12,2.56,7.72,5.47-1.82,2.25,6.76,2.36-.78,13.62,37.76-2.35,1,1.71,4.15,2.16-.89,34.65,96.09a7.47,7.47,0,0,0,9.56,4.49h0A7.47,7.47,0,0,0,1069.76,792.37Z">
                                    </path>
                                    <circle class="secondary-color lighten-5" cx="1027.9" cy="587.94" r="12.99"
                                        transform="translate(-4.77 8.42) rotate(-0.47)"></circle>
                                </g>
                                <path class="secondary-color lighten-5"
                                    d="M1021.29,654l-17.73,6.15,1.72,5.59-31.41,82.36c-19.35,32.53-66.3,36.72-75.56,16.68l-7.09-21.5L879,747.1l3.28,10.09-94.65,33.95c-11.49,2.29-11.85,15.79-2.61,17.84,0,0,39.11,3.66,103,9.5a92.75,92.75,0,0,0,40.89-5.29c44.32-16.56,57.73-50.67,57.73-50.67l26.82-67.26a1.37,1.37,0,0,1,2.53,0l1.42,3.33,17.75-7.62Z">
                                </path>
                                <path class="secondary-color opacity-o4"
                                    d="M1021.29,654l-17.73,6.15,1.72,5.59-31.41,82.36c-19.35,32.53-66.3,36.72-75.56,16.68l-7.09-21.5L879,747.1l3.28,10.09-94.65,33.95c-11.49,2.29-11.85,15.79-2.61,17.84,0,0,39.11,3.66,103,9.5a92.75,92.75,0,0,0,40.89-5.29c44.32-16.56,57.73-50.67,57.73-50.67l26.82-67.26a1.37,1.37,0,0,1,2.53,0l1.42,3.33,17.75-7.62Z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <form class="form theme-form needs-validation" method="POST"
                        action={{route('modifier_mdp_oublie')}}>
                        @csrf
                        @method('PATCH')
                        @foreach ($errors as $err)
                            <div>{{ $err }}</div>
                        @endforeach
                        <div class="col-md-8 offset-md-2">
                            <h3>Tapez un nouveau mot de passe avec le code de réinitialisation que vous avez reçu par
                                courriel </h3>
                            <div class="row">
                                <div class="col-md-6 position-left">
                                    <label class="form-label">Le nouveau mot de passe</label>
                                    <input class="form-control" type="password" name="new_password" id="motdepasse" />
                                    <!--<i class="far fa-eye" onclick="afficher()"></i>-->
                                </div>

                                <div class="col-md-6 position-right">
                                    <label class="form-label">Retapez le nouveau mot de passe</label>
                                    <input class="form-control" type="password" name="new_password2" id="motdepasse2" />
                                    <!--<i class="far fa-eye" onclick="afficher()"></i>-->
                                </div>
                                <div class="col-md-6 position-left">
                                    <input type="checkbox" onclick="afficher()"><label>&nbsp;&nbsp;Afficher le
                                        mot de passe</label></i>
                                </div>
                            </div>
                            <div>
                                <div class="col text-center">
                                    <label class="form-label">code de validation</label>
                                    <input class="form-control" type="text" name="aVerifier" id="aVerifier" />

                                    <!--<i class="far fa-eye" onclick="afficher()"></i>-->
                                </div>
                            </div>
                            <input type="hidden" value="{{ Session::get('code') }}" name="code" id="code">
                            <input type="hidden" value="{{ $user->id}}" name="user_id" id="user_id">

                            <button class="btn btn-primary btn-lg" type="submit">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function afficher() {
        var x = document.getElementById("motdepasse");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if(Session::has('message'))
@if (Session::get('message')=='no-change')
<script>
    swal('Oups','Pas de correspondance entre les deux mots de passe saisis!',{
            icon: 'error',
            button: 'Reéssayer'
        })
</script>
@elseif (Session::get('message')=='code_invalide')
<script>
    swal('Oups','Le code est invalide, vérifier bien votre courriel !',{
            icon: 'error',
            button: 'Reéssayer'
        })
</script>
@endif

@endif





</html>

