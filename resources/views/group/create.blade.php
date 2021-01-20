@extends('layouts.admin')

@section('title')
    افزودن گروه
@endsection

@section('course')
    active
@endsection


@section('header')
    <link href="{{asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <style>
        .note-editor .note-editable {
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
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            padding-bottom: 15px;
            background-color: #1ab394;
        }
    </style>
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>افزودن گروه جدید</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">خانه</a>
                </li>
                <li>
                    <a href="{{route('group.index')}}">گروهها</a>
                </li>
                <li class="active">
                    <strong>افزودن گروه جدید</strong>
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
                    <form method="POST" id="form" action="{{ route('group.store') }}" class="form-horizontal"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">عنوان</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title"
                                       value="{{ old('title')}}" required>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">نوع</label>
                            <div class="col-md-6">
                                <select id="title" type="text" class="form-control" name="type"
                                        required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">وضعیت</label>
                            <div class="col-md-6">
                                <select id="title" type="text" class="form-control" name="status"
                                        required>
                                    <option value="on">فعال</option>
                                    <option value="off">غیرفعال</option>
                                </select>
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
    <script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>
    <script>
        $(document).ready(function () {

            $(".summernote").summernote({

                onChange: function () {
                    $('.note-editor').find('textarea').attr('name', 'value');

                    $('.note-codable').text($('.note-editable').html());
                }
            });
            $(".summernote").trigger('summernote.change');

            $('#summernote').summernote({
                height: 200,
                onImageUpload: function (files, editor, welEditable) {
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
                    success: function (url) {
                        editor.insertImage(welEditable, url);
                    }
                });
            }
        });
    </script>
@endsection
