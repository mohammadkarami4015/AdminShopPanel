@extends('layouts.admin')

@section('title')
      {{$site_title}}  | لیست دوره ها
@endsection

@section('course')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست دوره ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>دوره ها</a>
                </li>
                <li class="active">
                    <strong>لیست دوره ها</strong>
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
                        <h5> لیست دوره ها</h5>
                    </div>
                    <div class="searchListDiv">
                        <input class="form-control searchListInput" id="searchInput" type="text" placeholder="جستجو بر اساس شماره عنوان">
                        <button class="btn btn-primary btn-sm searchListBtn" id="search" >جستجو</button>
                    </div>
                    <div id="myTable" class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>نوع </th>
                                <th>وضعیت </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{$course->id}}</td>
                                    <td>{{$course->title}}</td>
                                    <td>{{getCourseType($course->type)}}</td>
                                    <td>
                                        <div class="switch">
                                            <label>
                                                <input id="switchButton{{$course->id}}" onchange="activate({{$course->id}})" name="status" type="checkbox" @if($course->status=='on')checked @endif >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                    @can('update')
                                        <td>
                                            <a class="btn btn-sm btn-info"  href="{{ route('course.edit',['course'=>$course->id ]) }}">ویرایش</a>
                                        </td>
                                    @endcan
                                    @can('delete')
                                        <td>
                                            <form class="deleteForm" method="post" action="{{ route('course.destroy',['course'=>$course->id ]) }}">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-sm btn-danger" type="submit">حذف
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$course->id}}">
                                            جزئیات
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">جزئیات</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">جزئیات</div>
                                                                    @if($course->photo)
                                                                        <div id="myCarousel{{$course->id}}" class="carousel slide" data-ride="carousel">
                                                                            <!-- Wrapper for slides -->
                                                                            <div class="carousel-inner">
                                                                                <div class="item  active ">
                                                                                    <img src="/{{$course->photo}}" alt="Los Angeles" style="width:100%;">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="list-group">
                                                                        <a class="list-group-item">  توضیحات: {{$course->desc}}</a>
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
                        @if(!$flag)
                            <div class="text-center">
                                {{ $courses->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function activate(id) {
            var switchButton = '#switchButton' + id;
            var value =$(switchButton).is(":checked")?'on':'off';
            console.log(value)
            $.get(`/active/course/${id}/${value}`,{id: id,value:value}, function(result){
            });
        }
        $('#search').on('click',function () {
            var value =$('#searchInput').val();
            $.get(`/search/in/courses/{value}`,{value:value}, function(result){
                $('#myTable').html(result)
            });
        })
    </script>
@endsection
