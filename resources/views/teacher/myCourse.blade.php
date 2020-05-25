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
                                @foreach($teacher->presentCourses as $p_c)
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

    @endcan

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

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
