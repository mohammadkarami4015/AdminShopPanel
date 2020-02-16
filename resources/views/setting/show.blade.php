@extends('layouts.admin')

@section('title')
    {{$site_title}}   | لیست تنظیمات
@endsection

@section('setting')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>تنظیمات</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>تنظیمات </a>
                </li>
                <li class="active">
                    <strong>لیست تنظیمات</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>   تنظیمات</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">گزینه 1</a>
                                </li>
                                <li><a href="#">گزینه 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>   نام</th>
                                <th>   مقدار</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $x = 1; @endphp
                            @foreach($setting as $s)
                                <tr>
                                    <td>{{$s->id}} </td>
                                    <td>{{$s->title}}</td>
                                    <td>{{$s->value }}</td>
                                    @can('update')
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('setting.edit',['id'=>$s->id ]) }}">ویرایش</a>
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
@endsection
