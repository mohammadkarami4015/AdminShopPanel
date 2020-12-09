@extends('layouts.admin')

@section('title')
       | پروفایل
@endsection

@section('admins')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>پروفایل</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li class="active">
                    <strong>پروفایل</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>اطلاعات کاربری</h5>
                    </div>
                    <div id="myTable" class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>ایمیل </th>
                                <th>تلفن </th>
                                <th>وضعیت </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$admin->id}}</td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->phone_number}}</td>
                                    @can('super_admin')
                                        <td>
                                            <div class="switch">
                                                <label>
                                                    <input id="switchButton{{$admin->id}}" onchange="activate({{$admin->id}})" name="status" type="checkbox" @if($admin->status=='on')checked @endif >
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </td>
                                    @endcan
                                    @if(Gate::check('super_admin') || Gate::check('admin'))
                                        <td>
                                            <a class="btn btn-sm btn-info"  href="{{ route('admin.editAdmins',['user'=>$admin->id ]) }}">ویرایش</a>
                                        </td>
                                    @endif
                                    @can('teacher')
                                        <td>
                                            <a class="btn btn-sm btn-info"  href="{{ route('teacher.edit',['teacher'=>$admin->id ]) }}">ویرایش</a>
                                        </td>
                                    @endcan
                                    @can('student')
                                        <td>
                                            <a class="btn btn-sm btn-info"  href="{{ route('user.edit',['user'=>$admin->id ]) }}">ویرایش</a>
                                        </td>
                                    @endcan
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$admin->id}}">
                                            جزئیات
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">جزئیات</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">


                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">عکس پروفایل</div>
                                                                    @if($admin->photo)
                                                                        <div id="myCarousel{{$admin->id}}" class="carousel slide" data-ride="carousel">
                                                                            <!-- Wrapper for slides -->
                                                                            <div class="carousel-inner">
                                                                                <div class="item  active ">
                                                                                    <img src="/{{$admin->photo}}" alt="" style="width:100%;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                </div>

                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">جزئیات</div>
                                                                    <div class="list-group">
                                                                        <a class="list-group-item">  نام: {{$admin->name}}</a>
                                                                        <a class="list-group-item">  کد ملی: {{$admin->national_id}}</a>
                                                                        <a class="list-group-item">  شماره کارت: {{$admin->card_number}}</a>
                                                                        <a class="list-group-item">  شبا: {{$admin->sheba}}</a>
                                                                        <a class="list-group-item">  کد معرفی: {{$admin->ref_code}}</a>
                                                                        <a class="list-group-item">  معرف: {{$admin->caller}}</a>
                                                                        <a class="list-group-item"> نوع: {{getTypeOfUser($admin->type)}}</a>
                                                                        <a class="list-group-item"> سطح: {{getLevelOfUser($admin->level)}}</a>
                                                                        @can('student')
                                                                            <a class="list-group-item">  درباره ی من: {{$admin->about_me}}</a>
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @can('teacher')
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">درباره ی من</div>
                                                                        <div class="list-group">
                                                                        <pre class="preCustom">
                                                                            {!! $admin->about_me !!}
                                                                        </pre>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('teacher')

        <div class="container">
            <div class="row">
                <div class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>  لیست دوره های ارائه شده من</h5>
                        </div>
                        <div id="myTable"  class="ibox-content table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>استاد</th>
                                    <th>تاریخ اتمام ثبت نام</th>
                                    <th>تاریخ شروع کلاس ها</th>
                                    <th>ظرفیت</th>
                                    <th>وضعیت</th>
                                </tr>
                                </thead>
                                <tbody >
                                @foreach($admin->presentCourses as $p_c)
                                    <tr>
                                        <td>{{$p_c->id}}</td>
                                        <td>@if($p_c->course){{$p_c->course->title}}@endif</td>
                                        <td>@if($p_c->user){{$p_c->user->name.' '.$p_c->user->last_name}}@endif</td>
                                        <td>{{$p_c->start_date}}</td>
                                        <td>{{$p_c->submit_date}}</td>
                                        <td>{{$p_c->capacity}}</td>
                                        <td>
                                            <div class="switch">
                                                <label>
                                                    <input id="switchButtonPresent{{$p_c->id}}" onchange="activatePresent({{$p_c->id}})" name="status" type="checkbox" @if($p_c->status=='on')checked @endif >
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </td>
                                        @can('delete')
                                            <td>
                                                <form class="deleteForm" method="post" action="{{ route('present.destroy',['present'=>$p_c->id ]) }}">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button class="btn btn-sm btn-danger" type="submit">حذف
                                                    </button>
                                                </form>
                                            </td>
                                        @endcan
                                        @can('update')
                                            <td>
                                                <a  class="btn btn-sm btn-info" href="{{ route('present.edit',['present'=>$p_c->id ]) }}">ویرایش</a>
                                            </td>
                                        @endcan
                                        <td>
                                            <a  class="btn btn-sm btn-info" href="{{ route('submit.index2',['id'=>$p_c->id ]) }}">لیست ثبت نام اولیه</a>
                                        </td>
                                        <td>
                                            <a  class="btn btn-sm btn-info" href="{{ route('student.indexTwo',['id'=>$p_c->id ]) }}">لیست ثبت نام نهایی</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$p_c->id}}">
                                                جزئیات
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter{{$p_c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">اطلاعات دوره</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading"> محل برگزاری</div>
                                                                        <div class="list-group">
                                                                            <a class="list-group-item"> آدرس: {{$p_c->address}} </a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading"> زمان برگزاری</div>
                                                                        <div class="list-group">
                                                                            @foreach(explode(";",$p_c->times) as $time)
                                                                                @if($time!="")
                                                                                    <a class="list-group-item"> روز و ساعت: {{$time}} </a>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">توضیحات</div>
                                                                        <div class="list-group">
                                                                            <pre class="preCustom">
                                                                                {!! $p_c->desc !!}
                                                                            </pre>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a  class="btn btn-sm btn-success" href="{{ route('present.create')}}">ارائه دوره جدید</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5> لیست درخواست وجه من</h5>
                        </div>
                        <div id="myTable"  class="ibox-content table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>شماره کارت</th>
                                    <th>شماره شبا</th>
                                    <th>مبلغ</th>
                                    <th>وضعیت</th>
                                </tr>
                                </thead>
                                <tbody >
                                @foreach($admin->financials as $financial)
                                    <tr>
                                        <td>{{$financial->id}}</td>
                                        <td>@if($financial->user){{$financial->user->name}}@endif</td>
                                        <td>{{$financial->card_number}}</td>
                                        <td>{{$financial->sheba}}</td>
                                        <td>{{$financial->amount}}</td>
                                        @can('super_admin')
                                            @if($financial->status == null)
                                                <td>
                                                    <a id="read_button{{$financial->id}}" onclick="read({{$financial->id}});" class="btn btn-sm btn-info">تایید کردن</a>
                                                </td>
                                            @endif
                                            @if($financial->status == "accepted")
                                                <td>
                                                    <a class="btn btn-sm btn-white disabled">تایید شد</a>
                                                </td>
                                            @endif
                                        @endcan
                                        @can('teacher')
                                            <td>
                                                <a class="btn btn-sm btn-info disabled">@if($financial->status=="accepted"){{"تایید شده"}} @else {{'در انتظار'}} @endif</a>
                                            </td>
                                        @endcan
                                        @can('delete')
                                            <td>
                                                <form class="deleteForm" method="post" action="{{ route('financial.destroy',['financial'=>$financial->id ]) }}">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button class="btn btn-sm btn-danger" type="submit">حذف
                                                    </button>
                                                </form>
                                            </td>
                                        @endcan
                                        @can('update')
                                            <td>
                                                <a  class="btn btn-sm btn-info" href="{{ route('financial.edit',['financial'=>$financial->id ]) }}">ویرایش</a>
                                            </td>
                                        @endcan
                                        @can('super_admin')
                                            <td>
                                                <a  class="btn btn-sm btn-info" href="{{ route('clearing.createTwo',['id'=>$financial->id ]) }}">پرداخت وجه</a>
                                            </td>
                                        @endcan

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a  class="btn btn-sm btn-success" href="{{ route('financial.create')}}">درخواست وجه</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endcan

    @can('student')
        <div class="container">
            <div class="row">
                <div class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5> لیست ثبت نام های اولیه من</h5>
                        </div>
                        <div id="myTable"  class="ibox-content table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>دانشجو</th>
                                    <th>زمان انتخابی</th>
                                    <th>تاریخ ثبت</th>
                                    @can('super_admin')<th>وضعیت پرداخت</th>@endcan
                                </tr>
                                </thead>
                                <tbody >
                                @foreach($admin->courseSubmits as $c_s)
                                    <tr>
                                        <td>{{$c_s->id}}</td>
                                        <td>@if($c_s->user){{$c_s->user->name}}@endif</td>
                                        <td>{{$c_s->time}}</td>
                                        <td>{{jalaliFormat($c_s->created_at)}}</td>
                                        @can('super_admin')
                                            <td>
                                                <div class="switch">
                                                    <label>
                                                        <input id="switchButton{{$c_s->id}}" onchange="activate({{$c_s->id}})" name="payment" type="checkbox" @if($c_s->payment=='success')checked @endif >
                                                        <span class="lever"></span>
                                                    </label>
                                                </div>
                                            </td>
                                        @endcan
                                        @can('delete')
                                            <td>
                                                <form class="deleteForm" method="post" action="{{ route('submit.destroy',['submit'=>$c_s->id ]) }}">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button class="btn btn-sm btn-danger" type="submit">حذف
                                                    </button>
                                                </form>
                                            </td>
                                        @endcan
                                        @can('update')
                                            <td>
                                                <a  class="btn btn-sm btn-info" href="{{ route('submit.edit',['submit'=>$c_s->id ]) }}">ویرایش</a>
                                            </td>
                                        @endcan
                                        @if(Gate::check('teacher') || Gate::check('super_admin')){
                                            <td>
                                                <a  class="btn btn-sm btn-info" href="{{ route('student.storeTow',['id'=>$c_s->id ]) }}">افزودن به کلاس</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>کلاس های من</h5>
                        </div>
                        <div id="myTable"  class="ibox-content table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>دانشجو</th>
                                    <th>عنوان دوره</th>
                                    <th>زمان برگزاری کلاس</th>
                                    <th>نمره</th>
                                </tr>
                                </thead>
                                <tbody >
                                @foreach($admin->courseStudents as $c_s)
                                    <tr>
                                        <td>{{$c_s->id}}</td>
                                        <td>@if($c_s->user){{$c_s->user->name}}@endif</td>
                                        <td>@if($c_s->presentCourse){{$c_s->presentCourse->course->title}}@endif</td>
                                        <td>{{$c_s->time}}</td>
                                        <td>@if($c_s->mark){{$c_s->mark}} @else {{'اعلام نشده'}} @endif</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endcan


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function activate(id) {
            var switchButton = '#switchButton' + id;
            var value =$(switchButton).is(":checked")?'on':'off';
            $.get(`/active/admin/${id}/${value}`,{id: id,value:value}, function(result){
            });
        }

        function activatePresent(id) {
            var switchButtonPresent = '#switchButtonPresent' + id;
            var value =$(switchButtonPresent).is(":checked")?'on':'off';
            $.get(`/active/present/${id}/${value}`,{id: id,value:value}, function(result){
                console.log(result)
            });
        }

        $('#search').on('click',function () {
            var value =$('#searchInput').val();
            $.get(`/search/in/admins/{value}`,{value:value}, function(result){
                $('#myTable').html(result)
            });
        })
    </script>
@endsection
