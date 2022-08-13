@extends('layouts.admin.master')

@section('title')Attrayant de chaque enseignant
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Attrayant de chaque enseignant</h3>
        @endslot
        <li class="breadcrumb-item">Payement</li>
        <li class="breadcrumb-item">Attrayant de chaque enseignant</li>

    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Attrayant de chaque enseignant</h5>

                    </div>
                    <div class="card-body">
                        <div style="text-align: center">
                            <a href=#>
                                <i class="text-right" aria-hidden="true">
                                    <label class="form-label" for="message-text"><strong>Télécharger l'attrayant de
                                            chaque enseignant</strong></label>

                                    <button class="btn btn-primary" type="button"
                                            data-bs-toggle="modal" data-bs-target="#import"
                                            data-whatever="@getbootstrap">
                                        Attrayant
                                    </button>
                                    <div class="modal fade" id="import" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Attrayant des stages par enseignant</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('telecharger_attrayant_ens')}}" method="POST">
                                                @csrf
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label"
                                                                               for="message-text">Enseignant </label>
                                                                        <select
                                                                            class="js-example-basic-single col-sm-12"
                                                                            id="enseignant" name="enseignant" required>
                                                                            <option disabled="disabled"
                                                                                    selected="selected">Séléctionnez
                                                                                l'enseignant
                                                                            </option>
                                                                            @foreach (App\Models\Enseignant::all() as $enseignant )
                                                                                <option
                                                                                    value="{{ $enseignant->id }}"
                                                                                    {{ old('enseignant_id') == $enseignant->id ? 'selected' : '' }}
                                                                                >{{ ucwords($enseignant->nom) }} {{ ucwords($enseignant->prenom) }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label"
                                                                               for="message-text">Identifiant </label>
                                                                        <input class="form-control" id="identif"
                                                                               name="identif" type="text"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label"
                                                                               for="message-text">CIN</label>
                                                                        <input class="form-control" id="numeroCIN"
                                                                               name="numeroCIN" type="number"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label"
                                                                               for="message-text">RIB </label>
                                                                        <input class="form-control" id="rib" name="rib"
                                                                               type="number"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label"
                                                                               for="message-text">Numéro de
                                                                            Téléphone</label>
                                                                        <input class="form-control" id="numeroTel"
                                                                               name="numeroTel" type="number"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="mb-4">
                                                                        <label class="col-form-label"
                                                                               for="message-text">Établissement de
                                                                            nomination</label>
                                                                        <input class="form-control" id="etabliss"
                                                                               name="etabliss" type="text"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-primary" type="submit">Télécharger</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
        <script src="{{ asset('assets/js/icons/icons-notify.js') }}"></script>
        <script src="{{ asset('assets/js/icons/feather-icon/feather-icon-clipart.js') }}"></script>
        <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.col-md-5Vis.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.col-md-5Reorder.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/custom.js')}}"></script>
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
        <script type="text/javascript">
            $('#enseignant').change(function () {
                var id = $(this).val();
                var url = '{{ route('getDetails', ':id') }}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                       // console.log(response);
                        if (response != null) {
                            $('#identif').val(response.identifiant);
                            $('#numeroCIN').val(response.numero_CIN);
                            $('#numeroTel').val(response.numero_telephone);
                            $('#etabliss').val(response.etablissement);
                            $('#rib').val(response.rib);
                        }
                    }
                });
            });

        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
                integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @if(Session::has('message'))
            @if (Session::get('message')=='ens_vide')

                <script>
                    swal('Oups', 'Séléctionnez un enseignant!!' , 'warning', {
                        button: 'error'
                    })

                </script>
            @endif
        @endif
    @endpush
@endsection




