@extends('layouts.admin')

@section('title')
    | افزودن کد تخفیف
@endsection

@section('discount')
    active
@endsection


@section('header')
    <link href="{{asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">

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
            <h2>افزودن کد تخفیف</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a> </a>
                </li>
                <li class="active">
                    <strong>افزودن کد تخفیف</strong>
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
                    <form method="POST" id="form" action="{{ route('discount.store',$shop) }}" class="form-horizontal"
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
                            <label for="title" class="col-md-4 control-label">نوع</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="type"
                                       value="{{ old('type')}}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">درصد تخفیف</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="percent"
                                       value="{{ old('percent')}}">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"> زمان اعتبار</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="expire"
                                       id="solardate" placeholder="کلیک کنید"
                                       data-ha-datetimepicker="#solardate" data-ha-dp-issolar="true"
                                       data-ha-dp-resultinsolar="true" data-ha-dp-disabletime="true"
                                       data-ha-dp-resultformat="{year}/0{month}/{day}"
                                >

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"> حداکثر نرخ تخفیف</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="max_discount_price"
                                       value="{{ old('max_discount_price')}}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">تعداد استفاده</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="number_of_usage"
                                       value="{{ old('number_of_usage')}}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">تعداد استفاده برای هر کاربر</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="number_of_usage_for_user"
                                       value="{{ old('number_of_usage_for_user')}}">

                            </div>
                        </div>


                        <div class="form-group" >
                            <label class="col-md-4 control-label"> محصولات</label>
                            <div class="col-md-6">
                                <select class="form-control select2 select2-dropdown"
                                        data-placeholder="انتخاب محصولات"
                                         multiple name="products[]" id="type"    tabindex="-1" >

                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label"> محصولات به جز</label>
                            <div class="col-md-6">
                                <select data-placeholder="انتخاب محصولات" multiple class="form-control select2 select2-dropdown" name="except_products[]"  >

                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">دسته بندی ها</label>
                            <div class="col-md-6">
                                <select data-placeholder="انتخاب دسته بندی" class="form-control select2 select2-dropdown" multiple name="categories[]" id="type" >

                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">دسته بندی ها به جز</label>
                            <div class="col-md-6">
                                <select data-placeholder="انتخاب دسته بندی" class="form-control select2 select2-dropdown" multiple name="except_categories[]" id="type" >

                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
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
    <script src="{{asset('/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                dir: "rtl"
            });
            $('.Select2').val(null).trigger('change');
        });
    </script>
    <script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('src/ha-solardate.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('src/ha-datetimepicker.min.js') !!}"></script>
    <script>
        document.getElementById("solardate").addEventListener("click", function () {
            $(".ha-datetimepicker-container").css({top: -500});
        });
    </script>
@endsection
