@extends('layouts.admin')

@section('title')
    لیست محصولات
@endsection

@section('users')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست محصولات</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>محصولات</a>
                </li>
                <li class="active">
                    <strong>لیست همه محصولات</strong>
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
                        <h5> لیست محصولات</h5>
                    </div>

                    <div class="searchListDiv">
                        <input onkeyup="Search()" class="form-control searchListInput" id="searchInput" type="text"
                               placeholder=" جستجو بر اساس  عنوان ،توضیحات و قیمت" name="data">

                    </div>

                    <div class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>نام فروشگاه</th>
                                <th>زیر دسته</th>
                                <th>موجودی</th>
                                <th>قیمت</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->title}}</td>
                                    <td>{{optional($product->shop)->title}}</td>
                                    <td>{{optional($product->shopCategory)->title}}</td>
                                    <td>{{$product->inventory}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->status=='on' ? 'فعال' : 'غیر فعال'}}</td>

                                    <td>
                                        <a class="btn btn-sm btn-info"
                                           href="{{ route('products.show',$product)}}"> جزئیات</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{$products->appends(Request::all())->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        function Search() {
            var value = $('#searchInput').val();
            $.get(`/products/search`, {data: value}, function (result) {
                $('#myTable').html(result)
            });
        }
    </script>

@endsection
