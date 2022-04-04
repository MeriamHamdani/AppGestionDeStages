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

<div class="container-fluid">
    <div class="email-wrap bookmark-wrap">
        <div class="row">
            <div class="col-xl-3 box-col-4">
                <div class="email-sidebar">
                    <a class="btn btn-primary email-aside-toggle" href="javascript:void(0)">bookmark filter</a>
                    <div class="email-left-aside">
                        <div class="card">
                            <div class="card-body">
                                <div class="email-app-sidebar left-bookmark">
                                    <ul class="nav main-menu" role="tablist">
                                        <li class="nav-item">
                                            <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ajouter une
                                                                tâhe</h5>
                                                            <button class="btn-close" type="button"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-bookmark needs-validation"
                                                                id="bookmark-form" novalidate="">
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="task-title">Titre de la
                                                                            tâche</label>
                                                                        <input class="form-control" id="task-title"
                                                                            type="text" required=""
                                                                            autocomplete="off" />
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <div class="d-flex date-details">
                                                                            <div class="d-inline-block">
                                                                                <input
                                                                                    class="datepicker-here form-control digits"
                                                                                    type="text" data-language="en"
                                                                                    placeholder="Date" />
                                                                            </div>
                                                                            <div class="input-group clockpicker" data-placement="top" data-align="left" data-donetext="Done">
                                                                                <input class="form-control" type="text" value="18:00"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-12 my-0">
                                                                        <label>Contenu de la tâche</label>
                                                                        <textarea class="form-control" required=""
                                                                            autocomplete="off"> </textarea>
                                                                    </div>
                                                                </div>
                                                                <input id="index_var" type="hidden" value="6" />
                                                                <button class="btn btn-secondary" id="Bookmark"
                                                                    onclick="submitBookMark()"
                                                                    type="submit">Save</button>
                                                                <button class="btn btn-primary" type="button"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nav-item "><span class="main-title"> Les semaines </span></li>
                                        @for($i=1; $i < 25; $i++) <li>
                                            <a id="pills-created123-tab" data-bs-toggle="pill" href="#pills-created123"
                                                role="tab" aria-controls="pills-created123" aria-selected="true">
                                                <span class="title">
                                                    Semaine n°
                                                    <?= $i ?>
                                                </span>
                                            </a>
                                            </li>
                                            @endfor
                                            <li>
                                                <hr />
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-md-12 box-col-8">
                <div class="email-right-aside bookmark-tabcontent">
                    <div class="card email-body radius-left">
                        <div class="ps-0">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="pills-created123" role="tabpanel"
                                    aria-labelledby="pills-created123-tab">
                                    <div class="card mb-0">
                                        <div class="card-header">
                                            <h5 class="mb-0">Semaine N°1</h5>
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
                                                                <h6 class="task_title_0">Titre de la tâche</h6>
                                                                <p class="f-w-300"><strong>06-04-2022</strong></p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Ceci est le description de la
                                                                    tache bien détaillée. Chaque semaine , chaque jour
                                                                    je dois remplir mes taches </p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
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
                                                                <p class="project_name_0"><strong>01-04-2022</strong></p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
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
                                                                <p class="project_name_0"><strong>22-03-2022</strong></p>
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
                                                                <p class="project_name_0"><strong>28-03-2022</strong></p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
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
                                                                <p class="project_name_0"><strong>31-03-2022</strong></p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
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
                                <div class="fade tab-pane" id="semaine" role="tabpanel"
                                    aria-labelledby="pills-todaytask-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Today's Tasks</h6>
                                            <a href="javascript:void(0)"><i class="me-2"
                                                    data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center">
                                                <div class="row" id="favouriteData"></div>
                                                <div class="no-favourite"><span>No task due today.</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-delayed" role="tabpanel"
                                    aria-labelledby="pills-delayed-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Delayed Tasks</h6>
                                            <a href="javascript:void(0)"><i class="me-2"
                                                    data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-upcoming" role="tabpanel"
                                    aria-labelledby="pills-upcoming-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Upcoming Tasks</h6>
                                            <a href="javascript:void(0)"><i class="me-2"
                                                    data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-weekly" role="tabpanel"
                                    aria-labelledby="pills-weekly-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">This Week Tasks</h6>
                                            <a href="javascript:void(0)"><i class="me-2"
                                                    data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-monthly" role="tabpanel"
                                    aria-labelledby="pills-monthly-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">This Month Tasks</h6>
                                            <a href="javascript:void(0)"><i class="me-2"
                                                    data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-assigned" role="tabpanel"
                                    aria-labelledby="pills-assigned-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Assigned to me</h6>
                                            <a href="javascript:void(0)"><i class="me-2"
                                                    data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="taskadd">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
                                                                        data-feather="more-horizontal"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
                                                                        data-feather="more-horizontal"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
                                                                        data-feather="more-horizontal"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
                                                                        data-feather="more-horizontal"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
                                                                        data-feather="more-horizontal"></i></a>
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
                                <div class="fade tab-pane" id="pills-tasks" role="tabpanel"
                                    aria-labelledby="pills-tasks-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">My tasks</h6>
                                            <a href="javascript:void(0)"><i class="me-2"
                                                    data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="taskadd">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
                                                                        data-feather="more-horizontal"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
                                                                        data-feather="more-horizontal"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
                                                                        data-feather="more-horizontal"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
                                                                        data-feather="more-horizontal"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)"><i
                                                                        data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                    of the printing and typesetting industry. Lorem
                                                                    Ipsum has been</p>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="javascript:void(0)"><i
                                                                        data-feather="more-horizontal"></i></a>
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
                                <div class="fade tab-pane" id="pills-notification" role="tabpanel"
                                    aria-labelledby="pills-notification-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Notification</h6>
                                            <a href="javascript:void(0)"><i class="me-2"
                                                    data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-newsletter" role="tabpanel"
                                    aria-labelledby="pills-newsletter-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Newsletter</h6>
                                            <a href="javascript:void(0)"><i class="me-2"
                                                    data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
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

