@extends('layouts.admin')

@section('title')
    {{$site_title}} ویرایش پرداخت وجه
@endsection

@section('clearing')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>ویرایش پرداخت وجه</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>پرداخت وجه</a>
                </li>
                <li class="active">
                    <strong>پرداخت درخواست وجه </strong>
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
                    <div class="panel-heading"> ویرایش پرداخت وجه  </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('clearing.update',['clearing'=>$clearing->id]) }}" >
                            {{ csrf_field() }}
                            {{method_field('PATCH')}}
                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label for="amount" class="col-md-4 control-label">مبلغ </label>
                                <div class="col-md-6" id="">
                                    <input id="amount" type="text" class="form-control" name="amount" value="{{ $clearing->amount }}" required autofocus>
                                    <input id="payment_request_id" type="hidden" class="form-control" name="payment_request_id" value="{{ $clearing->payment_request_id }}" required>
                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label"> نوع پرداخت</label>
                                <div class="col-md-6">
                                    <select onchange="changeType(this)"  class="form-control" name="type" id="type" required>
                                        <option disabled selected>انتخاب نوع</option>
                                        <option value="1" @if($clearing->type=="1") selected @endif>شبا</option>
                                        <option value="2" @if($clearing->type=="2") selected @endif>کارت به کارت</option>
                                    </select>
                                </div>
                            </div>

                            <div id="card" class="@if($clearing->type=="1") disNone  @endif form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                                <label for="card_number" class="col-md-4 control-label">شماره کارت</label>
                                <div class="col-md-6" id="">
                                    <input id="card_number" type="text" class="form-control" name="card_number" value="{{ $clearing->card_number}}"  >
                                    @if ($errors->has('card_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('card_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div id="sheba" class="@if($clearing->type=="2") disNone  @endif form-group{{ $errors->has('sheba') ? ' has-error' : '' }}">
                                <label for="sheba" class="col-md-4 control-label">شماره شبا</label>
                                <div class="col-md-6" id="">
                                    <input id="sheba" type="text" class="form-control" name="sheba" value="{{ $clearing->sheba}}"  >
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function changeType(that) {
            console.log(that.value)
            let card= $("#card")
            let sheba= $("#sheba")
            let value= that.value
            if(value==="2"){
                card.css('display','block')
                sheba.css('display','none')
            }
            if(value==="1"){
                sheba.css('display','block')
                card.css('display','none')
            }
        }
    </script>
@endsection
