@extends('layouts.admin')

@section('title')
    {{$site_title}}  | ویرایش آزمون
@endsection

@section('test')
    active
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
                                    <option value="1" @if($test->type=="1" ) selected @endif>1</option>
                                    <option value="2" @if($test->type=="2" ) selected @endif>2</option>
                                    <option value="3" @if($test->type=="3" ) selected @endif>3</option>
                                    <option value="4" @if($test->type=="4" ) selected @endif>4</option>
                                    <option value="5" @if($test->type=="5" ) selected @endif>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                            <label for="desc" class="col-md-4 control-label">توضیحات</label>
                            <div class="col-md-6">
                                <textarea name="desc" id="desc" cols="50" rows="10">{{ $test->desc }}</textarea>
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
    <script src="{!! asset('js/materialize.min.js') !!}"></script>
@endsection
