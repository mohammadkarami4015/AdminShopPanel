@extends('layouts.admin')

@section('title')
    {{$site_title}}  | افزودن حساب جدید
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
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>مدیران</a>
                </li>
                <li class="active">
                    <strong>افزودن  حساب جدید</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <div class="ibox">
                <div class="ibox-content">
                    <form  method="POST" id="form" action="{{ route('admin.store') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">نام</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">تلفن</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number')}}" required >
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">ایمیل </label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"  value="{{ old('email ')}}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('national_id') ? ' has-error' : '' }}">
                            <label for="national_id" class="col-md-4 control-label">کد ملی </label>
                            <div class="col-md-6">
                                <input id="national_id" type="text" class="form-control" name="national_id"  value="{{ old('national_id')}}" required>

                                @if ($errors->has('national_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('national_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                            <label for="card_number" class="col-md-4 control-label">شماره کارت</label>
                            <div class="col-md-6">
                                <input id="card_number" type="text" class="form-control" name="card_number"  value="{{ old('card_number')}}" >

                                @if ($errors->has('card_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('card_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('sheba') ? ' has-error' : '' }}">
                            <label for="sheba" class="col-md-4 control-label">شماره شبا</label>
                            <div class="col-md-6">
                                <input id="sheba" type="text" class="form-control" name="sheba"  value="{{ old('sheba')}}" >

                                @if ($errors->has('sheba'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sheba') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">سمت</label>
                            <div class="col-md-6">
                                <select  class="form-control" name="role" id="" required>
                                    <option disabled selected>انتخاب سمت</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->label}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">نوع</label>
                            <div class="col-md-6">
                                <select  class="form-control" name="type" id="type" required>
                                    <option disabled selected>انتخاب نوع</option>
                                    <option value="1">سوپر ادمین</option>
                                    <option value="2">ادمین</option>
                                    <option value="3">استاد اولیه</option>
                                    <option value="4">استاد</option>
                                    <option value="5">کاربر</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                            <label for="level" class="col-md-4 control-label">سطح</label>
                            <div class="col-md-6">
                                <select  class="form-control" name="level" id="level">
                                    <option disabled selected>انتخاب سطح</option>
                                    <option value="1">مربی</option>
                                    <option value="2">استادیار</option>
                                    <option value="3">دانشیار</option>
                                    <option value="4">استاد</option>
                                    <option value="5">دانشجو</option>
                                    <option value="6">کاربر عادی</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('about_me') ? ' has-error' : '' }}">
                            <label for="about_me" class="col-md-4 control-label">درباره ی من</label>
                            <div class="col-md-6">
                                <textarea name="about_me" id="about_me" cols="50" rows="10">{{ old('about_me')}}</textarea>
                                @if ($errors->has('about_me'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about_me') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">رمز عبور</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label"> تایید رمز عبور</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required>
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
@section('footer')
    <script src="{!! asset('js/materialize.min.js') !!}"></script>
@endsection
