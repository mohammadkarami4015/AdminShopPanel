@extends('layouts.admin')

@section('title')
    لیست سفارشات
@endsection

@section('users')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست سفارش</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li class="active">
                    <strong>لیست سفارشات</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-11">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h2> {{orderStatus($status)}}</h2>
                    </div>

                    <div class="searchListDiv">
                        <input onkeyup="search({{$status}})" class="form-control searchListInput" id="searchInput"
                               type="text"
                               placeholder=" جستجو بر اساس  نام کاربری ،آدرس و قیمت" name="data">
                    </div>


                    <div class="ibox-content table-responsive">
                        <form action="{{route('order.filterStatus',$shop)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="col-md-4">
                                    <select class="form-control" name="status" id="type" required>
                                        <option {{$status=='0' ? 'selected': ''}} selected value="0">همه سفارشات</option>
                                        <option {{$status=='1' ? 'selected': ''}} value="1">در انتظار تایید</option>
                                        <option {{$status=='2' ? 'selected': ''}} value="2">تایید شده</option>
                                        <option {{$status=='3' ? 'selected': ''}} value="3">ارسال شده</option>
                                        <option {{$status=='4' ? 'selected': ''}} value="4">تحویل داده شده</option>
                                        <option {{$status=='5' ? 'selected': ''}} value="5">لغو شده</option>
                                        <option {{$status=='6' ? 'selected': ''}} value="6">مرجوعی</option>
                                        <option {{$status=='7' ? 'selected': ''}} value="7">لغو توسط کاربر</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-danger">فیلتر</button>
                            </div>
                        </form>
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام کاربری</th>
                                <th>قیمت کل</th>
                                <th>آدرس</th>
                                <th>وضعیت سفارش</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{optional($order->user)->name}}</td>
                                    <td>{{$order->total_price}}</td>
                                    <td>{{$order->address}}</td>
                                    <td>{{orderStatus($order->order_status)}}</td>

                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                           href="{{ route('order.show',[$shop,$order]) }}">جزییات</a>
                                    </td>

                                    <td>
                                        <a class="btn btn-sm btn-info"
                                           href="{{ route('order.edit',[$shop,$order]) }}">ویرایش</a>
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{$orders->appends(Request::all())->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function search($statusId) {

            var value = $('#searchInput').val();
            $.get(`/shops/{{$shop->id}}/order/search`, {data: value, status: $statusId}, function (result) {
                $('#myTable').html(result)
            });
        }
    </script>

@endsection
