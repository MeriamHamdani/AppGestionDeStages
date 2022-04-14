

<?php $__env->startSection('title'); ?>Cahier de stage
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/date-picker.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/scrollable.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/timepicker.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
            <h3>Cahier de stage de : l'etudiant</h3>
        <?php $__env->endSlot(); ?>
        <li class="breadcrumb-item">Stage</li>
        <li class="breadcrumb-item active">Cahier de stage de : l'etudiant</li>
    <?php echo $__env->renderComponent(); ?>

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

                                            <li class="nav-item "><span class="main-title"> Les semaines </span></li>
                                            <?php for($i=1; $i < 25; $i++): ?> <li>
                                                <a id="pills-created123-tab" data-bs-toggle="pill" href="#pills-created123"
                                                   role="tab" aria-controls="pills-created123" aria-selected="true">
                                                <span class="title">
                                                    Semaine n°
                                                    <?= $i ?>
                                                </span>
                                                </a>
                                            </li>
                                            <?php endfor; ?>
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
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h6 class="task_title_0">Titre de la tâche</h6>
                                                                    <p class="project_name_0"><strong>01-04-2022</strong></p>
                                                                </td>
                                                                <td>
                                                                    <p class="task_desc_0">Lorem Ipsum is simply dummy text
                                                                        of the printing and typesetting industry. Lorem
                                                                        Ipsum hs been</p>
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


    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.en.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/form-validation-custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/task/custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/scrollable/perfect-scrollbar.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/scrollable/scrollable-custom.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/tooltip-init.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/time-picker/jquery-clockpicker.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/time-picker/highlight.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/time-picker/clockpicker.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.enseignant.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\stageApp\AppGestionDeStages\resources\views/enseignant/encadrement/cahier_stage_etud.blade.php ENDPATH**/ ?>