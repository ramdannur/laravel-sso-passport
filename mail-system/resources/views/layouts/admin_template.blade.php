<!DOCTYPE html>

<!--

This is a starter template page. Use this page to start your new project from

scratch. This page gets rid of all links and provides the needed markup only.

-->

<html>

<head>

    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>BKM Express | {{ $page_title or "Administrator" }}</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Font Awesome Icons -->

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- Ionicons -->

    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('css/admin/admin-lte.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

    <![endif]-->

    @yield('css')

</head>

<body class="hold-transition sidebar-mini">

    @if (Auth::user())

            <div class="wrapper">

                <!-- Header -->

                @include('layouts.admin_header')

                <!-- Sidebar -->

                @include('layouts.admin_sidebar')

                    <!-- Content Wrapper. Contains page content -->

                    <div class="content-wrapper">

                        <!-- Content Header (Page header) -->

                        <section class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                <div class="col-sm-6">

                                    <h1>{{ $page_title or "Page Title" }}</h1>

                                    <small>{{ $page_description or null }}</small>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        @for($i = 0; $i <= count(Request::segments()); $i++)

                                        @if($i > 0 && $i < 4)

                                            <li class="breadcrumb-item">

                                            <a>{{Request::segment($i)}}</a>

                                            </li>

                                        @endif

                                        @endfor
                                    </ol>
                                </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </section>

                        <!-- Main content -->

                        <section class="content">

                            <!-- Your Page Content Here -->

                            @yield('content')

                        </section><!-- /.content -->

                </div><!-- /.content-wrapper -->

                <!-- Footer -->

            @include('layouts.admin_footer')


            </div><!-- ./wrapper -->

    @else

        <!-- Main content -->

        <section class="content">

            <!-- Your Page Content Here -->

            <div style="

                position:fixed; /*it can be fixed too*/

                left:0; right:0;

                top:0; bottom:0;

                margin:auto;">

                <center>

                    <br>

                    <br>

                    <br>

                    <br>

                    <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>

                      <p>

                        You need to login first.

                        <a href="{{ URL::to('/login') }}">click here</a> to go to Login Page.

                      </p>

                </center>

            </div>

        </section><!-- /.content -->

    @endif

<!-- REQUIRED JS SCRIPTS -->

<script src="{{ asset ("/js/admin/admin-lte.js") }}" type="text/javascript"></script>

@yield('js')

<!-- Optionally, you can add Slimscroll and FastClick plugins.

      Both of these plugins are recommended to enhance the

      user experience -->

</body>

</html>