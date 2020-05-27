@extends('layouts.admin')

@section('title')
    {{$site_title}} ثبت مقاله جدید
@endsection

@section('articles')
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
            <h2>ثبت مقاله جدید</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>مقالات</a>
                </li>
                <li class="active">
                    <strong>ثبت مقاله جدید</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> ثبت مقاله جدید </div>

                    <div class="panel-body">
                        <form id="form1" class="form-horizontal" method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">عنوان </label>
                                <div class="col-md-6" id="">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required >
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('sub_title') ? ' has-error' : '' }}">
                                <label for="sub_title" class="col-md-4 control-label">زیر عنوان </label>
                                <div class="col-md-6" id="">
                                    <input id="sub_title" type="text" class="form-control" name="sub_title" value="{{ old('sub_title') }}" required>
                                    @if ($errors->has('sub_title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sub_title') }}</strong>
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
                            <div class="form-group{{ $errors->has('sub_desc') ? ' has-error' : '' }}">
                                <label for="sub_desc" class="col-md-4 control-label">توضیح مختصر</label>
                                <div class="col-md-6">
                                    <textarea name="sub_desc"  cols="70" rows="5">{{ old('sub_desc')}}</textarea>
                                    @if ($errors->has('sub_desc'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sub_desc') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                                <label for="desc" class="col-md-4 col-md-push-3 control-label">توضیحات  </label>
                                <div class="col-md-12" id="">
                                    <textarea id="summernote" type="text" class="form-control" name="desc" rows="10" required >{{ old('desc') }}</textarea>
                                @if ($errors->has('desc'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('desc') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button id="submit" type="submit" class="btn btn-primary">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $("#submit").on("click",function () {
            $("#form1").submit();
        })
    </script>


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
           // $(".summernote").trigger('summernote.change');

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
