@extends('layouts.admin')

@section('title')
    {{$site_title}}درخواست وجه
@endsection

@section('financial')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2> درخواست وجه</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>درخواست وجه</a>
                </li>
                <li class="active">
                    <strong>درخواست وجه</strong>
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
                    <div class="panel-heading"> درخواست وجه </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('financial.store') }}" >
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label for="amount" class="col-md-4 control-label">مبلغ </label>
                                <div class="col-md-6" id="">
                                    <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" required autofocus>
                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                                <label for="card_number" class="col-md-4 control-label">شماره کارت</label>
                                <div class="col-md-6" id="">
                                    <input id="card_number" type="text" class="form-control" name="card_number" value="{{ old('card_number') }}" required >
                                    @if ($errors->has('card_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('card_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('sheba') ? ' has-error' : '' }}">
                                <label for="sheba" class="col-md-4 control-label">شماره شبا</label>
                                <div class="col-md-6" id="">
                                    <input id="sheba" type="text" class="form-control" name="sheba" value="{{ old('sheba') }}" required >
                                    @if ($errors->has('sheba'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sheba') }}</strong>
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
