<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="adminId " content="{{ Auth::check() ? Auth::user()->id :''}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>پاسخ تست</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap.rtl.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/font-awesome/css/font-awesome.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/plugins/morris/morris-0.4.3.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/animate.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/plugins/dropzone/basic.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/plugins/dropzone/dropzone.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.rtl.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/materialize.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/plugins/chosen/chosen.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/css/s.map.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/css/fa/style.css') }}" data-path="/dist/css/" data-file="style.css" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/dropdown/materilizeDropdown.css') }}" data-path="/dist/css/" data-file="style.css" media="all" rel="stylesheet" type="text/css" />
    <link href="{{asset('src/ha-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{ asset('plyr/plyr.css') }}" data-path="/dist/css/" data-file="style.css" media="all" rel="stylesheet" type="text/css" />
   @yield('header')
</head>
<body style="background-color: #f3f3f4">
<div id="wrapper">
    <div id="page-wrapper1" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation">
               {{-- <div style="float: right;" class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>--}}
                <a href="" >
                    <img style="height: 50px;padding: 3px 22px 3px 0;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQM_tgr1K69uHNUmIaFsYUAGNKzeCt3cvxw7-MWqiTSXhl366Tc&usqp=CAU" alt="amiraan-logo">
                </a>
                <div style="padding: 13px 0px 0 30px;float: left;">
                    نتیجه آزمون
                </div>
            </nav>
        </div>
        <div id="pjax-container">
            @yield('content')
        </div>
    </div>
</div>

<script type="text/javascript" src="{!! asset('js/jquery-2.1.1.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/sweetalert.min.js') !!}"></script>
@include('flash')
<script type="text/javascript" src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/rada.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/plugins/pace/pace.min.js') !!}"></script>
@yield('footer')

</body>
</html>

