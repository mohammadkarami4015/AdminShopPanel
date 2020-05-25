@extends('layouts.admin')

@section('title')
      {{$site_title}}  | پروفایل
@endsection

@section('student')
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

    @can('student')

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
                                @foreach($user->courseStudents as $c_s)
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
