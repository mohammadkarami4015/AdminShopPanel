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
        <div class="col-md-10 col-md-offset-1 ">
            <div class="ibox">
                <div class="ibox-content">
                    <form  method="POST" id="form" action="{{ route('question.update',['question'=>$question->id ]) }}" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}
                        {{--<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label"> نوع</label>
                            <div class="col-md-6">
                                <select onchange="changeType(this)"  class="form-control" name="type" id="type">
                                    <option value="1" @if($question->type=="1") selected @endif>دو گزینه ای</option>
                                    <option value="2" @if($question->type=="2") selected @endif> چهار گزینه ای (دو انتخابی) </option>
                                    <option value="3" @if($question->type=="3") selected @endif>پنج گزینه ای</option>
                                    <option value="4" @if($question->type=="4") selected @endif>هشت نمره ای</option>
                                </select>
                            </div>
                        </div>--}}

                        <input id="test_id" type="hidden" class="form-control" name="test_id" value="{{$question->test_id}}" >

                        <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                            <label for="number" class="col-md-2 control-label">شماره سوال</label>
                            <div class="col-md-6">
                                <textarea name="number" id="number" cols="50" rows="2">{{ $question->number}}</textarea>
                                @if ($errors->has('number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                            <label for="question" class="col-md-2 control-label">سوال</label>
                            <div class="col-md-6">
                                <textarea name="question" id="question" cols="50" rows="2">{{ $question->question}}</textarea>
                                @if ($errors->has('question'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @foreach(explode(";",$question->answers) as $key => $answer)
                            <div id="typeOne1" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }}">
                                <label for="answers" class="col-md-2 control-label">گزینه {{$key+1}}</label>
                                <div class="col-md-5">
                                    <input id="answers[]" type="text" class="form-control" name="answers[]" value="{{$answer}}" >

                                    @if ($errors->has('answers'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <input id="values[]" type="text" class="form-control" name="values[]"  value="{{explode(";",$question->values)[$key]}}" placeholder="ارزش"  >
                                </div>
                                @if($question->type=="2")
                                    <div class="col-md-2">
                                        <input id="valuex[]" type="text" class="form-control" name="valuex[]" value="{{explode(";",$question->valuex)[$key]}}" placeholder="ارزش"  >
                                    </div>
                                @endif
                            </div>
                        @endforeach

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
