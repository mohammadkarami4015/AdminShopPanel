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
                            <div class="adminProfile" style="background-image:url( @if(auth()->user()->photo){{'/'.auth()->user()->photo}} @else {{'/image/user.png'}} @endif )">
                            </div>
                            <a href="{{route('photos.addPhotosForm',['id'=>auth()->user()->id])}}"><img class="plusIcon" src="/image/plus.png" alt=""></a>

                        </div>
                        <div >
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span style="display: flex;justify-content: center;align-items: center;flex-direction: row-reverse;" class="clear">
                                    <span class="block m-t-xs"> <strong class="font-bold">{{auth()->user()->name}}{{' '}}</strong></span>
                                    <span class="text-muted text-xs block" style="margin: 0px 6px;"><b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInLeft m-t-xs">
                                <li><a class="editProfileDiv" href="{{route('admin.profile',['user'=>auth()->user()->id])}}">پروفایل</a></li>
                                <li class="divider"></li>
                                <li>
                                    <form class="logOutForm" id="logout-form" action="{{ route('logout') }}" method="POST" >
                                        @csrf
                                        <button class="btn btn-danger logoutBtn" type="submit"><i class="material-icons"></i> خروج</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="logo-element">
                        {{$site_title}}
                    </div>
                </li>
                @can('super_admin')
                    <li class="@yield('admins')" >
                        <a><i class="fa fa-user"></i> <span class="nav-label">مدیران</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href=" {{route('admin.index')}}">لیست همه مدیران</a></li>
                            <li><a  href=" {{route('admin.create')}}">ثبت حساب جدید</a></li>
                        </ul>
                    </li>
                @endcan
                @if(Gate::check('super_admin') || Gate::check('admin'))
                    <li class="@yield('users')" >
                        <a><i class="fa fa-users"></i> <span class="nav-label">کاربران </span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a   href="{{route('user.index')}}">   لیست کاربران</a></li>
                        </ul>
                    </li>
                    <li class="@yield('teachers')" >
                        <a><i class="fa fa-users"></i> <span class="nav-label">اساتید</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a   href="{{route('teacher.index')}}">   لیست اساتید اولیه</a></li>
                            <li><a   href="{{route('teacher.index2')}}">   لیست اساتید</a></li>
                        </ul>
                    </li>
                    <li class="@yield('course')" >
                        <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">دوره ها</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href="{{route('course.index')}}"> لیست دوره ها</a></li>
                            <li><a  href="{{route('course.create')}}">ثبت دوره جدید</a></li>
                        </ul>
                    </li>
                    <li class="@yield('test')" >
                        <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">آزمون ها</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href="{{route('test.index')}}"> لیست آزمون ها</a></li>
                            <li><a  href="{{route('test.create')}}">ثبت آزمون جدید</a></li>
                        </ul>
                    </li>
                    <li class="@yield('result')" >
                        <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">پاسخ آزمون ها</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href="{{route('result.index')}}"> لیست  پاسخ آزمون ها</a></li>
                            <li><a  href="{{route('result.create')}}">ثبت پاسخ آزمون جدید</a></li>
                        </ul>
                    </li>
                    <li class="@yield('present')" >
                        <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">ارائه دوره</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href="{{route('present.index')}}"> لیست دوره های ارائه شده</a></li>
                            <li><a  href="{{route('present.create')}}">ارائه دوره جدید</a></li>
                        </ul>
                    </li>
                    <li class="@yield('payment')" >
                        <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">پرداخت ها</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href="{{route('payment.index')}}"> لیست پرداخت ها</a></li>
                        </ul>
                    </li>
                    <li class="@yield('financial')" >
                        <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">درخواست وجه</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href="{{route('financial.create')}}">درخواست وجه</a></li>
                            <li><a  href="{{route('financial.index')}}"> لیست درخواست وجه</a></li>
                        </ul>
                    </li>
                    <li class="@yield('clearing')" >
                        <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">پرداخت وجه</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href="{{route('clearing.index')}}"> لیست پرداخت وجه</a></li>
                        </ul>
                    </li>
                    <li class="@yield('messages')" >
                        <a><i class="fa fa-envelope-o"></i> <span class="nav-label"> پیام ها</span> <span class="fa arrow"></span>@if(session('number_of_new_message')>0)<span style="margin: 0 8px " class="label label-info pull-left">{{session('number_of_new_message')}}</span>@endif</a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href="{{route('messages.index')}}">    لیست پیام ها</a></li>
                        </ul>
                    </li>
                    <li class="@yield('setting')" >
                        <a><i class="fa fa-cogs"></i> <span class="nav-label"> تنظیمات</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a id="pjax" href="{{route('setting.index')}}">لیست تنظیمات</a></li>
                        </ul>
                    </li>
                @endif
                @if(Gate::check('super_admin') || Gate::check('teacher') || Gate::check('admin'))
                    <li class="@yield('articles')" >
                        <a><i class="fa fa-newspaper-o"></i> <span class="nav-label"> مقالات</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href="{{route('articles.index')}}"> لیست مقالات</a></li>
                            <li><a  href="{{route('articles.create')}}">ثبت مقاله جدید</a></li>
                        </ul>
                    </li>
                    <li class="@yield('news')" >
                        <a><i class="fa fa-newspaper-o"></i> <span class="nav-label"> اخبار</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a  href="{{route('news.index')}}"> لیست خبرها</a></li>
                            <li><a  href="{{route('news.create')}}">ثبت خبر جدید</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation">
               {{-- <div class="navbar-header floatRight">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form  method="POST" role="search" class="searchForm" action="{{route('admin.searchPhoneNumber')}}">
                        {{ csrf_field() }}
                        <div class="searchItemDiv">
                            <input type="text" placeholder="شماره تلفن را وارد نمایید" class="searchInput" name="phone_number" id="myInputTop">
                            <button type="submit" class="searchBtn btn btn-primary">جستجو</button>
                        </div>
                    </form>
                </div>--}}
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
