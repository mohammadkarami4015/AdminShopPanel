@extends('layouts.admin')

@section('title')
    | ویرایش محصول
@endsection

@section('product')
    active
@endsection


@section('header')
    <link href="{{asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <style>
        .note-editor .note-editable {
            background-color: #f8f8ffa1;
            border: 1px solid lightgray;
            border-top: 0 solid;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            min-height: 250px;
        }

        .note-editor .note-toolbar {
            border: 1px solid lightgray;
            border-bottom: 0 solid;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            padding-bottom: 15px;
            background-color: #1ab394;
        }
    </style>
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>ویرایش محصول </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a href="{{route('product.index',$shop)}}">محصول ها</a>
                </li>
                <li class="active">
                    <strong>ویرایش محصول </strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="row">
        <div
            class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <div class="ibox">
                <div class="ibox-content">
                    <form method="POST" id="form" action="{{ route('product.update',[$shop,$product]) }}"
                          class="form-horizontal"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">عنوان</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title"
                                       value="{{ $product->title}}" required>

                            </div>
                        </div>
                        <div class="form-group">

                            <div class="form-group">
                                <label for="type" class="col-md-4 control-label">زیر شاخه</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="shop_category_id" id="type" required>
                                        <option disabled selected>انتخاب زیر شاخه</option>
                                        @foreach($shopCategories as $value)
                                            <option
                                                {{ $product->shop_category_id == $value->id ? 'selected' : ''}} value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label">توضیحات</label>

                                <div class="col-md-6">
                                    <textarea name="desc" id="summernote" cols="50"
                                              rows="10">{{ $product->desc}}</textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">موجودی</label>
                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="inventory"
                                           value="{{ $product->inventory}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">قیمت</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price"
                                           value="{{ $product->price}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">قیمت با تخفیف</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price_with_discount"
                                           value="{{ $product->price_with_discount}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label"> اقساط </label>

                                <div class="col-md-6">
                                    <select id="price" type="text" class="form-control" name="installment_flag"
                                          required>
                                        <option {{$product->installment_flag == 'yes' ? 'selected' : ''}} value="yse">دارد</option>
                                        <option {{$product->installment_flag == 'no' ? 'selected' : ''}} value="no">ندارد</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">  پیش پرداخت </label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="installment"
                                           value="{{ $product->installment }}" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label"> وضعیت </label>

                                <div class="col-md-6">
                                    <select id="title" class="form-control" name="status">
                                        <option {{$product->status == 'on' ? 'selected' : '' }} value="on">فعال</option>
                                        <option {{$product->status == 'off' ? 'selected' : '' }} value="off"> غیر فعال
                                        </option>

                                    </select>

                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label for="title" class="col-md-4 control-label"> وضعیت تایید </label>

                                <div class="col-md-6">
                                    <select id="title" class="form-control" name="admin_verification">
                                        <option {{$product->admin_verification == 'on' ? 'selected' : '' }} value="on">تایید  </option>
                                        <option {{$product->admin_verification == 'off' ? 'selected' : '' }} value="off">  عدم تایید </option>

                                    </select>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        ویرایش
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 ">
                    <div class="ibox float-e-margins">
                        <h2> ویژگی ها</h2>
                        <div class="ibox-title">
                            <h3>افزودن ویژگی جدید </h3>
                            <form action="{{route('product.addFeatures',[$shop,$product])}}" method="POST">
                                @csrf
                                <div class="">
                                    <lable>
                                        عنوان
                                    </lable>
                                    <input name="title" type="text">
                                    <lable>
                                        مقدار
                                    </lable>
                                    <input name="amount" type="text">
                                    <button type="submit" class="btn-small btn-success "> افزودن</button>
                                </div>
                            </form>
                        </div>

                        <div class="ibox-content table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th> عنوان</th>
                                    <th>مقدار</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($features as $key=>$feature)
                                    @php
                                        $feature=explode(',',$feature);
                                    @endphp
                                    <tr>
                                        <td>{{$feature[0]}}</td>
                                        <td>{{$feature[1]}}</td>
                                        <td>
                                            <form class="deleteForm" method="post"
                                                  action="{{route('product.deleteFeatures',[$shop,$product])}}">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <input type="hidden" name="feature"
                                                       value="{{$feature[0]}},{{$feature[1]}}">

                                                <input type="hidden" name="key" value="{{$key}}">
                                                <button class="btn btn-sm btn-danger" type="submit">حذف
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12 ">
                    <div class="ibox float-e-margins">
                        <h2> عکس های این محصول</h2>
                        <div class="ibox-title">
                            <div class="">
                                <h3>افزودن عکس</h3>
                                <form action="{{route('product.add-photo',[$shop,$product])}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <input class="form-control" name="photos[]" multiple type="file">

                                        <button type="submit" style="margin: 15px" class="btn btn-success "> افزودن
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="ibox-content table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عکس</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($photos as $key=>$url)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td><img src="{{($url)}}"
                                                 alt="" style="width:30%;"></td>

                                        <td>
                                            <form class="deleteForm" method="post"
                                                  action="{{route('product.delete-photo',[$shop,$product])}}">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <input type="hidden" name="url" value="{{$url}}">
                                                <input type="hidden" name="key" value="{{$key}}">
                                                <button class="btn btn-sm btn-danger" type="submit">حذف
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('footer')
    <script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>
    <script>

    </script>
@endsection
