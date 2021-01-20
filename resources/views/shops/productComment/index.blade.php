@extends('layouts.admin')

@section('title')
    نظرات
@endsection

@section('users')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>نظرات</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a href="{{route('product.index',$shop)}}">محصول ها</a>
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
                        <h5>نظرات مربوط به {{$product->title}} </h5>
                    </div>

                    <div id="myTable" class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead style="font-size: 15px">
                            <tr>
                                <th>#</th>
                                <th>ارسال کننده</th>
                                <th>کامنت</th>
                                <th>وضعیت</th>
                                <th>نوع</th>

                            </tr>
                            </thead>

                            <tbody style="font-size: 15px">
                            @foreach($productComments as $comment)
                                <tr>
                                    <td>{{$comment->id}}</td>
                                    <td>
                                        {{$comment->replay_flag != 0 ?  $comment->shop->title  :  optional($comment->user)->name}}
                                    </td>
                                    <td>{{$comment->message}} </td>
                                    <td>
                                        <div class="switch">
                                            <label>
                                                <input id="switchButton{{$comment->id}}"
                                                       onchange="activate({{$comment->id}})"
                                                       name="status" type="checkbox"
                                                       @if($comment->admin_verification=='on')checked @endif >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{$comment->replay_flag == 0 ? 'دریافتی' : 'ارسالی'}} </td>
                                    <td>
                                        @if($comment->replay_flag == 0 && !$comment->child)
                                            <a class="btn btn-sm btn-info"
                                               href="{{route('productComment.create',[$shop,$product,$comment])}}">پاسخ</a>
                                        @else
                                            <p></p>
                                        @endif
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                                @if($comment->child)
                            <thead style="background: gainsboro;font-size: 10px">
                            <tr>

                                <td>{{$comment->child->id}}</td>
                                <td style="width: 10px">
                                    {{$comment->child->replay_flag == 'true' ?  optional($comment->shop)->title  :  optional($comment->user)->name}}
                                </td>
                                <td>{{$comment->child->message}} </td>
                                <td>
                                    <div class="switch">
                                        <label>
                                            <input id="switchButton{{$comment->child->id}}"
                                                   onchange="activate({{$comment->child->id}})"
                                                   name="status" type="checkbox"
                                                   @if($comment->child->admin_verification=='on')checked @endif >
                                            <span class="lever"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{$comment->child->replay_flag == 0 ? 'دریافتی' : 'ارسالی'}} </td>

                            </tr>
                            </thead>
                    @endif


                    @endforeach
                    </tbody>
                    </table>
                    <div class="text-center">
                        {{ $productComments->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function activate(id) {
            var switchButton = '#switchButton' + id;
            var value = $(switchButton).is(":checked") ? 'on' : 'off';
            console.log(value)
            $.get(`/shops/{{$shop->id}}/product/{{$product->id}}/productComment/verify/${id}/${value}`, function (result) {
            });
        }
    </script>
@endsection
