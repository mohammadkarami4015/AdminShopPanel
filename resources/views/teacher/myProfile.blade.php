@extends('layouts.admin')

@section('title')
      {{$site_title}}  | پروفایل
@endsection

@section('teacher')
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
                                    <td>{{$teacher->id}}</td>
                                    <td>{{$teacher->name}}</td>
                                    <td>{{$teacher->email}}</td>
                                    <td>{{$teacher->phone_number}}</td>

                                    @can('teacher')
                                        <td>
                                            <a class="btn btn-sm btn-info"  href="{{ route('teacher.edit',['teacher'=>$teacher->id ]) }}">ویرایش</a>
                                        </td>
                                    @endcan
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$teacher->id}}">
                                            جزئیات
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                    @if($teacher->photo)
                                                                        <div id="myCarousel{{$teacher->id}}" class="carousel slide" data-ride="carousel">
                                                                            <!-- Wrapper for slides -->
                                                                            <div class="carousel-inner">
                                                                                <div class="item  active ">
                                                                                    <img src="/{{$teacher->photo}}" alt="" style="width:100%;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                </div>

                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">جزئیات</div>
                                                                    <div class="list-group">
                                                                        <a class="list-group-item">  نام: {{$teacher->name}}</a>
                                                                        <a class="list-group-item">  کد ملی: {{$teacher->national_id}}</a>
                                                                        <a class="list-group-item">  شماره کارت: {{$teacher->card_number}}</a>
                                                                        <a class="list-group-item">  شبا: {{$teacher->sheba}}</a>
                                                                        <a class="list-group-item">  کد معرفی: {{$teacher->ref_code}}</a>
                                                                        <a class="list-group-item">  معرف: {{$teacher->caller}}</a>
                                                                        <a class="list-group-item"> نوع: {{getTypeOfUser($teacher->type)}}</a>
                                                                        <a class="list-group-item"> سطح: {{getLevelOfUser($teacher->level)}}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @can('teacher')
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">درباره ی من</div>
                                                                        <div class="list-group">
                                                                        <pre class="preCustom">
                                                                            {!! $teacher->about_me !!}
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        $('#search').on('click',function () {
            var value =$('#searchInput').val();
            $.get(`/search/in/admins/{value}`,{value:value}, function(result){
                $('#myTable').html(result)
            });
        })
    </script>
@endsection
