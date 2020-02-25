@extends('layouts.admin')

@section('title')
    {{$site_title}} لیست پرداخت وجه
@endsection

@section('clearing')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2> لیست پرداخت وجه</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>پرداخت وجه</a>
                </li>
                <li class="active">
                    <strong>لیست پرداخت وجه</strong>
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
                        <h5> لیست پرداخت وجه</h5>
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
                                <th>نوع پرداخت</th>
                                <th>شماره کارت / شبا</th>
                                <th>شماره درخواست</th>
                                <th>مبلغ</th>
                                <th>پرداخت کننده</th>
                                <th>تاریخ</th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($clearings as $clearing)
                                <tr>
                                    <td>{{$clearing->id}}</td>
                                    <td>@if($clearing->financial->user){{$clearing->financial->user->name}}@endif</td>
                                    <td>@if($clearing->type=="1"){{"شبا"}} @else {{ "کارت به کارت" }} @endif</td>
                                    <td>@if($clearing->type=="1"){{$clearing->sheba}} @else {{ $clearing->card_number }} @endif</td>
                                    <td>{{$clearing->payment_request_id}}</td>
                                    <td>{{$clearing->amount}}</td>
                                    <td>@if($clearing->user){{$clearing->user->name}}@endif</td>
                                    <td>{{jalaliFormat($clearing->created_at)}}</td>
                                @can('delete')
                                        <td>
                                            <form class="deleteForm" method="post" action="{{ route('clearing.destroy',['clearing'=>$clearing->id ]) }}">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-sm btn-danger" type="submit">حذف
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                    @can('update')
                                        <td>
                                            <a  class="btn btn-sm btn-info" href="{{ route('clearing.edit',['clearing'=>$clearing->id ]) }}">ویرایش</a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(!$flag)
                            <div class="text-center">
                                {{ $clearings->links() }}
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
            $.get(`/search/in/clearing/{value}`,{value:value}, function(result){
                console.log(result)
                $('#myTable').html(result)
            });
        })
    </script>
@endsection
