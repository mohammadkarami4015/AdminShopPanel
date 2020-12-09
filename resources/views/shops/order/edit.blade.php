@extends('layouts.admin')

@section('title')
    | ویرایش سفارش
@endsection

@section('order')
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
            <h2>ویرایش سفارش </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard.index')}}">خانه</a>
                </li>
                <li>
                    <a href="{{route('order.index',$shop)}}">سفارش ها</a>
                </li>
                <li class="active">
                    <strong>ویرایش سفارش شماره {{$order->id}}</strong>
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
                    <form method="POST" id="form" action="{{ route('order.update',[$shop,$order]) }}"
                          class="form-horizontal"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}

                        <div class="form-group">
                            <label class="col-md-4 control-label"> وضعیت سفارش</label>
                            <div class="col-md-6">
                                <select class="form-control select2 select2-dropdown"
                                        data-placeholder="انتخاب " name="order_status" id="type">
                                    <option {{$order->order_status == 1 ? 'selected' : ''}} value="1">در انتظار تایید</option>
                                    <option {{$order->order_status == 2 ? 'selected' : ''}} value="2">تایید شد</option>
                                    <option {{$order->order_status == 3 ? 'selected' : ''}} value="3">ارسال شد</option>
                                    <option {{$order->order_status == 4 ? 'selected' : ''}} value="4">تحویل داده شد</option>
                                    <option {{$order->order_status == 5 ? 'selected' : ''}} value="5">لغو شد</option>
                                    <option {{$order->order_status == 6 ? 'selected' : ''}} value="6">مرجوعی</option>
                                    <option {{$order->order_status == 7 ? 'selected' : ''}} value="7">لغو توسط کاربر</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-md-4 control-label">هزینه ارسال</label>
                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="send_price"
                                       value="{{ $order->send_price}}" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="price" class="col-md-4 control-label">آدرس</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="address"
                                       value="{{ $order->address}}" required>
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
    <script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>

@endsection
