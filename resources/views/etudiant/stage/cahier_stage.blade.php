@extends('layouts.etudiant.master')

@section('title')Cahier de stage
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/scrollable.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/timepicker.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Cahier de stage</h3>
@endslot
<li class="breadcrumb-item">Stage</li>
<li class="breadcrumb-item active">Cahier de stage</li>
@endcomponent

<div class="container-fluid  text-center">
    <div class="email-wrap bookmark-wrap">
        <div class="row">

            @for($i=1;$i<=$nbr_semaines;$i++) <div class="col-xl-9 col-md-12 box-col-8">
                <div class="email-right-aside bookmark-tabcontent">
                    <div class="card email-body radius-left">
                        <div class="ps-0">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="{{ $i }}" role="tabpanel"
                                    aria-labelledby="pills-created123-tab">
                                    <div class="card mb-0">
                                        <div class="card-header">
                                            <h5 class="mb-0 text-center">Semaine N° {{ $i }}</h5>
                                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i class="me-2"
                                                    data-feather="check-circle"></i>Nouvelle tâche</button>

                                            <a class="f-w-600" href="javascript:void(0)"><i class="me-2"
                                                    data-feather="printer"></i>Imprimer</a>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="taskadd">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Jour 1 </h6>
                                                                <p class="f-w-300"><strong>06-04-2022</strong></p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">contenu</p>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="edit"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Jour 2</h6>
                                                                <p class="project_name_0"><strong>01-04-2022</strong>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="edit"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Titre de la tâche</h6>
                                                                <p class="project_name_0"><strong>22-03-2022</strong>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="edit"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Titre de la tâche</h6>
                                                                <p class="project_name_0"><strong>28-03-2022</strong>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="edit"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Titre de la tâche</h6>
                                                                <p class="project_name_0"><strong>31-03-2022</strong>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="edit"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                    </table>
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
        @endfor
    </div>
</div>


@push('scripts')
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('assets/js/form-validation-custom.js')}}"></script>
<script src="{{asset('assets/js/task/custom.js')}}"></script>
<script src="{{asset('assets/js/scrollable/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/scrollable/scrollable-custom.js')}}"></script>
<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
<script src="{{ asset('assets/js/time-picker/jquery-clockpicker.min.js') }}"></script>
<script src="{{ asset('assets/js/time-picker/highlight.min.js') }}"></script>
<script src="{{ asset('assets/js/time-picker/clockpicker.js') }}"></script>
@endpush

@endsection