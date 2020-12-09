@extends('layouts.admin')

@section('title')
    | افزودن محصول جدید
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
            <h2>افزودن محصول جدید</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>محصول ها</a>
                </li>
                <li class="active">
                    <strong>افزودن محصول جدید</strong>
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
                    <form method="POST" id="form" action="{{ route('product.store',$shop) }}" class="form-horizontal"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">عنوان</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title"
                                       value="{{ old('title')}}" required>

                            </div>
                        </div>
                        <div class="form-group">

                            <div class="form-group" >
                                <label for="type" class="col-md-4 control-label">زیر شاخه</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="shop_category_id" id="type" required>
                                        <option disabled selected>انتخاب زیر شاخه</option>
                                        @foreach($shopCategories as $value)
                                            <option value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label">توضیحات</label>

                                <div class="col-md-6">
                                    <textarea name="desc" id="summernote" cols="50"
                                              rows="10">{{ old('desc')}}</textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">موجودی</label>
                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="inventory"
                                           value="{{ old('price')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">قیمت</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price"
                                           value="{{ old('price')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">قیمت با تخفیف</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price_with_discount"
                                           value="{{ old('price_with_discount')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label"> اقساط </label>

                                <div class="col-md-6">
                                    <select id="price" type="text" class="form-control" name="installment_flag"
                                            value="{{ old('installment_flag')}}" required>
                                        <option value="yse">دارد</option>
                                        <option value="no">ندارد</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">  شرایط اقساط</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="installment"
                                           value="{{ old('installment')}}" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="photo" class="col-md-4 control-label">عکس</label>

                                <div class="col-md-6">
                                    <input id="photo" type="file" multiple class="form-control" name="photos[]"
                                           value="{{ old('photos')}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        ثبت
                                    </button>
                                </div>
                            </div>
                    </form>
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
