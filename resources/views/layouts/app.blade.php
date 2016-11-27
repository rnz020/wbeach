<!DOCTYPE html>
<html lang="es">

<head>
    <title>{{ env('APP_NAME', 'MI APP') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

    <!-- CSS Libs -->       
        <!-- Font CSS (Via CDN) -->
        <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>

        <!-- Theme CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/assets/skin/default_skin/css/theme.css') }}">

        <!-- Admin Forms CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/assets/admin-tools/admin-forms/css/admin-forms.min.css') }}">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}">
        
        <link rel="stylesheet" type="text/css" href="{{ asset('kendo/css/kendo.common.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('kendo/css/kendo.dataviz.bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('kendo/css/kendo.bootstrap.css') }}">
    <!-- CSS App -->
    
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    
    <style>
    a.kendo-buttons{
        padding: 2px;
        text-decoration: none;
    }
    
    .bg-primary {
    background-color:rgb(54, 96, 146) !important;
    color: #e1f0fa;
    border-bottom: 1px solid black !important;;
}
    .sidebar-left-content{
       background:rgb(54, 96, 146)
    }
    section#content, #main{
        background:rgb(54, 96, 146)
    }
     #main:before{
        background:rgb(54, 96, 146)
    }
    #topbar{
        background:rgb(54, 96, 146)
    }
    #sidebar_left{
       border-right: 1px solid rgb(85,142,213) !important;
    }
    .bg-info.light{
       background-color:rgb(79,129,189) !important;
    }
    .bg-info .text-muted{
       background-color:rgb(142,180,227)  !important;
    }
    .btn-test{
        border-radius: 30px;
        width: 100px; background-color:rgb(79,129,189) 
    }

    </style>   
</head>

<body class="dashboard-page sb-l-o sb-r-c onload-check" style="min-height: 703px; overflow-x: initial;">

<!-------------------------------------------------------------+ 
  <body> Helper Classes: 
---------------------------------------------------------------+ 
  '.sb-l-o' - Sets Left Sidebar to "open"
  '.sb-l-m' - Sets Left Sidebar to "minified"
  '.sb-l-c' - Sets Left Sidebar to "closed"

  '.sb-r-o' - Sets Right Sidebar to "open"
  '.sb-r-c' - Sets Right Sidebar to "closed"
---------------------------------------------------------------+
 Example: <body class="example-page sb-l-o sb-r-c">
 Results: Sidebar left Open, Sidebar right Closed
--------------------------------------------------------------->


    <!-- Start: Main -->
    <div id="main">

        <!-----------------------------------------------------------------+ 
           ".navbar" Helper Classes: 
        -------------------------------------------------------------------+ 
           * Positioning Classes: 
            '.navbar-static-top' - Static top positioned navbar
            '.navbar-static-top' - Fixed top positioned navbar

           * Available Skin Classes:
             .bg-dark    .bg-primary   .bg-success   
             .bg-info    .bg-warning   .bg-danger
             .bg-alert   .bg-system 
        -------------------------------------------------------------------+
          Example: <header class="navbar navbar-fixed-top bg-primary">
          Results: Fixed top navbar with blue background 
        ------------------------------------------------------------------->

        <!-- Start: Header -->
        <header class="navbar navbar-fixed-top navbar-shadow bg-primary">
            <div class="navbar-branding dark">
                <a class="navbar-brand" href="#">
<!--    comments                <b>Absolute</b>Admin-->
                          <button class="btn btn-primary btn-test">Home Page</button>
                          <button class="btn btn-primary btn-test">Salir</button>
                </a>
                <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
            </div>
<!--            comments-->
<!--            @include('layouts.navs.nav-left')-->
            @include('layouts.navs.nav-rigth')
        </header>
        <!-- End: Header -->

        <!-----------------------------------------------------------------+ 
           "#sidebar_left" Helper Classes: 
        -------------------------------------------------------------------+ 
           * Positioning Classes: 
            '.affix' - Sets Sidebar Left to the fixed position 

           * Available Skin Classes:
             .sidebar-dark (default no class needed)
             .sidebar-light  
             .sidebar-light.light   
        -------------------------------------------------------------------+
           Example: <aside id="sidebar_left" class="affix sidebar-light">
           Results: Fixed Left Sidebar with light/white background
        ------------------------------------------------------------------->

        <!-- Start: Sidebar-->
        <aside id="sidebar_left" class="nano nano-light affix sidebar-light has-scrollbar">
            
            <!-- Start: Sidebar Left Content -->
            <div class="sidebar-left-content nano-content" tabindex="0" style="margin-right: -17px;">
                <div class="nav-collapse">
                     <?php // echo $this->navigation('navigation')->menu(); ?>
                </div>
            </div>  
            <!-- End: Sidebar Left Content -->
            
            <div class="nano-pane">
                <div class="nano-slider" style="height: 336px; transform: translate(0px, 0px);"> 
                </div>
            </div>
            
        </aside>
        <!-- End: Sidebar Left -->

        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">

            <!-- Start: Topbar-Dropdown -->
            <div id="topbar-dropmenu" class="alt">
                <div class="topbar-menu row">
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-primary light">
                            <span class="glyphicon glyphicon-inbox text-muted"></span>
                            <span class="metro-title">Messages</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-info light">
                            <span class="glyphicon glyphicon-user text-muted"></span>
                            <span class="metro-title">Users</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-success light">
                            <span class="glyphicon glyphicon-headphones text-muted"></span>
                            <span class="metro-title">Support</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-system light">
                            <span class="glyphicon glyphicon-facetime-video text-muted"></span>
                            <span class="metro-title">Videos</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-warning light">
                            <span class="fa fa-gears text-muted"></span>
                            <span class="metro-title">Settings</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-alert light">
                           <span class="glyphicon glyphicon-picture text-muted"></span>
                           <span class="metro-title">Pictures</span>
                        </a>
                    </div>
                </div> 
            </div>
            <!-- End: Topbar-Dropdown -->
                 
            <!-- Start: Topbar comments-->
<!--            <header id="topbar" class="alt affix" >
                <div class="topbar-left">
                    @yield('breadcrumb')
                </div>
                <div class="topbar-right">
                    @yield('topbar')
                </div>
            </header>-->
            <!-- End: Topbar -->

            <!-- Begin: Content -->
            <section id="content" class="">
                @yield('content')
            </section>
            <!-- End: Content -->

            <!-- Begin: Page Footer -->
<!--            <footer id="content-footer" class="affix">
                @include('layouts.footer')
            </footer>-->
            <!-- End: Page Footer -->

        </section>
        <!-- End: Content-Wrapper -->

        <!-- Start: Right Sidebar -->
        <aside id="sidebar_right" class="nano affix has-scrollbar">
            <!-- Start: Sidebar Right Content -->
            @include('layouts.sidebars.sidebar-right')
        </aside>
        <!-- End: Right Sidebar -->
        
        <!-- Start: Theme Preview Pane -->
<!--            @include('layouts.theme-panel')-->
        <!-- End: Theme Preview Pane -->
        
    </div>
    <!-- End: Main -->

    
  <!-- BEGIN: PAGE SCRIPTS -->
  
  <!-- JQuery -->
<script type="text/javascript" src="{{ asset('bower_components/vendor/jquery/jquery-1.11.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/vendor/jquery/jquery_ui/jquery-ui.min.js') }}"></script>

  <!-- HighCharts Plugin -->
<script type="text/javascript" src="{{ asset('bower_components/vendor/plugins/highcharts/highcharts.js') }}"></script>
 
  <!-- JvectorMap Plugin + US Map (more maps in plugin/assets folder) --> 
<script type="text/javascript" src="{{ asset('bower_components/vendor/plugins/jvectormap/jquery.jvectormap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/vendor/plugins/jvectormap/assets/jquery-jvectormap-us-lcc-en.js') }}"></script>

  <!-- FullCalendar Plugin + moment Dependency -->
<script type="text/javascript" src="{{ asset('bower_components/vendor/plugins/fullcalender/lib/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/vendor/plugins/fullcalender/fullcalendar.min.js') }}"></script>

  <!-- Theme Javascript -->
<script type="text/javascript" src="{{ asset('bower_components/assets/js/utility/utility.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/assets/js/demo/demo.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/assets/js/main.js') }}"></script>

  <!-- Widget Javascript  -->
<script type="text/javascript" src="{{ asset('bower_components/assets/js/demo/widgets.js') }}"></script>
  
<script type="text/javascript" src="{{ asset('kendo/js/kendo.all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('kendo/js/kendo.culture.es-ES.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
            
  <script type="text/javascript">
  jQuery(document).ready(function() {

    "use strict";

    // Init Demo JS  
    Demo.init();
 

    // Init Theme Core    
    Core.init({
      collapse: "sb-l-m", // sidebar left collapse style
    });


    // Init Widget Demo JS
    // demoHighCharts.init();

    // Because we are using Admin Panels we use the OnFinish 
    // callback to activate the demoWidgets. It's smoother if
    // we let the panels be moved and organized before 
    // filling them with content from various plugins

    // Init plugins used on this page
    // HighCharts, JvectorMap, Admin Panels

    // Init Admin Panels on widgets inside the ".admin-panels" container
    $('.admin-panels').adminpanel({
      grid: '.admin-grid',
      draggable: true,
      // preserveGrid: true,
      // mobile: true,
      onStart: function() {
        // Do something before AdminPanels runs
      },
      onFinish: function() {
        $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');

        // Init the rest of the plugins now that the panels
        // have had a chance to be moved and organized.
        // It's less taxing to organize empty panels
        demoHighCharts.init();
        runVectorMaps(); // function below
      },
      onRemove: function(panel) {
        var pID = $(panel).attr('id');
        console.log(pID);
      }
    });


    // Init plugins for ".calendar-widget"
    // plugins: FullCalendar
    //
    $('#calendar-widget').fullCalendar({
      // contentHeight: 397,
      editable: true,
      events: [{
          title: 'Sony Meeting',
          start: '2015-08-1',
          end: '2015-08-3',
          className: 'fc-event-success',
        }, {
          title: 'Conference',
          start: '2015-08-11',
          end: '2015-08-13',
          className: 'fc-event-warning'
        }, {
          title: 'Lunch Testing',
          start: '2015-08-21',
          end: '2015-08-23',
          className: 'fc-event-primary'
        },
      ],
      eventRender: function(event, element) {
        // create event tooltip using bootstrap tooltips
        $(element).attr("data-original-title", event.title);
        $(element).tooltip({
          container: 'body',
          delay: {
            "show": 100,
            "hide": 200
          }
        });
        // create a tooltip auto close timer  
        $(element).on('show.bs.tooltip', function() {
          var autoClose = setTimeout(function() {
            $('.tooltip').fadeOut();
          }, 3500);
        });
      }
    });


    // Init plugins for ".task-widget"
    // plugins: Custom Functions + jQuery Sortable
    //
    var taskWidget = $('div.task-widget');
    var taskItems = taskWidget.find('li.task-item');
    var currentItems = taskWidget.find('ul.task-current');
    var completedItems = taskWidget.find('ul.task-completed');

    // Init jQuery Sortable on Task Widget
    taskWidget.sortable({
      items: taskItems, // only init sortable on list items (not labels)
      handle: '.task-menu',
      axis: 'y',
      connectWith: ".task-list",
      update: function( event, ui ) {
        var Item = ui.item;
        var ParentList = Item.parent();

        // If item is already checked move it to "current items list"
        if (ParentList.hasClass('task-current')) {
            Item.removeClass('item-checked').find('input[type="checkbox"]').prop('checked', false);
        }
        if (ParentList.hasClass('task-completed')) {
            Item.addClass('item-checked').find('input[type="checkbox"]').prop('checked', true);
        }

      }
    });

    // Custom Functions to handle/assign list filter behavior
    taskItems.on('click', function(e) {
      e.preventDefault();
      var This = $(this);
      var Target = $(e.target);

      if (Target.is('.task-menu') && Target.parents('.task-completed').length) {
        This.remove();
        return;
      }

      if (Target.parents('.task-handle').length) {
		      // If item is already checked move it to "current items list"
		      if (This.hasClass('item-checked')) {
		        This.removeClass('item-checked').find('input[type="checkbox"]').prop('checked', false);
		      }
		      // Otherwise move it to the "completed items list"
		      else {
		        This.addClass('item-checked').find('input[type="checkbox"]').prop('checked', true);
		      }
      }

    });


    var highColors = [bgSystem, bgSuccess, bgWarning, bgPrimary];

    // Chart data
    var seriesData = [{
      name: 'Phones',
      data: [5.0, 9, 17, 22, 19, 11.5, 5.2, 9.5, 11.3, 15.3, 19.9, 24.6]
    }, {
      name: 'Notebooks',
      data: [2.9, 3.2, 4.7, 5.5, 8.9, 12.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
    }, {
      name: 'Desktops',
      data: [15, 19, 22.7, 29.3, 22.0, 17.0, 23.8, 19.1, 22.1, 14.1, 11.6, 7.5]
    }, {
      name: 'Music Players',
      data: [11, 6, 5, 15, 17.0, 22.0, 30.8, 24.1, 14.1, 11.1, 9.6, 6.5]
    }];

    var ecomChart = $('#ecommerce_chart1');
    if (ecomChart.length) {
      ecomChart.highcharts({
        credits: false,
        colors: highColors,
        chart: {
          backgroundColor: 'transparent',
          className: '',
          type: 'line',
          zoomType: 'x',
          panning: true,
          panKey: 'shift',
          marginTop: 45,
          marginRight: 1,
        },
        title: {
          text: null
        },
        xAxis: {
          gridLineColor: '#EEE',
          lineColor: '#EEE',
          tickColor: '#EEE',
          categories: ['Jan', 'Feb', 'Mar', 'Apr',
            'May', 'Jun', 'Jul', 'Aug',
            'Sep', 'Oct', 'Nov', 'Dec'
          ]
        },
        yAxis: {
          min: 0,
          tickInterval: 5,
          gridLineColor: '#EEE',
          title: {
            text: null,
          }
        },
        plotOptions: {
          spline: {
            lineWidth: 3,
          },
          area: {
            fillOpacity: 0.2
          }
        },
        legend: {
          enabled: true,
          floating: false,
          align: 'right',
          verticalAlign: 'top',
          x: -15
        },
        series: seriesData
      });
    }
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajaxSetup({
        statusCode : {
            403: function() {
                AlertMessage.printError('.side-body', 'No tiene permitido realizar esta acción o ver parte de este contenido.')
            }
        }
    });


    $(document).on('click', '.modal-success', function (event) {
        bootbox.hideAll();
    });
  });
  </script>
  <!-- END: PAGE SCRIPTS -->


  </div>
    @yield('js-libraries')
    @yield('scripts')
</body>
</html>
