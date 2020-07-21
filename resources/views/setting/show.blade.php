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
                            @foreach($setting as $s)
                                @if($s->key!=="slider")
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
                                @endif
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
            <div class="col-md-8 col-md-offset-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>   تنظیمات اسلایدر</h5>
                    </div>
                    <div class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>    لینک</th>
                                <th>   آدرس عکس</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($setting as $s)
                                @if($s->key==="slider")
                                    <tr>
                                        <td>{{$s->id}} </td>
                                        @foreach(explode(";",$s->value) as $item)
                                            <td>{{$item}}</td>
                                        @endforeach
                                        @can('update')
                                            <td>
                                                <a class="btn btn-sm btn-info" href="{{ route('setting.editSlider',['id'=>$s->id ]) }}">ویرایش</a>
                                            </td>
                                        @endcan
                                        @can('delete')
                                            <td>
                                                <form class="deleteForm" method="post" action="{{ route('setting.destroy',['id'=>$s->id ]) }}">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button class="btn btn-sm btn-danger" type="submit">حذف
                                                    </button>
                                                </form>
                                            </td>
                                        @endcan
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <a class="btn btn-sm btn-success" href="{{ route('setting.addSlider') }}">افزودن اسلایدر جدید</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
