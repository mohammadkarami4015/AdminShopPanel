@extends('layouts.admin')

@section('title')
    {{$site_title}} ویرایش اطلاعات  ثبت نام کننده اولیه
@endsection

@section('present')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>ویرایش اطلاعات  ثبت نام کننده اولیه</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>ارائه دوره</a>
                </li>
                <li class="active">
                    <strong>ویرایش اطلاعات  ثبت نام کننده اولیه</strong>
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
                    <div class="panel-heading">ویرایش اطلاعات  ثبت نام کننده اولیه</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('submit.update',['submit'=>$c_s->id]) }}" >
                            {{ csrf_field() }}
                            {{method_field('PATCH')}}

                            <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                                <label for="time" class="col-md-4 control-label">	زمان انتخابی </label>
                                <div class="col-md-6" id="">
                                    <input  type="text" class="form-control" name="time"  value="{{$c_s->time}}" required >
                                    @if ($errors->has('time'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('time') }}</strong>
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
