@extends('layouts.admin')

@section('title')
    {{$site_title}}  | ویرایش سوال
@endsection

@section('test')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>ویرایش سوال</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>آزمون ها</a>
                </li>
                <li class="active">
                    <strong>ویرایش سوال  </strong>
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
                    <form  method="POST" id="form" action="{{ route('question.update',['question'=>$question->id ]) }}" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">عنوان</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $question->title}}" required >
                                <input id="test_id" type="hidden" class="form-control" name="test_id" value="{{$question->test_id}}" required >
                            @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                            <label for="question" class="col-md-4 control-label">سوال</label>
                            <div class="col-md-6">
                                <textarea name="question" id="question" cols="50" rows="5">{{ $question->question}}</textarea>
                                @if ($errors->has('question'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('answer1') ? ' has-error' : '' }}">
                            <label for="answer1" class="col-md-4 control-label">گزینه اول</label>
                            <div class="col-md-6">
                                <textarea name="answer1" id="answer1" cols="50" rows="5">{{ $question->answer1}}</textarea>
                                @if ($errors->has('answer1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('answer2') ? ' has-error' : '' }}">
                            <label for="answer2" class="col-md-4 control-label">گزینه دوم</label>
                            <div class="col-md-6">
                                <textarea name="answer2" id="answer2" cols="50" rows="5">{{ $question->answer2}}</textarea>
                                @if ($errors->has('answer2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('answer3') ? ' has-error' : '' }}">
                            <label for="answer3" class="col-md-4 control-label">گزینه سوم</label>
                            <div class="col-md-6">
                                <textarea name="answer3" id="answer3" cols="50" rows="5">{{ $question->answer3}}</textarea>
                                @if ($errors->has('answer3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('answer4') ? ' has-error' : '' }}">
                            <label for="answer4" class="col-md-4 control-label">گزینه چهارم</label>
                            <div class="col-md-6">
                                <textarea name="answer4" id="answer4" cols="50" rows="5">{{ $question->answer4}}</textarea>
                                @if ($errors->has('answer4'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer4') }}</strong>
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
