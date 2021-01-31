@extends('layouts.admin')

@section('title')
    ویرایش نقش
@endsection

@section('roles')
    active
@endsection


@section('header')
    <link href="{{asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">
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
            <h2>ویرایش نقش </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">خانه</a>
                </li>
                <li>
                    <a href="{{route('role.index')}}">نقش ها</a>
                </li>
                <li class="active">
                    <strong>ویرایش نقش </strong>
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
                    <form method="POST" id="form" action="{{ route('role.update',$role) }}" class="form-horizontal"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">عنوان</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="name"
                                       value="{{ $role->name}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">توضیحات</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="label"
                                       value="{{ $role->label}}" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">دسترسی ها</label>
                            <div class="col-md-6">
                                <select class="form-control select2 select2-dropdown"
                                        data-placeholder="انتخاب دسترسی"
                                        multiple name="permissions[]" id="type" tabindex="-1">
                                    @foreach($permissions as $permission)
                                        <option
                                            {{ in_array ($permission->id , $role->permissions()->pluck('permission_id')->toArray()) ? 'selected' : '' }} value="{{$permission->id}}">{{$permission->label}}</option>
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
