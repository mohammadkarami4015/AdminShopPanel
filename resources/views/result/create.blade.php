@extends('layouts.admin')

@section('title')
    {{$site_title}}ثبت پاسخ آزمون جدید
@endsection

@section('result')
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
            <h2> ثبت پاسخ آزمون جدید</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>پاسخ آزمون ها</a>
                </li>
                <li class="active">
                    <strong>ثبت پاسخ آزمون جدید</strong>
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
                    <div class="panel-heading">ثبت پاسخ آزمون جدید</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('result.store') }}" >
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('test_id') ? ' has-error' : '' }}">
                                <label for="course_id" class="col-md-4 control-label">تست </label>
                                <div class="col-md-6">
                                    <select  class="form-control" name="test_id" id="" >
                                        <option disabled selected>انتخاب تست</option>
                                        @foreach($tests as $test)
                                            <option value="{{$test->id}}">{{$test->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">عنوان</label>
                                <div class="col-md-6" id="">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title ')}}" required >
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tip') ? ' has-error' : '' }}">
                                <label for="tip" class="col-md-4 control-label">تیپ</label>
                                <div class="col-md-6" id="">
                                    <input id="tip" type="text" class="form-control" name="tip" value="{{old('tip')}}" required >
                                    @if ($errors->has('tip'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tip') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                <label for="value" class="col-md-4 col-md-push-3 control-label">پاسخ  </label>
                                <div class="col-md-12" id="">
                                    <textarea id="summernote" type="text" class="form-control" name="value" cols="500" rows="30"  >{{ old('value') }}</textarea>
                                    @if ($errors->has('value'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('value') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
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