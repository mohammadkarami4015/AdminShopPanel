@extends('layouts.admin')

@section('title')
    | پاسخ نظرات
@endsection

@section('product')
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
            <h2>پاسخ </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li class="active">
                    <a href="{{route('productComment.index',[$shop,$product])}}"><strong>نظرات</strong></a>
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
                    <form method="POST" id="form" action="{{ route('productComment.reply',[$shop,$product,$productComment]) }}" class="form-horizontal"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="price" class="col-md-4 control-label"> ارسال کننده</label>
                            <div class="col-md-6">
                                <label for="price" class="col-md-4 control-label">{{optional($productComment->user)->name}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-md-4 control-label"> محصول مورد نظر</label>
                            <div class="col-md-6">
                                <label for="price" class="col-md-4 control-label">{{$productComment->product->title}}</label>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-md-4 control-label"> متن نظر</label>

                            <div class="col-md-6">
                                <textarea readonly>{{$productComment->message}}</textarea>
                            </div>
                        </div>

                        <br>
                        <br>
                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label">متن پاسخ </label>

                                <div class="col-md-6">
                                    <textarea name="message" id="summernote" cols="50"
                                              rows="10">{{ old('message')}}</textarea>
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

    </script>
@endsection
