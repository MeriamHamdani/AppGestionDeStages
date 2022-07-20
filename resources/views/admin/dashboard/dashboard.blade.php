@extends('layouts.admin.master')

@section('title')Dashboard {{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vector-map.css')}}">
@endpush
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 col-md- des-xl-250 box-col-12">
                <div class="col-xl-12 box-col-12">
                    <div class="card target-sec" style="width: 1000px">
                        <div class="card-header pb-0">
                            <h6 style="color: #8a6d3b"><i class="icofont icofont-dashboard icon-4x"> Statistiques </i>
                            </h6>
                            <br>
                            <ul class="target-list">
                                <li class="bg-warning" style="width: 600px">
                                    <i class="icofont icofont-users-social icon-4x"></i>
                                    <h3>{{$nbre_etudiants}}</h3>
                                    <h4>Etudiants </h4>
                                </li>
                                <li class="bg-primary" style="width: 600px">
                                    <i class="icofont icofont-teacher icon-4x"></i>
                                    <h3>{{$nbre_enseignants}}</h3>
                                    <h4>Enseignants</h4>
                                </li>
                                <li class="bg-secondary" style="width: 600px; text-align:center">
                                    <i class="icofont icofont-building icon-4x"></i>
                                    <h3>{{$nbre_departements}}</h3>
                                    <h4>Déparetements</h4>
                                </li>
                                <li class="bg-danger">
                                    <i class="icofont icofont-abacus-alt icon-4x"></i>
                                    <h3>{{$nbre_specialites}}</h3>
                                    <h4>Spécialités</h4>
                                </li>
                                <li class="bg-primary">
                                    <i class="icofont icofont-group-students icon-4x"></i>
                                    <h3>{{$nbre_classes}}</h3>
                                    <h4>Classes</h4>
                                </li>
                            </ul>
                            <br/>
                            <ul class="target-list">
                                <li class="bg-primary">
                                    <i class="icofont icofont-company icon-4x"></i>
                                    <h3>{{$nbre_stages}}</h3>
                                    <h4>Stages</h4>
                                </li>
                                <li class="bg-warning">
                                    <i class="icofont icofont-hat-alt icon-4x"></i>
                                    <h3>22</h3>
                                    <h4>Soutenances</h4>
                                </li>
                                <li class="bg-secondary" style="width: 600px; text-align:center">
                                    <i class="icofont icofont-architecture-alt icon-4x"></i>
                                    <h3>{{$nbre_entreprises}}</h3>
                                    <h4>Entreprises</h4>
                                </li>

                            </ul>
                        </div>
                        <br/><br/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="item active">
                    <div class="card" style="width: 1100px">
                        <div class="card-header">
                            <div class="header-top d-sm-flex justify-content-between align-items-center">
                                <h5 class="m-0">Autres Statistiques</h5>
                            </div>
                            <div class="card-body" style="width:1000px;height:350px">
                                <table class="columns">
                                    <tr>
                                        <td>
                                            <canvas id="myChartDoughnut" width="300" height="200"
                                                    style="border: 2px solid #ccc;padding-right: 2px; padding-bottom:6px"></canvas>
                                        </td>
                                        <td>
                                            <canvas id="myChart" width="300" height="200"
                                                    style="border: 2px solid #ccc;padding-right: 2px; padding-bottom:6px"></canvas>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="width: 1000px">
                        <div class="card-header">
                            <div class="header-top d-sm-flex justify-content-between align-items-center">
                                <h5 class="m-0">Statistiques des types des sujets</h5>
                            </div>
                            <div>
                                <div id="piechart" style="width: 900px; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 des-xl-50 yearly-growth-sec">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Yearly growth</h5>
                            <div class="center-content">
                                <p class="d-sm-flex align-items-center"><span class="m-r-10"><i
                                            class="toprightarrow-primary fa fa-arrow-up m-r-10"></i>$9657.55k </span>86%
                                    more then last year</p>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-primary"><i class="icon-settings"></i></div>
                                    </li>
                                    <li><i class="view-html fa fa-code font-primary"></i></li>
                                    <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                                    <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                                    <li><i class="icofont icofont-error close-card font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 chart-block">
                        <div id="chart-yearly-growth-dash-2"></div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard"
                                    data-clipboard-target="#yearly-growth"
                                    title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                            <pre><code class="language-html" id="yearly-growth">  &lt;div class="card"&gt;
       &lt;div class="card-header pb-0"&gt;
         &lt;div class="header-top d-sm-flex justify-content-between align-items-center"&gt;
           &lt;h5&gt;Yearly growth&lt;/h5&gt;
           &lt;div class="center-content"&gt;
                 &lt;p class="d-sm-flex align-items-center"&gt;
                    &lt;span class="m-r-10"&gt;
                      &lt;i class=" toprightarrow-primary fa fa-arrow-up m-r-10"&gt;&lt;/i&gt;  $9657.55k
                    &lt;/span&gt; 86% more then last year
                &lt;/p&gt;
             &lt;/div&gt;
         &lt;div class="setting-list"&gt;
           &lt;ul class="list-unstyled setting-option"&gt;
             &lt;li&gt;
               &lt;div class="setting-primary"&gt;&lt;i class="icon-settings"&gt;&lt;/i&gt;&lt;/div&gt;
             &lt;/li&gt;
             &lt;li&gt;&lt;i class="view-html fa fa-code font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
             &lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
             &lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
             &lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
             &lt;li&gt;&lt;i class="icofont icofont-error close-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
           &lt;/ul&gt;
         &lt;/div&gt;
       &lt;/div&gt;
       &lt;/div&gt;
       &lt;div class="card-body p-0 chart-block"&gt;
          &lt;div id="chart-yearly-growth-dash-2"&gt;
          &lt;/div&gt;
       &lt;/div&gt;
    &lt;/div&gt;        </code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{asset('assets/js/chart/chartjs/chart.min.js')}}"></script>
        <script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
        <script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
        <script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
        <script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
        <script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
        <script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
        <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
        <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
        <script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
        <script src="{{asset('assets/js/owlcarousel/owl-custom.js')}}"></script>
        <script src="{{asset('assets/js/dashboard/dashboard_2.js')}}"></script>
        <script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
        <script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
        <script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
        <script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
        <script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
        <script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
        <script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
        <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
        <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
        <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
        <script src="{{asset('assets/js/vector-map/jquery-jvectormap-2.0.2.min.js')}}"></script>
        <script src="{{asset('assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script src="{{asset('assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js')}}"></script>
        <script src="{{asset('assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js')}}"></script>
        <script src="{{asset('assets/js/vector-map/map/jquery-jvectormap-au-mill.js')}}"></script>
        <script src="{{asset('assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js')}}"></script>
        <script src="{{asset('assets/js/vector-map/map/jquery-jvectormap-in-mill.js')}}"></script>
        <script src="{{asset('assets/js/vector-map/map/jquery-jvectormap-asia-mill.js')}}"></script>
        <script src="{{asset('assets/js/dashboard/default.js')}}"></script>
        <script src="{{asset('assets/js/notify/index.js')}}"></script>
        <script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
        <script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
        <script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript">
            var data = {!! json_encode($data)  !!};
            const ctx = document.getElementById('myChartDoughnut');
            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Enseignants Encadrants', 'Enseignants Non Encadrants'],
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            'rgb(36, 105, 92)',
                            'rgb(186, 137, 93)',
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Statistiques des encadrements',
                            padding: {
                                top: 10,
                                bottom: 20
                            }
                        }
                    }
                }
            });
        </script>
        <script type="text/javascript">
            var data2 = {!! json_encode($statVol)  !!};
            const ctx2 = document.getElementById('myChart');
            const myChart2 = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['Etudiants ayant un stage volontaire', 'Etudiants n\'ayant pas un stage volontaire'],
                    datasets: [{
                        data: data2,
                        backgroundColor: [
                            'rgb(36, 105, 92)',
                            'rgb(186, 137, 93)',
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Statistiques des stages volontaires',
                            padding: {
                                top: 10,
                                bottom: 20
                            }
                        }
                    }
                }
            });
        </script>
        <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Type sujet', 'Stages'],
                    <?php echo $dataset?>
                ]);
                var options = {
                    is3D: true,
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>


    @endpush
@endsection
