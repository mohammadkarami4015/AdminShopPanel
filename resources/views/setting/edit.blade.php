@extends('layouts.admin')

@section('title')
    {{$site_title}}  |    ویرایش {{ ' '.$setting->title}}
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
                    <strong> ویرایش {{ ' '.$setting->title}}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">ویرایش</div>
                    <div data-pjax  class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('setting.update') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $setting->id}}">
                            <div class="form-group{{ $errors->has($setting->key) ? ' has-error' : '' }}">
                                <label for="{{ $setting->key}}" class="col-md-3 control-label">{{ $setting->title}}</label>
                                <div class="col-md-7">
                                    <textarea id="value" type="text" class="form-control" name="value" autofocus>{{ $setting->value}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        بروز رسانی
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
