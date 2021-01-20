@extends('layouts.admin')

@section('title')

@endsection

@section('discount')
    active
@endsection

@section('content')
    <div class="row wrapper border white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a href="{{route('discount.index',$shop)}}">کدهای تخفیف</a>
                </li>
                <li class="active">
                    <strong>لیست کدهای تخفیف</strong>
                </li>
            </ol>
        </div>
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle"> جزئیات کد تخفیف {{$discount->id}}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">

                                    <div class="panel panel-default">
                                        <div style="font-size: 25px" class="panel-heading"> مشخصات کد تخفیف</div>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> عنوان
                                                : </label> {{$discount->title}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> کد
                                                : </label> {{$discount->code}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> نوع
                                                : </label> {{$discount->type}}  </a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> درصد تخفیف
                                                : </label> {{$discount->percent}}  </a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> تعداد استفاده
                                                : </label> {{$discount->number_of_usage}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for="">تعداد استفاده
                                                توسط هر کاربر
                                                سفارش: </label> {{$discount->number_of_usage_for_user}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> تاریخ پایان
                                                اعتبار
                                                : </label> {{$discount->expire}}</a>
                                    </div>


                                    <div class="panel panel-default">
                                        <div style="font-size: 20px" class="panel-heading"> لیست محصولات این کد تخفیف
                                        </div>

                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th>کد محصول</th>
                                                <th>نام محصول</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($products as $id)
                                                @php
                                                    $product =\App\Product::query()->find($id)
                                                @endphp

                                                @if($product)
                                                    <tr>
                                                        <td>{{$product->id}}</td>
                                                        <td>
                                                            <a href="{{route('product.show',[$shop,$product])}}">{{$product->title}}</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="panel panel-default">
                                        <div style="font-size: 20px" class="panel-heading"> لیست محصولاتی که شامل تخقیف نمی شوند
                                        </div>

                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th>کد محصول</th>
                                                <th>نام محصول</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($exceptProducts as $id)
                                                @php
                                                    $product =\App\Product::query()->find($id)
                                                @endphp
                                                @if($product)
                                                    <tr>
                                                        <td>{{$product->id}}</td>
                                                        <td>
                                                            <a href="{{route('product.show',[$shop,$product])}}">{{$product->title}}</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="panel panel-default">
                                        <div style="font-size: 20px" class="panel-heading"> لیست دسته بندی محصولات این کد تخفیف
                                        </div>

                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th>کد محصول</th>
                                                <th>نام محصول</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($categories as $id)
                                                @php
                                                    $category =\App\ShopCategory::query()->find($id)
                                                @endphp

                                                @if($category)
                                                    <tr>
                                                        <td>{{$category->id}}</td>
                                                        <td>
                                                            <a >{{$category->title}}</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="panel panel-default">
                                        <div style="font-size: 20px" class="panel-heading"> لیست دسته بندی محصولاتی که شامل این کد تخفیف نمیشوند
                                        </div>

                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th>کد محصول</th>
                                                <th>نام محصول</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($exceptCategories as $id)
                                                @php
                                                    $category =\App\ShopCategory::query()->find($id)
                                                @endphp

                                                @if($category)
                                                    <tr>
                                                        <td>{{$category->id}}</td>
                                                        <td>
                                                            <a >{{$category->title}}</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <a class="btn btn-info" href="{{ route('discount.edit',[$shop,$discount]) }}">ویرایش</a>

                                    <a style=";" href="{{route('discount.index',$shop)}}" class="btn btn-danger"
                                       type="button">بستن</a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
