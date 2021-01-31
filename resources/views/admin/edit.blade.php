@extends('layouts.admin')

@section('title')
    | ویرایش حساب کاربری
@endsection

@section('admins')
    active
@endsection
@section('header')
    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">

@endsection


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>ویرایش حساب کاربری</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a href="{{route('admin.index')}}">مدیران</a>
                </li>
                <li class="active">
                    <strong>ویرایش حساب کاربری</strong>
                </li>
            </ol>
        </div>

    </div>
    <div class="row">
        <div
            class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <div class="ibox">
                <div class="ibox-content">
                    <form method="POST" id="form" action="{{ route('admin.update',$admin) }}" class="form-horizontal"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">نام</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$admin->name}}"
                                       required autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="col-md-4 control-label">نام خانوادگی</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name"
                                       value="{{$admin->last_name}}" required autofocus>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="col-md-4 control-label">تلفن</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                       value="{{ $admin->phone_number}}" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo" class="col-md-4 control-label">ایمیل</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ $admin->email}}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">وضعیت</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status" id="" required>
                                    <option {{$admin->status == 'on' ? 'selected' : ''}} value="on">فعال</option>
                                    <option {{$admin->status == 'off' ? 'selected' : ''}} value="off">غیرفعال</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">نقش ها</label>
                            <div class="col-md-6">
                                <select class="form-control select2 select2-dropdown"
                                        data-placeholder="انتخاب نقش"
                                        multiple name="roles[]" id="type" tabindex="-1">
                                    @foreach($roles as $role)
                                        <option
                                            {{ in_array ($role->id , $admin->roles()->pluck('role_id')->toArray()) ? 'selected' : '' }} value="{{$role->id}}">{{$role->label}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    ویرایش
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class=" border-bottom white-bg ">
        <div class="col-lg-6" style="margin-right: 15%">
            <h3>ویرایش  رمز عبور</h3>
        </div>

    </div>
    <div class="row">
        <div
            class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <div class="ibox">
                <div class="ibox-content">
                    <form method="POST" id="form" action="{{ route('admin.change-password',$admin) }}" class="form-horizontal"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">رمز عبور جدید</label>
                            <div class="col-md-6">
                                <input id="email" type="password" class="form-control" name="password"
                                      required>

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
                                    ویرایش
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer')

    <script src="{{asset('/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                dir: "rtl"
            });
            $('.Select2').val(null).trigger('change');
        });
    </script>
@endsection

