@extends('layouts.admin')

@section('title')
    {{$site_title}}  | پیام ها
@endsection

@section('messages')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>پیام ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>پیام ها</a>
                </li>
                <li class="active">
                    <strong>لیست پیام ها</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2  col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                    <div style="display: flex;justify-content: center;flex-direction: row;background-color: white;">
                        <input style="margin-top: 10px;margin-bottom: 15px;margin-right: 5px;" class="form-control" id="searchInput" type="text" placeholder="جستجو بر اساس نام مشتری">
                        <button class="btn btn-primary btn-sm" style="margin-right: 5px;height: 33px;margin-top: 10px;margin-left: 5px;" id="search" >جستجو</button>
                    </div>
                    <div id="myTable" class="ibox-content table-responsive">
                        <table class="table table-responsive" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام کاربر </th>
                                <th>عنوان </th>
                                <th>تلفن کاربر </th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($messages as $message)
                                <tr>
                                    <td>{{$message->id}}</td>
                                    <td>{{$message->name}}</td>
                                    <td>{{$message->title}}</td>
                                    <td>{{$message->phone_number}}</td>
                                    @if($message->read_at == null)
                                        <td>
                                            <a id="read_button{{$message->id}}" onclick="read({{$message->id}});" class="btn btn-sm btn-info">بررسی شد</a>
                                        </td>
                                    @endif
                                    @if($message->read_at !== null)
                                        <td>
                                            <a class="btn btn-sm btn-white disabled">بررسی شده</a>
                                        </td>
                                    @endif
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$message->id}}">
                                            جزئیات
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">جزئیات</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">جزئیات</div>
                                                                    <div class="list-group">
                                                                        <a class="list-group-item">نام کاربر: {{$message->name}}</a>
                                                                        <a class="list-group-item">عنوان: {{$message->title}}</a>
                                                                        <a class="list-group-item">تلفن کاربر: {{$message->phone_number}}</a>
                                                                        <a class="list-group-item">پیام: {{$message->message}}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(!$flag)
                            <div class="text-center">
                                {{ $messages->links() }}
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
            $.get(`/search/in/user/messages/{value}`,{value:value}, function(result){
                console.log(result)
                $('#myTable').html(result)
            });
        })
        function read(id) {
            var active_button = '#read_button' + id;
            $.get(`/read/message/${id}`,{id: id}, function(result){
                if(result.status==true){
                    $(active_button).removeClass('btn-info').addClass('btn-default').html('بررسی شده').addClass('disabled');

                }
            });
        }
    </script>
@endsection
