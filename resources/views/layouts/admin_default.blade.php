<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Rental Admin : @yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{ asset('vendors/font-awesome-4.2.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/styles/black.css') }}" rel="stylesheet" type="text/css" id="colorscheme" />
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/metisMenu.css') }}" rel="stylesheet" type="text/css"/>    
    <!-- end of global css -->    
    <!--page level css -->
    <link href="{{ asset('vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" media="all" href="{{ asset('vendors/jvectormap/jquery-jvectormap.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/only_dashboard.css') }}" />
    <!--end of page level css-->
    @yield('pageCss')
</head>

<body class="skin-josh">
    <header class="header">
    @include('layouts.admin.header')
    </header>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <section class="sidebar ">
                <div class="page-sidebar  sidebar-nav">
                @include('layouts.admin.sidebar')
                </div>
            </section>
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Main content -->
            <section class="content-header">
                <h1>@yield('pageTitle')</h1>
                <ol class="breadcrumb">
                    @yield('breadcrumbs')
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-md-8  col-offset-2 alert_msg">
                        @if (Session::has('message'))
                        <div class="alert alert-warning alert-dismissable alert-red">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
                          {!!Session::get('message')!!}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    @yield('content')
                </div>
            </section>

        </aside>
    </div>

    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
        <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
    </a>
    <!-- global js -->
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!--livicons-->
    <script src="{{ asset('vendors/livicons/minified/raphael-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/livicons/minified/livicons-1.4.min.js') }}" type="text/javascript"></script>
   <script src="{{ asset('js/josh.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/metisMenu.js') }}" type="text/javascript"> </script>
    <script src="{{ asset('vendors/holder-master/holder.js') }}" type="text/javascript"></script>
    <!-- end of global js -->
    <!-- begining of page level js -->
    <!--  todolist-->
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- EASY PIE CHART JS -->
    <script src="{{ asset('vendors/charts/easypiechart.min.js') }}"></script>
    <script src="{{ asset('vendors/charts/jquery.easypiechart.min.js') }}"></script>
    <!--for calendar-->
    <script src="{{ asset('vendors/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/fullcalendar/calendarcustom.min.js') }}" type="text/javascript"></script>
    <!--   Realtime Server Load  -->
    <script src="{{ asset('vendors/charts/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/charts/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <!--Sparkline Chart-->
    <script src="{{ asset('vendors/charts/jquery.sparkline.js') }}"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="{{ asset('vendors/countUp/countUp.js') }}"></script>
    <!--   maps -->
    <script src="{{ asset('vendors/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
     <script src="{{ asset('vendors/jscharts/Chart.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}" type="text/javascript"></script>
    @yield('pageJs')
    
    @yield('pageSpecificScripts')
    <!-- end of page level js -->
  
</body>
</html>