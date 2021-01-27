@extends('layouts.admin')

@section('title')

@endsection

@section('admins')
    active
@endsection

@section('content')
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-0">

                <div class="" role="document" >
                    <div class="modal-content">
                        <a style="float: left;margin: 5px" onclick="printPage()" class="btn btn-default">print</a>
                        <div class="modal-header" >
                            <h5 class="modal-title" id="exampleModalCenterTitle"> جزئیات سفارش شماره {{$order->id}}</h5>
                        </div>
                        <div class="modal-body" id="printPage">
                            <div class="row">
                                <div class="col-md-11 col-md-offset-1">
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

                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th>نام کاربری</th>
                                                <th>ایمیل</th>
                                                <th> شماره تماس</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr>
                                                <td>{{$order->user->name}}</td>
                                                <td>{{$order->user->eamil}}</td>
                                                <td>{{$order->user->phone_number}}</td>

                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="panel panel-default">
                                        <div style="font-size: 25px" class="panel-heading"> مشخصات سفارش</div>
                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th> قیمت کل</th>
                                                <th> هزینه ارسال</th>
                                                <th> مجموع پرداختی</th>
                                                <th> وضعیت</th>
                                                <th> زمان ارسال</th>
                                                <th> تاریخ ارسال</th>
                                                <th> فاکتور ارسال شود</th>
                                                <th> آدرس</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{$order->total_price}}</td>
                                                <td>{{$order->send_price}}</td>
                                                <td>{{$order->payed_price}}</td>
                                                <td>{{orderStatus($order->order_status)}}</td>
                                                <td>{{$order->send_time}}</td>
                                                <td>{{$order->send_data}}</td>
                                                <td> {{$order->facture_falg == true ? 'بله' : 'خیر'}}</td>
                                                <td> {{$order->address}}</td>

                                            </tr>

                                            </tbody>
                                        </table>

                                        <div style="font-size: 15px" class="panel-heading">توضیحات</div>
                                        <a class="list-group-item"><label style="font-size: 17px" for="">
                                            </label> {{$order->desc}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div style="margin: 10px">
                    <a class="btn btn-info" href="{{ route('order.edit',[$shop,$order]) }}">ویرایش</a>

                    <a style=";" href="{{ URL::previous() }}" class="btn btn-danger"
                       type="button">بستن</a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function printPage() {
            var value1 = document.getElementById('printPage').innerHTML;
            var value2 = document.body.innerHTML;
            document.body.innerHTML = value1;
            window.print()
            document.body.innerHTML = value2;
        }
    </script>
@endsection


