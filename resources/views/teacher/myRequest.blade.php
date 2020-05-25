@extends('layouts.admin')

@section('title')
      {{$site_title}}  | پروفایل
@endsection

@section('teacher')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>پروفایل</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li class="active">
                    <strong>پروفایل</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


    @can('teacher')
        <div class="container">
            <div class="row">
                <div class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5> لیست درخواست وجه من</h5>
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
                                @foreach($teacher->financials as $financial)
                                    <tr>
                                        <td>{{$financial->id}}</td>
                                        <td>@if($financial->user){{$financial->user->name}}@endif</td>
                                        <td>{{$financial->card_number}}</td>
                                        <td>{{$financial->sheba}}</td>
                                        <td>{{$financial->amount}}</td>
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

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a  class="btn btn-sm btn-success" href="{{ route('financial.create')}}">درخواست وجه</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endcan

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        $('#search').on('click',function () {
            var value =$('#searchInput').val();
            $.get(`/search/in/admins/{value}`,{value:value}, function(result){
                $('#myTable').html(result)
            });
        })
    </script>
@endsection
