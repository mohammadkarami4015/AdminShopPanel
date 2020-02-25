@extends('layouts.admin')

@section('title')
    {{$site_title}}پرداخت ها
@endsection

@section('payment')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2> لیست پرداخت ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>پرداخت ها</a>
                </li>
                <li class="active">
                    <strong> لیست پرداخت ها</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> لیست پرداخت ها</h5>
                    </div>
                    <div style="display: flex;justify-content: center;flex-direction: row;background-color: white;">
                        <input style="margin-top: 10px;margin-bottom: 15px;margin-right: 5px;" class="form-control" id="searchInput" type="text" placeholder="جستجو بر اساس عنوان دوره یا نام کاربر یا عنوان تست یا مبلغ ">
                        <button class="btn btn-primary btn-sm" style="margin-right: 5px;height: 33px;margin-top: 10px;margin-left: 5px;" id="search" >جستجو</button>
                    </div>
                    <div id="myTable"  class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>کاربر</th>
                                <th>عنوان تست</th>
                                <th>نام دوره</th>
                                <th>مبلغ</th>
                                <th>مبلغ پرداخت شده</th>
                                <th>وضعیت پرداخت</th>
                                <th>تاریخ</th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($payments as $payment)
                                <tr class="@if($payment->status=='success') successPayment @else failedPayment @endif">
                                    <td>{{$payment->id}}</td>
                                    <td>@if($payment->user){{$payment->user->name}}@endif</td>
                                    <td>@if($payment->test){{$payment->test->title}}@endif</td>
                                    <td>@if($payment->presentCourse){{$payment->presentCourse->course->title}}@endif</td>
                                    <td>{{$payment->amount}}</td>
                                    <td>{{$payment->paid_amount}}</td>
                                    <td>@if($payment->status=='success'){{"پرداخت موفق"}} @else  {{'پرداخت ناموفق'}} @endif</td>
                                    <td>{{jalaliFormat($payment->created_at)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(!$flag)
                            <div class="text-center">
                                {{ $payments->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        $('#search').on('click',function () {
            var value =$('#searchInput').val();
            $.get(`/search/in/payments/{value}`,{value:value}, function(result){
                console.log(result)
                $('#myTable').html(result)
            });
        })
    </script>
@endsection
