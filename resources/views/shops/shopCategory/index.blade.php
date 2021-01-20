@extends('layouts.admin')

@section('title')
    لیست دسته بندی ها
@endsection

@section('shopCategory')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست دسته بندی ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a href="{{route('shopCategory.index',$shop)}}">دسته بندی ها</a>
                </li>
                <li class="active">
                    <strong>لیست دسته بندی ها</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div
                class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <div class="ibox float-e-margins">

                    <div >

                        <a href="{{route('shopCategory.create',$shop)}}" style="float: left;" class="btn btn-primary">دسته بندی جدید</a>
                    </div>
                    <div class="ibox-title">
                        <h5> لیست دسته بندی ها</h5>
                    </div>
                    <div class="searchListDiv">
                        <input onkeyup="Search({{$shop->id}})" class="form-control searchListInput" id="searchInput" type="text"
                               placeholder=" جستجو بر اساس  عنوان و نوع" name="data">

                    </div>
                    <div class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($shopCategories as $shopCategory)
                                <tr>
                                    <td>{{$shopCategory->id}}</td>
                                    <td>{{$shopCategory->title}}</td>
                                    <td>{{$shopCategory->status == 'on'? 'فعال' : 'غیرفعال'}}</td>

                                    <td>
                                        <a class="btn btn-sm btn-info"
                                           href="{{ route('shopCategory.edit',[$shop,$shopCategory]) }}">ویرایش</a>
                                    </td>


                                    <td>
                                        <form class="deleteForm" method="post"
                                              action="{{route('shopCategory.destroy',[$shop,$shopCategory])}}">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-sm btn-danger" type="submit"> حذف
                                            </button>
                                        </form>
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                            <div class="text-center">
                                {{$shopCategories->appends(Request::all())->links()}}
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        function Search(id) {
            var value = $('#searchInput').val();
            $.get(`/shops/${id}/shop-categories/search`, {data: value}, function (result) {
                $('#myTable').html(result)
            });
        }
    </script>
@endsection
