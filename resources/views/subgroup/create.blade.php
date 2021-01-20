@extends('layouts.admin')

@section('title')
    افزودن زیرگروه
@endsection

@section('subgroups')
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
            <h2>افزودن زیرگروه جدید</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">خانه</a>
                </li>
                <li>
                    <a href="{{route('subgroup.index')}}">زیرگروهها</a>
                </li>
                <li class="active">
                    <strong>افزودن زیرگروه جدید</strong>
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
                    <form method="POST" id="form" action="{{ route('subgroup.store') }}" class="form-horizontal"
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
                            <label for="title" class="col-md-4 control-label">انتخاب گروه</label>
                            <div class="col-md-6">
                                <select id="title" type="text" class="form-control" name="group_id"
                                        required>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->title}}</option>
                                    @endforeach
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

@endsection
