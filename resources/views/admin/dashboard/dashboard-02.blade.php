@extends('layouts.admin.master')

@section('title')Ecommerce {{ $title }}
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
                           <h6 style="color: #8a6d3b"> <i class="icofont icofont-dashboard icon-4x">   Statistiques </i></h6>
                            <br>
                            <ul class="target-list">
                                <li class="bg-warning" style="width: 600px">
                                    <i class="icofont icofont-users-social icon-4x"></i>
                                    <h3>600</h3>
                                    <h4>Etudiants</h4>
                                </li>
                                <li class="bg-primary" style="width: 600px">
                                    <i class="icofont icofont-teacher icon-4x"></i>
                                    <h3>100</h3>
                                    <h4>Enseignants</h4>
                                </li>
                                <li class="bg-secondary" style="width: 600px; text-align:center">
                                    <i class="icofont icofont-building icon-4x"></i>
                                    <h3>6</h3>
                                    <h4>Déparetements</h4>
                                </li>
                                <li class="bg-danger">
                                    <i class="icofont icofont-abacus-alt icon-4x"></i>
                                    <h3>12</h3>
                                    <h4>Spécialités</h4>
                                </li>
                                <li class="bg-primary">
                                    <i class="icofont icofont-group-students icon-4x"></i>
                                    <h3>20</h3>
                                    <h4>Classes</h4>
                                </li>
                            </ul>
                            <br/>
                            <ul class="target-list">
                                <li class="bg-primary">
                                    <i class="icofont icofont-company icon-4x"></i>
                                    <h3>20</h3>
                                    <h4>Stages</h4>
                                </li>
                                <li class="bg-warning">
                                    <i class="icofont icofont-hat-alt icon-4x"></i>
                                    <h3>12</h3>
                                    <h4>Soutenances</h4>
                                </li>
                                <li class="bg-secondary" style="width: 600px; text-align:center">
                                    <i class="icofont icofont-architecture-alt icon-4x"></i>
                                    <h3>6</h3>
                                    <h4>Entreprises</h4>
                                </li>

                            </ul>
                        </div>
                            <br/><br/>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md- des-xl-100 box-col-12">
                <div class="row">
                    <div class="col-xl-4 col-sm-6 box-col-3 chart_data_right">
                    </div>
                    <div class="col-xl-4 col-sm-6 box-col-3 chart_data_right">
                        <div class="card income-card card-secondary">
                            <div class="card-body align-items-center">
                                <div class="round-progress knob-block text-center">
                                    <div class="progress-circle">
                                        <input class="knob1" data-width="10" data-height="70" data-thickness=".3"
                                               data-angleoffset="0" data-linecap="round" data-fgcolor="#ba895d"
                                               data-bgcolor="#e0e9ea" value="60">
                                        <br/>
                                    </div>
                                    <h5>$9,84,235</h5>
                                    <p>Our Annual Income</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 box-col-3 chart_data_right second">
                        <div class="card income-card card-primary">
                            <div class="card-body">
                                <div class="round-progress knob-block text-center">
                                    <div class="progress-circle">
                                        <input class="knob1" data-width="50" data-height="70" data-thickness=".3"
                                               data-fgcolor="#24695c" data-linecap="round" data-angleoffset="0"
                                               value="60">
                                        <br/>
                                    </div>
                                    <h5>$4,55,462</h5>
                                    <p>Our Annual Income</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--<div class="col-xl-4 col-col-10 top-sell-sec">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="header-top d-sm-flex justify-content-between align-items-center">
                                    <h5>Top Selling Product</h5>
                                    <div class="center-content">
                                        <ul class="week-date">
                                            <li class="font-primary">Today</li>
                                            <li>Month</li>
                                        </ul>
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
                            <div class="card-body">
                                <div class="media">
                                    <img class="img-fluid" src="{{asset('assets/images/dashboard-2/9.png')}}" alt="">
                                    <div class="media-body">
                                        <a href="#">
                                            <h6>Trending Nike shoes</h6>
                                        </a>
                                        <p>New Offer Only $126.00</p>
                                        <ul class="rating-star">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                    <a class="btn btn-iconsolid" href="#"><i class="icon-bag"></i></a>
                                </div>
                                <div class="code-box-copy">
                                    <button class="code-box-copy__btn btn-clipboard"
                                            data-clipboard-target="#top-selling-product" title="Copy"><i
                                            class="icofont icofont-copy-alt"></i></button>
                                    <pre><code class="language-html" id="top-selling-product">&lt;div class="card"&gt;
       &lt;div class="card-header pb-0"&gt;
         &lt;div class="header-top d-sm-flex justify-content-between align-items-center"&gt;
           &lt;h5&gt;Top Selling Product&lt;/h5&gt;
           &lt;div class="center-content"&gt;
             &lt;ul class="week-date"&gt;
               &lt;li class="font-primary"&gt;Today&lt;/li&gt;
               &lt;li&gt;Month&lt;/li&gt;
             &lt;/ul&gt;
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
       &lt;div class="card-body"&gt;
         &lt;div class="media"&gt;&lt;img class="img-fluid" alt="" src="{{asset('assets/images/dashboard-2/9.png')}}"&gt;
           &lt;div class="media-body"&gt;
             &lt;h6&gt;Trending Nike shoes&lt;/h6&gt;
             &lt;p&gt;New Offer Only $126.00&lt;/p&gt;
             &lt;ul class="rating-star"&gt;
               &lt;li&gt; &lt;i class="fa fa-star"&gt;&lt;/i&gt;&lt;/li&gt;
               &lt;li&gt; &lt;i class="fa fa-star"&gt;&lt;/i&gt;&lt;/li&gt;
               &lt;li&gt; &lt;i class="fa fa-star"&gt;&lt;/i&gt;&lt;/li&gt;
               &lt;li&gt; &lt;i class="fa fa-star"&gt;&lt;/i&gt;&lt;/li&gt;
               &lt;li&gt; &lt;i class="fa fa-star"&gt;&lt;/i&gt;&lt;/li&gt;
             &lt;/ul&gt;
           &lt;/div&gt;
           &lt;a class="btn btn-iconsolid" href="javascript:void(0)"&gt;&lt;i class="icon-bag"&gt;&lt;/i&gt;&lt;/a&gt;
         &lt;/div&gt;
    &lt;/div&gt;                                                </code></pre>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        <!--<div class="col-xl-4 des-xl-50 box-col-12 activity-sec chart_data_left">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5 class="m-0">Activity Timeline</h5>
                            <div class="center-content">
                                <p>Yearly User 24.65k</p>
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
                    <div class="card-body">
                        <div class="chart-main activity-timeline update-line">
                            <div class="media">
                                <div class="activity-line"></div>
                                <div class="activity-dot-primary"></div>
                                <div class="media-body d-block">
                                    <h6><span class="font-primary">20-04-2021</span>Today </h6>
                                    <h5>Updated Product<i class="fa fa-circle circle-dot-primary pull-right"></i></h5>
                                    <p>Quisque a consequat ante Sit amet magna at volutapt.</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="activity-dot-primary"></div>
                                <div class="media-body d-block">
                                    <h6><span class="font-primary">20-04-20121</span>Today<span
                                            class="badge pill-badge-primary m-l-10">new                                           </span>
                                    </h6>
                                    <h5>James just like your product <i
                                            class="fa fa-circle circle-dot-primary pull-right"></i></h5>
                                    <p>Quisque a consequat ante Sit amet magna at volutapt.</p>
                                    <ul class="timeline-pro">
                                        <li><img class="img-fluid" src="{{asset('assets/images/dashboard-2/11.png')}}"
                                                 alt="Product-1"></li>
                                        <li><img class="img-fluid" src="{{asset('assets/images/dashboard-2/10.png')}}"
                                                 alt="Product-2"></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="media">
                                <div class="activity-dot-primary"></div>
                                <div class="media-body d-block">
                                    <h6><span class="font-primary">20-04-20121</span>Today</h6>
                                    <h5>Jihan Doe just like your product<i
                                            class="fa fa-circle circle-dot-primary pull-right"></i></h5>
                                    <p>Vestibulum nec mi suscipit, dapibus purus ane.</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-body d-block">
                                    <div class="tomorrow-sec">
                                        <p>Tomorrow</p>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="activity-dot-primary"></div>
                                <div class="media-body d-block">
                                    <h6><span class="font-primary">20-04-20121</span>Tomorrow</h6>
                                    <h5>Today Total Revenue<i class="fa fa-circle circle-dot-primary pull-right"></i>
                                    </h5>
                                    <p>Quisque a consequat ante Sit amet magna at volutapt.</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="activity-dot-primary"></div>
                                <div class="media-body d-block">
                                    <div class="hospital-small-chart">
                                        <div id="column-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#activity-timeline"
                                    title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                            <pre><code class="language-html" id="activity-timeline">   &lt;div class="card"&gt;
     &lt;div class="card-header"&gt;
       &lt;div class="header-top d-sm-flex justify-content-between align-items-center"&gt;
         &lt;h5 class="m-0"&gt;Activity Timeline&lt;/h5&gt;
         &lt;div class="center-content"&gt;
           &lt;p&gt;Yearly User 24.65k&lt;/p&gt;
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
     &lt;div class="card-body"&gt;
       &lt;div class="chart-main activity-timeline update-line"&gt;
         &lt;div class="media"&gt;
           &lt;div class="activity-line"&gt;&lt;/div&gt;
           &lt;div class="activity-dot-primary"&gt;&lt;/div&gt;
           &lt;div class="media-body d-block"&gt;
             &lt;h6&gt; &lt;span class="font-primary"&gt;20-04-2021&lt;/span&gt;Today &lt;/h6&gt;
             &lt;h5&gt;Updated Product&lt;i class="fa fa-circle circle-dot-primary pull-right"&gt;&lt;/i&gt;&lt;/h5&gt;
             &lt;p&gt;Quisque a consequat ante Sit amet magna at volutapt.&lt;/p&gt;
           &lt;/div&gt;
         &lt;/div&gt;
         &lt;div class="media"&gt;
           &lt;div class="activity-dot-primary"&gt;&lt;/div&gt;
             &lt;div class="media-body d-block"&gt;
               &lt;h6&gt; &lt;span class="font-primary"&gt;20-04-20121&lt;/span&gt;Today&lt;span class="badge pill-badge-primary m-l-10"&gt;new &lt;/span&gt;&lt;/h6&gt;
               &lt;h5&gt;James just like your product &lt;i class="fa fa-circle circle-dot-primary pull-right"&gt;&lt;/i&gt;&lt;/h5&gt;
               &lt;p&gt;Quisque a consequat ante Sit amet magna at volutapt.&lt;/p&gt;
               &lt;ul class="timeline-pro"&gt;
                 &lt;li&gt; &lt;img class="img-fluid" src="{{asset('assets/images/dashboard-2/11.png')}}" alt="Product-1"&gt;&lt;/li&gt;
                 &lt;li&gt; &lt;img class="img-fluid" src="{{asset('assets/images/dashboard-2/10.png')}}" alt="Product-2"&gt;&lt;/li&gt;
               &lt;/ul&gt;
             &lt;/div&gt;
         &lt;/div&gt;
         &lt;div class="media"&gt;
             &lt;div class="activity-dot-primary"&gt;&lt;/div&gt;
               &lt;div class="media-body d-block"&gt;
                 &lt;h6&gt; &lt;span class="font-primary"&gt;20-04-20121&lt;/span&gt;Today&lt;/h6&gt;
                 &lt;h5&gt;Jihan Doe just like your product&lt;i class="fa fa-circle circle-dot-primary pull-right"&gt;&lt;/i&gt;&lt;/h5&gt;
                 &lt;p&gt;Vestibulum nec mi suscipit, dapibus purus ane.&lt;/p&gt;
               &lt;/div&gt;
             &lt;/div&gt;
             &lt;div class="media"&gt;
                 &lt;div class="media-body d-block"&gt;
                   &lt;div class="tomorrow-sec"&gt;
                     &lt;p&gt;Tomorrow&lt;/p&gt;
                   &lt;/div&gt;
                 &lt;/div&gt;
             &lt;/div&gt;
             &lt;div class="media"&gt;
               &lt;div class="activity-dot-primary"&gt;&lt;/div&gt;
               &lt;div class="media-body d-block"&gt;
                 &lt;h6&gt; &lt;span class="font-primary"&gt;20-04-20121&lt;/span&gt;Tomorrow&lt;/h6&gt;
                 &lt;h5&gt;Today Total Revenue&lt;i class="fa fa-circle circle-dot-primary pull-right"&gt;&lt;/i&gt;&lt;/h5&gt;
                 &lt;p&gt;Quisque a consequat ante Sit amet magna at volutapt.&lt;/p&gt;
               &lt;/div&gt;
             &lt;/div&gt;
             &lt;div class="media"&gt;
                 &lt;div class="activity-dot-primary"&gt;&lt;/div&gt;
                   &lt;div class="media-body d-block"&gt;
                     &lt;div class="hospital-small-chart"&gt;
                       &lt;div id="column-chart"&gt; &lt;/div&gt;
                     &lt;/div&gt;
                   &lt;/div&gt;
                 &lt;/div&gt;
             &lt;/div&gt;
           &lt;/div&gt;
         &lt;/div&gt;</code></pre>
                        </div>
                    </div>
                </div>
            </div>-->
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
                            <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#yearly-growth"
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

    @endpush
@endsection
