@extends('layouts.admin')

@section('title')
    لیست پرداختی ها
@endsection

@section('payment')
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
                <li>
                    <a href="">پرداختی ها</a>
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
                        <h5> لیست پرداختی ها</h5>
                    </div>

                    <div id="myTable" class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام فروشگاه</th>
                                <th>نام کاربر</th>
                                <th>مقدار پرداختی</th>
                                <th>کد پیگیری</th>
                                <th>نوع</th>
                                <th>وضغیت</th>
                                <th>تاریخ پرداخت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$payment->id}}</td>
                                    <td>{{optional($payment->shop)->title}}</td>
                                    <td>{{optional($payment->user)->name}}</td>
                                    <td>{{$payment->amount}}</td>
                                    <td>{{$payment->ref_code}}</td>
                                    <td>{{$payment->type}}</td>
                                    <td>{{$payment->status}}</td>
                                    <td>{{$payment->created_at}}</td>

                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                           href="">جزییات</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $payments->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
{{--    <script>--}}

    </script>

@endsection
