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
                                @foreach($user->courseSubmits as $c_s)
                                    <tr>
                                        <td>{{$c_s->id}}</td>
                                        <td>@if($c_s->user){{$c_s->user->name}}@endif</td>
                                        <td>{{$c_s->time}}</td>
                                        <td>{{jalaliFormat($c_s->created_at)}}</td>
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

        $('#search').on('click',function () {
            var value =$('#searchInput').val();
            $.get(`/search/in/admins/{value}`,{value:value}, function(result){
                $('#myTable').html(result)
            });
        })
    </script>
@endsection
