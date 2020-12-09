@extends('layouts.admin')

@section('title')
    | افزودن حساب جدید
@endsection

@section('admins')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>افزودن حساب جدید</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a href="{{route('admin.index')}}">مدیران</a>
                </li>
                <li class="active">
                    <strong>افزودن حساب جدید</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="row">
        <div
            class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <div class="ibox">
                <div class="ibox-content">
                    <form method="POST" id="form" action="{{ route('admin.store') }}" class="form-horizontal"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">نام</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}"
                                       required autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="col-md-4 control-label">نام خانوادگی</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name"
                                       value="{{old('last_name')}}" required autofocus>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="col-md-4 control-label">تلفن</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                       value="{{ old('phone_number')}}" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo" class="col-md-4 control-label">ایمیل</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email')}}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">وضعیت</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status" id="" required>
                                    <option value="on">فعال</option>
                                    <option value="off">غیرفعال</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">رمز عبور </label>
                            <div class="col-md-6">
                                <input id="email" type="password" class="form-control" name="password"
                                       value="{{ old('password ')}}" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">تایید رمز عبور </label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password_confirmation"
                                       required>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-offset-3">
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

@endsection
