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
                        <h5> وضعیت آموزشی  {{auth()->user()->name}} </h5>
                    </div>
                    <div id="myTable" class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th style="width: 30px;">نوع دوره</th>
                                <th> دوره ها</th>


                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="height-70">مربی</td>
                                    @foreach($courses as $course)
                                        @continue($course->type!=="1")
                                        <td style="border-top: 0;width: 30px;">
                                            <a
                                                    disabled
                                                    class="
                                                @foreach($c_students as $c_student)
                                                    @if($c_student->presentCourse->course_id==$course->id) btn-accepted @else btn-not-accepted @endif
                                                @endforeach ">
                                                {{$course->title}}
                                            </a>
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="height-70">دانشیار</td>
                                    @foreach($courses as $course)
                                        @continue($course->type!=="2")
                                        <td style="border-top: 0;width: 30px;">
                                            <a
                                                    disabled
                                                    class="
                                                @foreach($c_students as $c_student)
                                                    @if($c_student->presentCourse->course_id==$course->id) btn-accepted @else btn-not-accepted @endif
                                                    @endforeach ">
                                                {{$course->title}}
                                            </a>
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="height-70">استادیار</td>
                                    @foreach($courses as $course)
                                        @continue($course->type!=="3")
                                        <td  style="border-top: 0;width: 30px;">
                                            <a
                                                    disabled
                                                    class="
                                                @foreach($c_students as $c_student)
                                                    @if($c_student->presentCourse->course_id==$course->id) btn-accepted @else btn-not-accepted @endif
                                                    @endforeach ">
                                                {{$course->title}}
                                            </a>
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="height-70">استاد</td>
                                    @foreach($courses as $course)
                                        @continue($course->type!=="4")
                                        <td  style="border-top: 0;width: 30px;">
                                            <a
                                                    disabled
                                                    class="
                                                @foreach($c_students as $c_student)
                                                    @if($c_student->presentCourse->course_id==$course->id) btn-accepted @else btn-not-accepted @endif
                                                    @endforeach ">
                                                {{$course->title}}
                                            </a>
                                        </td>
                                    @endforeach
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
