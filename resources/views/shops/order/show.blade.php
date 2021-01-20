@extends('layouts.admin')

@section('title')

@endsection

@section('orders')
    active
@endsection

@section('content')
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle"> جزئیات سفارش شماره {{$order->id}}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">


                                    <div class="panel panel-default">
                                        <div style="font-size: 20px" class="panel-heading"> محصولات سفارشی</div>

                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th>کد محصول</th>
                                                <th>نام محصول</th>
                                                <th>تعداد سفارش</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orderProducts as $product)
                                                <tr>
                                                    <td>{{$product->id}}</td>
                                                    <td>
                                                        <a href="{{route('product.show',[$shop,$product])}}">{{$product->title}}</a>
                                                    </td>
                                                    <td>{{$product->count}} عدد</td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                        <div id="myCarousel" class="carousel slide" data-ride="carousel">

                                            <div class="carousel-inner">
                                                <div class="item  active ">
                                                    <img src="" alt="" style="width:100%;">
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="panel panel-default">
                                        <div style="font-size: 20px" class="panel-heading"> مشخصات کاربری</div>
                                        <div class="list-group">
                                            <a class="list-group-item"> <label style="font-size: 17px" for="">نام کاربری
                                                    : </label>{{$order->user->name}}</a>
                                            <a class="list-group-item"> <label style="font-size: 17px" for="">ایمیل
                                                    : </label>{{$order->user->email}}</a>
                                            <a class="list-group-item"> <label style="font-size: 17px" for="">شماره تماس
                                                    : </label>{{$order->user->phone_number}}</a>
                                            <a class="list-group-item"> <label style="font-size: 17px" for="">آدرس
                                                    : </label>{{$order->user->addresses}}</a>
                                        </div>

                                        <div style="font-size: 25px" class="panel-heading"> مشخصات سفارش</div>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> توضیحات
                                                : </label> {{$order->desc}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> قیمت کل
                                                : </label> {{$order->total_price}}  </a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> هزینه ارسال
                                                : </label> {{$order->send_price}}  </a>
                                        <a class="list-group-item"><label style="font-size: 17px" for="">مجموع پرداختی
                                                : </label> {{$order->payed_price}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for="">وضعیت
                                                سفارش: </label> {{orderStatus($order->order_status)}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> وضعیت پرداختی
                                                : </label> {{$order->payment_flag}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> آدرس
                                                : </label> {{$order->address}}</a>

                                    </div>
                                    <a class="btn btn-info" href="{{ route('order.edit',[$shop,$order]) }}">ویرایش</a>

                                    <a style=";" href="{{ URL::previous() }}" class="btn btn-danger" type="button">بستن</a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


