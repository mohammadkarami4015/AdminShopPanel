@extends('layouts.admin')

@section('title')
    | ویرایش فروشگاه
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
            <h2>ویرایش فروشگاه </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>

                <li class="active">
                    <strong><a href="{{route('shop.details',$shop)}}">بازگشت</a> </strong>
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
                    <form method="POST" id="form" action="{{ route('shop.update',$shop) }}"
                          class="form-horizontal"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">نام</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="name"
                                       value="{{ $shop->name}}" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">عنوان</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title"
                                       value="{{ $shop->title}}" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">ایمیل</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="email"
                                       value="{{ $shop->email}}" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">انتخاب گروه </label>
                            <div class="col-md-6">
                                <select class="form-control" name="group_id" id="type" >
                                    <option disabled selected>انتخاب گروه</option>
                                    @foreach($groups as $value)
                                        <option
                                            {{ $shop->group_id == $value->id ? 'selected' : ''}} value="{{$value->id}}">{{$value->title}}</option>
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
                                            {{ $shop->subgroup_id == $value->id ? 'selected' : ''}} value="{{$value->id}}">{{$value->title}}</option>
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
                                            {{ $shop->country_id == $value->id ? 'selected' : ''}} value="{{$value->id}}">{{$value->title}}</option>
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
                                            {{ $shop->city_id == $value->id ? 'selected' : ''}} value="{{$value->id}}">{{$value->title}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">اینستاگرام</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="instagram"
                                       value="{{ $shop->instagram}}" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">تلگرام</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="telegram"
                                       value="{{ $shop->telegram}}" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">واتس آپ</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="whatsup"
                                       value="{{ $shop->whatsup}}" >

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">توضیحات</label>

                            <div class="col-md-6">
                                    <textarea name="desc" id="summernote" cols="47"
                                              rows="5">{{ $shop->desc}}</textarea>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">شماره تلفن </label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="contact_phone"
                                       value="{{ $shop->contact_phone}}" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"> وضعیت </label>

                            <div class="col-md-6">
                                <select id="title" class="form-control" name="status">
                                    <option {{$shop->status == 'on' ? 'selected' : '' }} value="on">فعال</option>
                                    <option {{$shop->status == 'off' ? 'selected' : '' }} value="off"> غیر فعال</option>

                                </select>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"> آدرس </label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="address"
                                       value="{{ $shop->address}}" required>

                            </div>
                        </div>


                        <input type="hidden" value="{{$shop->lat}}" id="lat">
                        <input type="hidden" value="{{$shop->lng}}" id="lang">


                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"> حداقل هزینه سفارش </label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="min_order_price"
                                       value="{{ $shop->min_order_price}}" >

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    ویرایش
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="ibox float-e-margins">
                        <h2>مختصات روی نقشه</h2>
                        <div class="ibox-title">
                            <form action="{{route('shop.latLang',$shop)}}" method="POST">
                                @csrf
                                <div id="map"
                                     style="width: 300px;height: 300px;margin-right: 20%;border: solid 1px; "></div>
                                <div>
                                    <input type="hidden" id="lati" name="lat">
                                    <input type="hidden" id="lng" name="lng">
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-offset-0">
                                        <button type="submit" class="btn btn-primary" style="margin: 1%">
                                            ذخیره
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>


                <div class="col-md-10">
                    <div class="ibox float-e-margins">
                        <h2>هزینه های ارسال</h2>
                        <div class="ibox-title">
                            <h3>افزودن هزینه ارسال</h3>
                            <form action="{{route('shop.create-sendPrice',$shop)}}" method="POST">
                                @csrf
                                <div class="">
                                    <lable>
                                        مکان
                                    </lable>
                                    <input name="place" type="text">
                                    <lable>
                                        نرخ
                                    </lable>
                                    <input name="price" type="text">
                                    <button type="submit" class="btn-small btn-success "> افزودن</button>
                                </div>
                            </form>
                        </div>

                        <div class="ibox-content table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th> مکان</th>
                                    <th>نرخ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sendPrices as $key=>$sendPrice)
                                    @php
                                        $sendPrice=explode(',',$sendPrice);
                                    @endphp
                                    <tr>
                                        <td>{{$sendPrice[0]}}</td>
                                        <td>{{$sendPrice[1]}}</td>
                                        <td>
                                            <form class="deleteForm" method="post"
                                                  action="{{route('shop.delete-sendPrice',$shop)}}">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <input type="hidden" name="sendPrice"
                                                       value="{{$sendPrice[0]}},{{$sendPrice[1]}}">

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


                <div class="col-md-10">
                    <div class="ibox ">
                        <h2>ساعت کاری</h2>
                        <div class="ibox-title">
                            <h3>تغییر ساعات کاری</h3>
                            <form action="{{route('shop.workingHour',$shop)}}" method="POST">
                                @csrf
                                <div style="height: 150px">
                                    <select name="from" type="text" class="col-md-4" style="margin: 2%">
                                        <option value="شنبه">شنبه</option>
                                        <option value="یکشنبه">یکشنبه</option>
                                        <option value="دوشنبه">دوشنبه</option>
                                        <option value="سه شنبه">سه شنبه</option>
                                        <option value="چهار شنبه">چهار شنبه</option>
                                        <option value="پنج شنبه">پنج شنبه</option>
                                        <option value="جمعه">جمعه</option>
                                    </select>
                                    <select name="to" type="text" class="col-md-4" style="margin: 2%">
                                        <option value="شنبه">شنبه</option>
                                        <option value="یکشنبه">یکشنبه</option>
                                        <option value="دوشنبه">دوشنبه</option>
                                        <option value="سه شنبه">سه شنبه</option>
                                        <option value="چهار شنبه">چهار شنبه</option>
                                        <option value="پنج شنبه">پنج شنبه</option>
                                        <option value="جمعه">جمعه</option>
                                    </select>
                                    <br>
                                    <br>
                                    <input type="number" name="fromNumber" min="00" max="24"
                                           style="float:right; width: 33.5% ; margin: 2%">
                                    <input type="number" name="toNumber" min="00" max="24"
                                           style="float:right; width: 33.5% ;margin: 2%">

                                </div>
                                <button type="submit" class="btn btn-primary">بروزرسانی</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-md-10" style="padding: 0">
                <div class="ibox">
                    <h2> لوگو</h2>
                    <div class="ibox-title" style="height: 250px">
                        <h3>تغییر لوگوی فروشگاه</h3>
                        <form action="{{route('shop.add-logo',$shop)}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div style="float: left;margin-top: -10px">
                                <img src="/{{$shop->logo}}" width="200px" height="150px" style="border: solid 1px">
                            </div>
                            <div>
                                <h3>انتخاب لوگو</h3>
                                <input class="" name="logo" type="file">
                                <button type="submit" class="btn btn-success "> افزودن
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-10" style="padding: 0">
                <div class="ibox">
                    <h2> عکس های این فروشگاه</h2>
                    <div class="ibox-title">
                        <h3>تغییر عکس های فروشگاه</h3>

                        <h3>افزودن عکس</h3>
                        <form action="{{route('shop.add-photo',$shop)}}" method="POST"
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
                            <th style="width: 30%">عکس</th>
                            <th>نوع</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($photos as $key=>$url)
                            <tr>
                                <td>{{$key}}</td>
                                <td><img src="/{{($url)}}"
                                         alt="" style="width:60%;"></td>
                                <td style="color: blue">عکس فروشگاه</td>
                                <td>
                                    <form class="deleteForm" method="post"
                                          action="{{route('shop.delete-photo',$shop)}}">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <input type="hidden" name="url" value="{{$url}}">
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="type" value="photo">
                                        <button class="btn btn-sm btn-danger" type="submit">حذف
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        @if($shop->logo)
                            <tr>
                                <td>0</td>
                                <td><img src="/{{$shop->logo}}"
                                         alt="" style="width:60%;"></td>
                                <td style="color: green">لوگوی فروشگاه</td>
                                <td>
                                    <form class="deleteForm" method="post"
                                          action="{{route('shop.delete-photo',$shop)}}">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <input type="hidden" name="url" value="{{$shop->logo}}">
                                        <input type="hidden" name="key" value="{{0}}">
                                        <input type="hidden" name="type" value="logo">
                                        <button class="btn btn-sm btn-danger" type="submit">حذف
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <?php
    if ($shop->lat == null && $shop->lng == null) {

        $lat = 35.719856651629584;
        $lang = 51.41567146405578;
    }else{
        $lat = $shop->lat;
        $lang = $shop->lng;
    }
    ?>

@endsection
@section('footer')
    <script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>

    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([{{$lat}},{{$lang}}], 9);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const markerIcon = L.icon({
            iconSize: [25, 41],
            iconAnchor: [10, 41],
            popupAnchor: [2, -40],
            // specify the path here
            iconUrl: "https://unpkg.com/leaflet@1.5.1/dist/images/marker-icon.png",
            shadowUrl: "https://unpkg.com/leaflet@1.5.1/dist/images/marker-shadow.png"
        });

        L.marker([{{$lat}}, {{$lang}}],{
            draggable: true,
            title: "شما اینجا هستید",
            opacity: 0.5,
            icon: markerIcon
        }).addTo(map)

        map.setView([{{$lat}},{{$lang}}]);
        var popup = L.popup()
            .setLatLng([{{$lat}},{{$lang}}])
            .setContent("برای تغییر آدرس کلیک کنید")
            .openOn(map);
        map.on('click', function (e) {
            document.getElementById("lati").value = e.latlng.lat
            document.getElementById("lng").value = e.latlng.lng
            alert("در صورت اطمینان دکمه ذخیره را بزنید");
        });
    </script>

@endsection
