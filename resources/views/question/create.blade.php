@extends('layouts.admin')

@section('title')
    {{$site_title}}  | افزودن سوال  جدید
@endsection

@section('test')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2> افزودن سوال  جدید به  {{$test->title." (".getTestType($test->type)." )"}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>آزمون ها</a>
                </li>
                <li class="active">
                    <strong>افزودن  سوال جدید</strong>
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
                    <form  method="POST" id="form" action="{{ route('question.store') }}" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label"> نوع</label>
                            <div class="col-md-6">
                                <select onchange="changeType(this)"  class="form-control" name="type" id="type">
                                    <option value="1">دو گزینه ای</option>
                                    <option value="2">چهار گزینه ای (دو انتخابی) </option>
                                    <option value="3">پنج گزینه ای</option>
                                    <option value="4">هشت نمره ای</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                            <label for="question" class="col-md-4 control-label">سوال</label>
                            <div class="col-md-6">
                                <textarea name="question" id="question" cols="66" rows="2">{{ old('question')}}</textarea>
                                <input id="test_id" type="hidden" class="form-control" name="test_id" value="{{$test->id}}" >
                            @if ($errors->has('question'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>





                        <div id="typeOne1" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }}">
                            <label for="answers" class="col-md-4 control-label">گزینه اول</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  >

                            @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]"  placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeOne2" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }}">
                            <label for="answers" class="col-md-4 control-label">گزینه دوم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]"  placeholder="ارزش"  >
                            </div>
                        </div>







                        <div id="typeTwo1" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه اول</label>
                            <div class="col-md-4">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]"  placeholder="ارزش"  >
                            </div>
                            <div class="col-md-2">
                                <input id="valuex[]" type="text" class="form-control" name="valuex[]"  placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeTwo2" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه دوم</label>
                            <div class="col-md-4">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]"  placeholder="ارزش"  >
                            </div>
                            <div class="col-md-2">
                                <input id="valuex[]" type="text" class="form-control" name="valuex[]"  placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeTwo3" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه سوم</label>
                            <div class="col-md-4">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]"  placeholder="ارزش"  >
                            </div>
                            <div class="col-md-2">
                                <input id="valuex[]" type="text" class="form-control" name="valuex[]"  placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeTwo4" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه چهارم</label>
                            <div class="col-md-4">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]"  placeholder="ارزش"  >
                            </div>
                            <div class="col-md-2">
                                <input id="valuex[]" type="text" class="form-control" name="valuex[]"  placeholder="ارزش"  >
                            </div>
                        </div>













                        <div id="typeThree1" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه اول</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]"  placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeThree2" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه دوم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]"  placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeThree3" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه سوم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]"  placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeThree4" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه چهارم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]"  placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeThree5" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه پنجم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]"  placeholder="ارزش"  >
                            </div>
                        </div>







                        <div id="typeFour1" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه اول</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]" value="یک"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]" value="1" placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeFour2" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه دوم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]" value="دو"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]" value="2" placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeFour3" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه سوم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]" value="سه"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]" value="3" placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeFour4" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه چهارم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]" value="چهار"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]" value="4" placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeFour5" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه پنجم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]" value="پنج"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]" value="5" placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeFour6" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه ششم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]" value="شش"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]" value="6" placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeFour7" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه هفتم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]" value="هفت"  >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]" value="7" placeholder="ارزش"  >
                            </div>
                        </div>
                        <div id="typeFour8" class="form-group{{ $errors->has('answers') ? ' has-error' : '' }} disNone">
                            <label for="answers" class="col-md-4 control-label">گزینه هشتم</label>
                            <div class="col-md-6">
                                <input id="answers[]" type="text" class="form-control" name="answers[]"  value="هشت" >
                                @if ($errors->has('answers'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input id="values[]" type="text" class="form-control" name="values[]" value="8" placeholder="ارزش"  >
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function changeType(that) {
            console.log(that.value)
            let typeOne1= $("#typeOne1")
            let typeOne2= $("#typeOne2")
            let typeTwo1= $("#typeTwo1")
            let typeTwo2= $("#typeTwo2")
            let typeTwo3= $("#typeTwo3")
            let typeTwo4= $("#typeTwo4")
            let typeThree1= $("#typeThree1")
            let typeThree2= $("#typeThree2")
            let typeThree3= $("#typeThree3")
            let typeThree4= $("#typeThree4")
            let typeThree5= $("#typeThree5")


            let typeFour1= $("#typeFour1")
            let typeFour2= $("#typeFour2")
            let typeFour3= $("#typeFour3")
            let typeFour4= $("#typeFour4")
            let typeFour5= $("#typeFour5")
            let typeFour6= $("#typeFour6")
            let typeFour7= $("#typeFour7")
            let typeFour8= $("#typeFour8")
            let value= that.value

            if(value==="3"){
                typeThree1.css('display','block')
                typeThree2.css('display','block')
                typeThree3.css('display','block')
                typeThree4.css('display','block')
                typeThree5.css('display','block')

                typeTwo1.css('display','none')
                typeTwo2.css('display','none')
                typeTwo3.css('display','none')
                typeTwo4.css('display','none')

                typeOne1.css('display','none')
                typeOne2.css('display','none')

                typeFour1.css('display','none')
                typeFour2.css('display','none')
                typeFour3.css('display','none')
                typeFour4.css('display','none')
                typeFour5.css('display','none')
                typeFour6.css('display','none')
                typeFour7.css('display','none')
                typeFour8.css('display','none')

            }
            if(value==="2"){
                typeTwo1.css('display','block')
                typeTwo2.css('display','block')
                typeTwo3.css('display','block')
                typeTwo4.css('display','block')

                typeThree1.css('display','none')
                typeThree2.css('display','none')
                typeThree3.css('display','none')
                typeThree4.css('display','none')
                typeThree5.css('display','none')

                typeFour1.css('display','none')
                typeFour2.css('display','none')
                typeFour3.css('display','none')
                typeFour4.css('display','none')
                typeFour5.css('display','none')
                typeFour6.css('display','none')
                typeFour7.css('display','none')
                typeFour8.css('display','none')

                typeOne1.css('display','none')
                typeOne2.css('display','none')
            }
            if(value==="1"){

                typeOne1.css('display','block')
                typeOne2.css('display','block')

                typeThree1.css('display','none')
                typeThree2.css('display','none')
                typeThree3.css('display','none')
                typeThree4.css('display','none')
                typeThree5.css('display','none')

                typeTwo1.css('display','none')
                typeTwo2.css('display','none')
                typeTwo3.css('display','none')
                typeTwo4.css('display','none')

                typeFour1.css('display','none')
                typeFour2.css('display','none')
                typeFour3.css('display','none')
                typeFour4.css('display','none')
                typeFour5.css('display','none')
                typeFour6.css('display','none')
                typeFour7.css('display','none')
                typeFour8.css('display','none')

            }

            if(value==="4"){

                typeOne1.css('display','none')
                typeOne2.css('display','none')

                typeThree1.css('display','none')
                typeThree2.css('display','none')
                typeThree3.css('display','none')
                typeThree4.css('display','none')
                typeThree5.css('display','none')

                typeTwo1.css('display','none')
                typeTwo2.css('display','none')
                typeTwo3.css('display','none')
                typeTwo4.css('display','none')

                typeFour1.css('display','block')
                typeFour2.css('display','block')
                typeFour3.css('display','block')
                typeFour4.css('display','block')
                typeFour5.css('display','block')
                typeFour6.css('display','block')
                typeFour7.css('display','block')
                typeFour8.css('display','block')

            }
        }
    </script>
@endsection
@section('footer')
    <script src="{!! asset('js/materialize.min.js') !!}"></script>
@endsection
