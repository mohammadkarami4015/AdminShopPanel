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
    <link href="{{ asset('css/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/bootstrap.rtl.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/font-awesome/css/font-awesome.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/plugins/morris/morris-0.4.3.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/animate.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/admin.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/plugins/dropzone/basic.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/plugins/dropzone/dropzone.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" media="all"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/style.rtl.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/materialize.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/plugins/chosen/chosen.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" media="all"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dist/css/s.map.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dist/css/fa/style.css') }}" data-path="/dist/css/" data-file="style.css" media="all"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/dropdown/materilizeDropdown.css') }}" data-path="/dist/css/" data-file="style.css"
          media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('src/ha-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{ asset('plyr/plyr.css') }}" data-path="/dist/css/" data-file="style.css" media="all" rel="stylesheet"
          type="text/css"/>

    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">


</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <div class="adminProfileDiv">
                            <div class="adminProfile"
                                 style="background-image:url(/{{auth()->user()->logo}})">
                            </div>


                        </div>
                        <div>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span
                                    style="display: flex;justify-content: center;align-items: center;flex-direction: row-reverse;"
                                    class="clear">
                                    <span class="block m-t-xs"> <strong
                                            class="font-bold">{{auth()->user()->title}}</strong></span>
                                    <span class="text-muted text-xs block" style="margin: 0px 6px;"><b
                                            class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInLeft m-t-xs">
                                <li><a class="editProfileDiv" href="{{route('shop.details')}}">پروفایل</a></li>
                                <li class="divider"></li>
                                <li>
                                    <form class="logOutForm" id="logout-form" action="{{route('logout')}}"
                                          method="POST">
                                        @csrf
                                        <button class="btn btn-danger logoutBtn" type="submit"><i
                                                class="material-icons"></i> خروج
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="logo-element">

                    </div>
                </li>

                <li class="@yield('course')">
                    <a><i class="fa fa-newspaper-o"></i> <span class="nav-label"> پروفایل</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('shop.details')}}">جزییات</a></li>
                    </ul>
                </li>
                <li class="">
                    <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">محصولات</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('product.index')}}"> لیست محصولات</a></li>
                        <li><a href="{{route('product.create')}}">ثبت محصول</a></li>
                    </ul>
                </li>
                <li class="">
                    <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">دسته بندی ها</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('shopCategory.index')}}"> لیست دسته بندی ها</a></li>
                        <li><a href="{{route('shopCategory.create')}}">ثبت دسته بندی</a></li>
                    </ul>
                </li>
                <li class="">
                    <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">سفارشات</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('order.index',['status'=>1])}}"> در انتظار تایید</a></li>
                        <li><a href="{{route('order.index',['status'=>2])}}"> تایید شده</a></li>
                        <li><a href="{{route('order.index',['status'=>3])}}"> ارسال شده</a></li>
                        <li><a href="{{route('order.index',['status'=>4])}}"> تحویل داده شده</a></li>
                        <li><a href="{{route('order.index',['status'=>5])}}"> لغو شده</a></li>
                        <li><a href="{{route('order.index',['status'=>6])}}">مرجوعی</a></li>
                        <li><a href="{{route('order.index',['status'=>7])}}">لغو توسط کاربر</a></li>
                    </ul>
                </li>
                <li class="">
                    <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">کدهای تخفیف</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('discount.index')}}"> لیست کدهای تخفیف</a></li>
                        <li><a href="{{route('discount.create')}}">ثبت کد تخفیف</a></li>
                    </ul>
                </li>
                <li class="">
                    <a><i class="fa fa-newspaper-o"></i> <span class="nav-label"> پرداختی ها</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('payment.index')}}"> لیست پرداختی ها</a></li>
                    </ul>
                </li>

                <li class="">
                    <a><i class="fa fa-newspaper-o"></i> <span class="nav-label">پیام ها</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('message.index')}}"> لیست پیام ها</a></li>
                        <li><a href="{{route('message.create')}}">ثبت پیام</a></li>
                    </ul>
                </li>

                <li class="">
                    <a><i class="fa fa-newspaper-o"></i> <span class="nav-label"> گزارش ها</span> <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('report.index')}}"> گزارش فروش ماهانه</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header floatRight">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>

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
                </div>
            </nav>
        </div>
        <div>
            @include('error')
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
{{--<script type="text/javascript" src="{!! asset('js/plugins/pace/pace.min.js') !!}"></script>--}}
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

@yield('footer')

</body>
</html>
