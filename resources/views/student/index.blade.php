@extends('layouts.admin')

@section('title')
    {{$site_title}}لیست ثبت نام کنندگان نهایی
@endsection

@section('present')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست ثبت نام کنندگان نهایی</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>ارائه دوره</a>
                </li>
                <li class="active">
                    <strong>لیست ثبت نام کنندگان نهایی</strong>
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
                        <h5> لیست ثبت نام کنندگان نهایی</h5>
                    </div>
                    {{--<div style="display: flex;justify-content: center;flex-direction: row;background-color: white;">
                        <input style="margin-top: 10px;margin-bottom: 15px;margin-right: 5px;" class="form-control" id="searchInput" type="text" placeholder="جستجو بر اساس عنوان">
                        <button class="btn btn-primary btn-sm" style="margin-right: 5px;height: 33px;margin-top: 10px;margin-left: 5px;" id="search" >جستجو</button>
                    </div>--}}
                    <div id="myTable"  class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>دانشجو</th>
                                <th>زمان برگزاری کلاس</th>
                                <th>نمره</th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($c_ses as $c_s)
                                <tr>
                                    <td>{{$c_s->id}}</td>
                                    <td>@if($c_s->user){{$c_s->user->name}}@endif</td>
                                    <td>{{$c_s->time}}</td>
                                    <td>@if($c_s->mark){{$c_s->mark}} @else {{'اعلام نشده'}} @endif</td>
                                    @can('delete')
                                        <td>
                                            <form class="deleteForm" method="post" action="{{ route('student.destroy',['student'=>$c_s->id ]) }}">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-sm btn-danger" type="submit">حذف
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                    @can('update')
                                        <td>
                                            <a  class="btn btn-sm btn-info" href="{{ route('student.edit',['student'=>$c_s->id ]) }}">ویرایش</a>
                                        </td>
                                    @endcan

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(!$flag)
                            <div class="text-center">
                                {{ $c_ses->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
