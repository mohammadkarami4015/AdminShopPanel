@extends('layouts.admin')

@section('title')
    {{$site_title}}  | ویرایش آزمون
@endsection

@section('test')
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
            <h2>ویرایش آزمون</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>آزمون ها</a>
                </li>
                <li class="active">
                    <strong>آزمون دوره </strong>
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
                    <form  method="POST" id="form" action="{{ route('test.update',['test'=>$test->id ]) }}" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">عنوان</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $test->title}}" required >
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">قیمت</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" value="{{ $test->price }}" required >
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
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
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">نوع</label>
                            <div class="col-md-6">
                                <select  class="form-control" name="type" id="type" required>
                                    <option disabled selected>انتخاب نوع</option>
                                    <option value="1" @if($test->type=="1" ) selected @endif>دو گزینه ای</option>
                                    <option value="2" @if($test->type=="2" ) selected @endif>چهار گزینه ای (دو انتخابی)</option>
                                    <option value="3" @if($test->type=="3" ) selected @endif>پنج گزینه ای</option>
                                    <option value="4" @if($test->type=="4" ) selected @endif>هشت نمره ای</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('sub_desc') ? ' has-error' : '' }}">
                            <label for="sub_desc" class="col-md-4 control-label">توضیح مختصر</label>
                            <div class="col-md-6">
                                <textarea name="sub_desc"  cols="50" rows="5">{{ $test->sub_desc }}</textarea>
                                @if ($errors->has('sub_desc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                            <label for="desc" class="col-md-4 col-md-push-3 control-label">توضیحات  </label>
                            <div class="col-md-12">
                                <textarea name="desc" id="summernote" cols="50" rows="10">{{ $test->desc }}</textarea>
                                @if ($errors->has('desc'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('desc') }} </strong>
                                    </span>
                                @endif
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
        });
    </script>
@endsection