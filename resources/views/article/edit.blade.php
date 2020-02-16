@extends('layouts.admin')

@section('title')
    {{$site_title}} ویرایش مقاله
@endsection

@section('articles')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>ویرایش مقاله</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>مقالات</a>
                </li>
                <li class="active">
                    <strong>ویرایش مقاله </strong>
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
                    <div class="panel-heading"> ویرایش مقاله  </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('articles.update',['article'=>$article->id]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PATCH')}}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">عنوان </label>
                                <div class="col-md-6" id="">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $article->title }}" required autofocus>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                                <label for="photo" class="col-md-4 control-label">عکس</label>

                                <div class="col-md-6">
                                    <input id="photo" type="file" class="form-control" name="photo" >
                                    @if ($errors->has('photo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                                <label for="desc" class="col-md-4 control-label">توضیحات  </label>
                                <div class="col-md-6" id="">
                                    <textarea id="desc" type="text" class="form-control" name="desc" rows="6" required >{{ $article->desc}}</textarea>
                                    @if ($errors->has('desc'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('desc') }}</strong>
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
