<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title')
    </title>

    <!-- Styles -->
    @yield('header')
    <link href="{{ asset('css/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap.rtl.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/font-awesome/css/font-awesome.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/plugins/morris/morris-0.4.3.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/animate.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/admin.css') }}" media="all" rel="stylesheet" type="text/css" />
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


</head>
<body>
@php

@endphp
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <div class="adminProfileDiv">
                            <div class="adminProfile" style="">
                            </div>
                            <a href=""><img class="plusIcon" src="http://admin.alefbakala.ir/logo" style="width:100px; box-shadow: 3px 3px 3px 3px white" alt="الفبا کالا"></a>

                        </div>
                        <br>
                        <br>

                    </div>
                    <div class="logo-element">
                    </div>
                </li>

                    <li class="@yield('admins')" >
                        <a><i class="fa fa-user"></i> <span class="nav-label">مدیران</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href=" {{route('admin.index')}}">لیست همه مدیران</a></li>
                            <li><a  href=" {{route('admin.create')}}">ثبت حساب جدید</a></li>
                        </ul>
                    </li>
                <li class="@yield('cities')">
                    <a><i class="fa fa-user"></i> <span class="nav-label">شهرها</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href=" {{route('city.index')}}">لیست همه شهرها</a></li>
                        <li><a href=" {{route('city.create')}}">ثبت شهر جدید</a></li>
                    </ul>
                </li>
                <li class="@yield('groups')">
                    <a><i class="fa fa-user"></i> <span class="nav-label">گروه ها</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href=" {{route('group.index')}}">لیست همه گروه ها</a></li>
                        <li><a href=" {{route('group.create')}}">ثبت گروه جدید</a></li>
                    </ul>
                </li>

                <li class="@yield('subgroups')">
                    <a><i class="fa fa-user"></i> <span class="nav-label">زیرگروه ها</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href=" {{route('subgroup.index')}}">لیست همه  زیر گروه ها</a></li>
                        <li><a href=" {{route('subgroup.create')}}">ثبت زیر گروه جدید</a></li>
                    </ul>
                </li>

                <li class="@yield('subgroups')">
                    <a><i class="fa fa-user"></i> <span class="nav-label"> محصولات</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href=" {{route('products.index')}}">لیست همه محصولات </a></li>
                    </ul>
                </li>

                <li class="@yield('payments')">
                    <a><i class="fa fa-user"></i> <span class="nav-label">پرداختی ها</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href=" {{route('payment.index')}}">لیست همه پرداختی ها</a></li>

                    </ul>
                </li>

                <li class="@yield('shop')">
                    <a><i class="fa fa-user"></i> <span class="nav-label">فروشگاه</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href=" {{route('shop.index')}}">لیست همه فروشگاه ها</a></li>
                        <li><a href=" ">افزودن فروشگاه جدید</a></li>

                    </ul>
                </li>

                <li class="@yield('exit')">
                    <a><i class="fa fa-user"></i> <span class="nav-label">خروج </span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <form action="{{route('logout')}}" class="logOutForm" id="logout-form"  method="POST" >
                                @csrf
                                <button class="btn btn-danger logoutBtn" type="submit"><i class="material-icons"></i> خروج</button>
                            </form>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation">
               <div class="navbar-header floatRight">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-left">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">به بخش مدیریت خوش آمدید</span>
                    </li>
                    <li>
                        <a class="left-sidebar-toggle">
                            <i class="fa fa-tasks"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div>
            @include('error')
            @yield('content')
        </div>
    </div>
</div>

<script type="text/javascript" src="{!! asset('js/jquery-2.1.1.js') !!}"></script>
<script src="{{asset('/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2({
            dir: "rtl"
        });
        $('.Select2').val(null).trigger('change');
    });
</script>
<script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/sweetalert.min.js') !!}"></script>
@include('flash')
<script type="text/javascript" src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/rada.js') !!}"></script>
{{--<script type="text/javascript" src="{!! asset('js/plugins/pace/pace.min.js') !!}"></script>--}}
@yield('footer')

</body>
</html>
