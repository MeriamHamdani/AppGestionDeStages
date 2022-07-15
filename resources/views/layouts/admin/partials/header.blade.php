<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">


            <div class="logo-wrapper"><a href=""><img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}"
                        alt=""></a></div>
            <div class="dark-logo-wrapper"><a href=""><img class="img-fluid"
                        src="{{asset('assets/images/logo/dark-logo.png')}}" alt=""></a></div>

            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">
                </i></div>

        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav">
                <li>
                            <form class="g-6 needs-validation" novalidate="" method="POST"
                                  action="{{ route('filtre_par_an') }}">
                                @csrf
                                @if($errors->any())
                                    @foreach ($errors->all() as $err )
                                        <div class="alert alert-danger" role="alert">
                                            {{ $err }}
                                        </div>
                                    @endforeach
                                @endif
                                <div style="width: 200px" class="col-md-6 position-relative">
                                    <select class="js-example-basic-single col-sm-4" id="annee_universitaire"
                                            name="annee_universitaire"
                                            required>
                                        <option disabled="disabled" selected="selected">Année Universitaire
                                        </option>
                                        @foreach (\App\Models\AnneeUniversitaire::all() as $anneeUniv)
                                            <option value="{{ $anneeUniv->id }}"  {{ old('annee_universitaire') == $anneeUniv->id ? 'selected' : '' }}>
                                                {{ ucwords($anneeUniv->annee) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="col-md-6 position-relative" style=" margin-left: 75px;padding-top: 3px">
                                        <button class="btn-sm btn-secondary " type="submit">OK</button>
                                    </div>
                                </div>

                            </form>
                </li>
                @if(session()->get('annee'))
                <li>
                    <div class="onhover-dropdown p-0"><button class="btn-sm btn-secondary disabled:opacity-0">{{session()->get('annee')->annee}}</button></div>
                </li>
            @endif
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>


                <li class="onhover-dropdown p-0" style="margin-right: 8px">

                    <form method="GET" action="{{ route('deconnexion') }}">
                        @csrf
                        <button class="btn btn-primary-light" type="button" href={{ route('deconnexion') }} onclick="event.preventDefault();
                        this.closest('form').submit();"><i data-feather="log-out"></i>Se Déconnecter</button>
                    </form>

                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
@push('css')
    .col-md-6 btn {
    margin-top: 25px;
    }
@endpush

