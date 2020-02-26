@extends('layouts.admin')

@section('title')
    {{$site_title}}  | ویرایش حساب کاربری
@endsection

@section('teachers')
    active
@endsection



@section('header')
    <link href="{{asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <style>
        .note-editor .note-editable{
            background-color: #f8f8ffa1;
            border: 1px solid lightgray;
            border-top: 0 solid;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            min-height: 250px;
        }
        .note-editor .note-toolbar {
            border: 1px solid lightgray;
            border-bottom: 0 solid;
            border-top-right-radius:5px;
            border-top-left-radius:5px;
            padding-bottom: 15px;
            background-color: #1ab394;
        }
    </style>
@endsection


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>ویرایش حساب کاربری</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>کاربران</a>
                </li>
                <li class="active">
                    <strong>ویرایش حساب کاربری</strong>
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
                    <form  method="POST" id="form" action="{{ route('teacher.update',['teacher'=>$teacher->id ]) }}" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">نام</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $teacher->name }}" autofocus>

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
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ $teacher->phone_number }}" required autofocus>
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label for="photo" class="col-md-4 control-label">عکس</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo" value="{{ old('photo')}}">
                                @if ($errors->has('photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">ایمیل </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"  value="{{ $teacher->email }}" required>

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
                                <input id="national_id" type="text" class="form-control" name="national_id"  value="{{ $teacher->national_id}}" required>

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
                                <input id="card_number" type="text" class="form-control" name="card_number"  value="{{ $teacher->card_number}}" >

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
                                <input id="sheba" type="text" class="form-control" name="sheba"  value="{{ $teacher->sheba}}" >

                                @if ($errors->has('sheba'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sheba') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @can('super_admin')
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role" class="col-md-4 control-label">سمت</label>
                                <div class="col-md-6">
                                    <select  class="form-control" name="role" id="role">
                                        @foreach($roles as $role)
                                            @continue($role->id!=$teacher->roles[0]->id)
                                            <option value="{{$role->id}}">{{$role->label}}</option>
                                        @endforeach
                                        @foreach($roles as $role)
                                            @continue($role->id==$teacher->roles[0]->id)
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
                                        <option value="1" @if($teacher->type=="1" ) selected @endif >سوپر ادمین</option>
                                        <option value="2" @if($teacher->type=="2" ) selected @endif>ادمین</option>
                                        <option value="3" @if($teacher->type=="3" ) selected @endif>استاد اولیه</option>
                                        <option value="4" @if($teacher->type=="4" ) selected @endif>استاد</option>
                                        <option value="5" @if($teacher->type=="5" ) selected @endif>کاربر</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                <label for="level" class="col-md-4 control-label">سطح</label>
                                <div class="col-md-6">
                                    <select  class="form-control" name="level" id="level">
                                        <option disabled selected>انتخاب سطح</option>
                                        <option value="1" @if($teacher->level=="1" ) selected @endif>مربی</option>
                                        <option value="2" @if($teacher->level=="2" ) selected @endif>استادیار</option>
                                        <option value="3" @if($teacher->level=="3" ) selected @endif>دانشیار</option>
                                        <option value="4" @if($teacher->level=="4" ) selected @endif>استاد</option>
                                        <option value="5" @if($teacher->level=="5" ) selected @endif>دانشجو</option>
                                        <option value="6" @if($teacher->level=="6" ) selected @endif>کاربر عادی</option>
                                    </select>
                                </div>
                            </div>
                        @endcan
                        <div class="form-group{{ $errors->has('about_me') ? ' has-error' : '' }}">
                            <label for="about_me" class="col-md-4 col-md-push-3 control-label">درباره ی من</label>
                            <div class="col-md-12">
                                <textarea name="about_me" id="summernote" cols="50" rows="10">{{ $teacher->about_me}}</textarea>
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
                                <input id="password" type="password" class="form-control" name="password" >
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
                                       name="password_confirmation" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-offset-3">
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
@endsection
@section('footer')
    <script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>
    <script>
        $(document).ready(function(){

            $(".summernote").summernote({

                onChange: function () {
                    $('.note-editor').find('textarea').attr('name', 'value');

                    $('.note-codable').text($('.note-editable').html());
                }
            });
            $(".summernote").trigger('summernote.change');

            $('#summernote').summernote({
                height: 200,
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], editor, welEditable);
                }
            });

            function sendFile(file, editor, welEditable) {
                let data = new FormData();
                data.append("file", file);
                data.append("_token", "{{ csrf_token() }}");
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "/upload/photo/summernote",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        editor.insertImage(welEditable, url);
                    }
                });
            }

            document.getElementById("solardate").addEventListener("click", function() {
                $(".ha-datetimepicker-container").css({top: -900});
            });

            document.getElementById("solardate2").addEventListener("click", function() {
                $(".ha-datetimepicker-container").css({top: -900});
            });

        });
    </script>
@endsection