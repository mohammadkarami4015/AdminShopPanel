@extends('layouts.admin')

@section('title')
    {{$site_title}} لیست درخواست وجه
@endsection

@section('financial')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2> لیست درخواست وجه</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>درخواست وجه</a>
                </li>
                <li class="active">
                    <strong>لیست درخواست وجه</strong>
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
                        <h5> لیست درخواست وجه</h5>
                    </div>
                    <div style="display: flex;justify-content: center;flex-direction: row;background-color: white;">
                        <input style="margin-top: 10px;margin-bottom: 15px;margin-right: 5px;" class="form-control" id="searchInput" type="text" placeholder="جستجو بر اساس عنوان">
                        <button class="btn btn-primary btn-sm" style="margin-right: 5px;height: 33px;margin-top: 10px;margin-left: 5px;" id="search" >جستجو</button>
                    </div>
                    <div id="myTable"  class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>شماره کارت</th>
                                <th>شماره شبا</th>
                                <th>مبلغ</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($financials as $financial)
                                <tr>
                                    <td>{{$financial->id}}</td>
                                    <td>@if($financial->user){{$financial->user->name}}@endif</td>
                                    <td>{{$financial->card_number}}</td>
                                    <td>{{$financial->sheba}}</td>
                                    <td>{{$financial->amount}}</td>
                                    @can('super_admin')
                                        @if($financial->status == null)
                                            <td>
                                                <a id="read_button{{$financial->id}}" onclick="read({{$financial->id}});" class="btn btn-sm btn-info">تایید کردن</a>
                                            </td>
                                        @endif
                                        @if($financial->status == "accepted")
                                            <td>
                                                <a class="btn btn-sm btn-white disabled">تایید شد</a>
                                            </td>
                                        @endif
                                    @endcan
                                    @can('teacher')
                                        <td>
                                            <a class="btn btn-sm btn-info disabled">@if($financial->status=="accepted"){{"تایید شده"}} @else {{'در انتظار'}} @endif</a>
                                        </td>
                                    @endcan
                                    @can('delete')
                                        <td>
                                            <form class="deleteForm" method="post" action="{{ route('financial.destroy',['financial'=>$financial->id ]) }}">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-sm btn-danger" type="submit">حذف
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                    @can('update')
                                        <td>
                                            <a  class="btn btn-sm btn-info" href="{{ route('financial.edit',['financial'=>$financial->id ]) }}">ویرایش</a>
                                        </td>
                                    @endcan
                                    @can('super_admin')
                                        <td>
                                            <a  class="btn btn-sm btn-info" href="{{ route('clearing.createTwo',['id'=>$financial->id ]) }}">پرداخت وجه</a>
                                        </td>
                                    @endcan

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(!$flag)
                            <div class="text-center">
                                {{ $financials->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function read(id) {
            var active_button = '#read_button' + id;
            $.get(`/confirm/financial/${id}`,{id: id}, function(result){
                if(result.status==="accepted"){
                    $(active_button).removeClass('btn-info').addClass('btn-default').html('تایید شده').addClass('disabled');
                }
            });
        }
        $('#search').on('click',function () {
            var value =$('#searchInput').val();
            $.get(`/search/in/articles/{value}`,{value:value}, function(result){
                console.log(result)
                $('#myTable').html(result)
            });
        })
    </script>
@endsection
