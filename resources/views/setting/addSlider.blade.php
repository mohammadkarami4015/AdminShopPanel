@extends('layouts.admin')

@section('title')
    {{$site_title}}  |  افزودن اسلایدر
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
                    <strong> افزودن اسلایدر</strong>
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
                    <div class="panel-heading">افزودن اسلایدر</div>
                    <div  class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('setting.storeSlider') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has("link") ? ' has-error' : '' }}">
                                <label for="link" class="col-md-3 control-label"> لینک</label>
                                <div class="col-md-7">
                                    <input class="form-control" type="text" name="link" required>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has("file") ? ' has-error' : '' }}">
                                <label for="file" class="col-md-3 control-label"> عکس</label>
                                <div class="col-md-7">
                                    <input class="form-control" type="file" name="file" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        ثبت
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
