@extends('layouts.admin')

@section('title')
    | ثبت فروشگاه
@endsection

@section('product')
    active
@endsection


@section('header')
    <link href="{{asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css"/>
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
            <h2>ثبت فروشگاه </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
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
                    <form method="POST" id="form" action="{{ route('shop.store') }}"
                          class="form-horizontal"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">نام</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="name"
                                       value="{{ old('name')}}" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">عنوان</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title"
                                       value="{{ old('title')}}" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">ایمیل</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="email"
                                       value="{{ old('email')}}" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">انتخاب گروه </label>
                            <div class="col-md-6">
                                <select class="form-control" name="group_id" id="type" >
                                    <option disabled selected>انتخاب گروه</option>
                                    @foreach($groups as $value)
                                        <option
                                            value="{{$value->id}}">{{$value->title}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">انتخاب زیر گروه </label>
                            <div class="col-md-6">
                                <select class="form-control" name="subgroup_id" id="type" >
                                    <option disabled selected>انتخاب زیر گروه</option>
                                    @foreach($subGroups as $value)
                                        <option
                                            value="{{$value->id}}">{{$value->title}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">انتخاب کشور </label>
                            <div class="col-md-6">
                                <select class="form-control" name="country_id" id="type" >
                                    <option disabled selected>انتخاب کشور</option>
                                    @foreach($countries as $value)
                                        <option
                                            value="{{$value->id}}">{{$value->title}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">انتخاب شهر</label>
                            <div class="col-md-6">
                                <select class="form-control" name="city_id" id="type" >
                                    <option disabled selected>انتخاب شهر</option>
                                    @foreach($cities as $value)
                                        <option
                                            { value="{{$value->id}}">{{$value->title}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">اینستاگرام</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="instagram"
                                       value="{{ old('instagram')}}" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">تلگرام</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="telegram"
                                       value="{{ old('telegram')}}" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">واتس آپ</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="whatsup"
                                       value="{{ old('whatsup')}}" >

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">توضیحات</label>

                            <div class="col-md-6">
                                    <textarea name="desc" id="summernote" cols="47"
                                              rows="5">{{ old('desc')}}</textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">شماره همراه </label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="phone_number">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">شماره تلفن </label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="contact_phone"
                                       value="{{ old('contact_phone')}}" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"> وضعیت </label>

                            <div class="col-md-6">
                                <select id="title" class="form-control" name="status">
                                    <option  value="on">فعال</option>
                                    <option  value="off"> غیر فعال</option>

                                </select>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"> آدرس </label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="address"
                                       value="{{ old('address')}}" required>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"> حداقل هزینه سفارش </label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="min_order_price"
                                       value="{{ old('min_order_price')}}" >

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



@endsection
