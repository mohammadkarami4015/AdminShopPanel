@extends('layouts.admin')

@section('title')
    لیست فروشگاه ها
@endsection

@section('shop')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست فروشگاه ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a> فروشگاه ها</a>
                </li>
                <li class="active">
                    <strong>لیست فروشگاه ها</strong>
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
                        <h5> لیست فروشگاه ها</h5>
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
                                <th> آدرس</th>
                                <th>شماره تماس</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($shops as $shop)
                                <tr>
                                    <td>{{$shop->id}}</td>
                                    <td>{{$shop->title}}</td>
                                    <td>{{$shop->address}}</td>
                                    <td>{{$shop->phone_number}}</td>
                                    <td>
                                        <div class="switch">
                                            <label>
                                                <input id="switchButton{{$shop->id}}" onchange="activate({{$shop->id}})"
                                                       name="status" type="checkbox"
                                                       @if($shop->admin_verification=='on')checked @endif >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>

                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{route('shop.details',$shop)}}">
                                            جزئیات</a>
                                    </td>

                                    <td>
                                        <form class="deleteForm" method="post"
                                              action="{{ route('shop.delete',$shop) }}">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-sm btn-danger" type="submit">حذف
                                            </button>
                                        </form>
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{$shops->appends(Request::all())->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        function activate(id) {
            var switchButton = '#switchButton' + id;
            var value = $(switchButton).is(":checked") ? 'on' : 'off';
            $.get(`/shops/activate/${id}/${value}`, function (result) {
            });
        }

        function Search() {
            var value = $('#searchInput').val();
            $.get(`/shops/search`, {data: value}, function (result) {
                $('#myTable').html(result)
            });
        }
    </script>

@endsection
