@extends('layouts.admin')

@section('title')
    پیام ها
@endsection

@section('messages')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2> پیام ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li class="active">
                    <a href="{{route('shopMessage.index',$shop)}}"><strong>پیام ها</strong></a>
                </li>
            </ol>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="ibox float-e-margins">
                    <div>
                        <a href="{{route('shopMessage.create',$shop)}}" style="float: left;" class="btn btn-primary">افزودن
                            پیام </a>
                    </div>

                    <div id="myTable" class="m-2 ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان پیام</th>
                                <th>متن پیام</th>
                                <th>نوع پیام</th>
                                <th>وضعیت پیام</th>
                            </tr>
                            </thead>

                            @foreach($messages as $message)

                                <tbody>
                                <tr>
                                    <td>{{$message->id}}</td>
                                    <td>{{$message->title}}</td>
                                    <td>{{$message->message}} </td>
                                    <td>{{$message->type == 'shop' ? 'ارسالی' : 'دریافتی'}} </td>
                                    <td>{{$message->read_at == '' ? 'هنوز خوانده نشده ' : 'خوانده شد'}} </td>
                                </tr>

                                </tbody>
                            @endforeach

                        </table>
                        <div class="text-center">
                            {{ $messages->links()}}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
