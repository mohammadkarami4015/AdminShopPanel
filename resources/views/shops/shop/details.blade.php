@extends('layouts.admin')

@section('title')
    فروشگاه
@endsection

@section('shop')
    active
@endsection

@section('header')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css"/>

@endsection

@section('content')
    {{--    <div style="background: red;margin-right: 19%; height: 100px ;width: 69%"  >--}}
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card-group" style="float:right;margin: 12px">
                    <a href="{{route('product.index',$shop)}}" class="btn btn-dark"> محصولات</a>
                </div>

                <div class="card-group" style="float:right;margin: 12px">
                    <a href="{{route('shopCategory.index',$shop)}}" class="btn btn-dark"> دسته بندی ها</a>
                </div>

                <div class="card-group" style="float:right;margin: 12px">
                    <a href="{{route('order.index',$shop)}}" class="btn btn-dark"> سفارشات</a>
                </div>

                <div class="card-group" style="float:right;margin: 12px">
                    <a href="{{route('discount.index',$shop)}}" class="btn btn-dark"> کدهای تخفیف</a>
                </div>

                <div class="card-group" style="float:right;margin: 12px">
                    <a href="{{route('ShopPayment.index',$shop)}}" class="btn btn-dark"> پرداختی ها </a>
                </div>

                <div class="card-group" style="float:right;margin: 12px">
                    <a  href="{{route('shopMessage.index',$shop)}}" class="btn btn-dark"> پیام ها </a>
                </div>
                <div class="card-group" style="float:right;margin: 12px">
                    <a class="btn btn-dark"> گزارش ها </a>
                </div>
            </div>
        </div>
    </div>
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalCenterTitle">فروشگاه {{$shop->name}}</h2>
                        </div>


                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">

                                    <div class="panel panel-default">
                                        <div class="panel panel-default">
                                            <div style="font-size: 20px" class="panel-heading"> آدرس فروشگاه</div>
                                            <div id="map" style="width: 550px;height: 400px;margin-right: 8px"></div>


                                        </div>

                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel panel-default">
                                            <div style="font-size: 20px" class="panel-heading"> تصاویر فروشگاه</div>


                                            <div id="myCarousel">

                                                @if($shop->photos)

                                                    <div>

                                                        @php
                                                            $photos=explode(';',$shop->photos);
                                                        @endphp
                                                        <div class="item  active ">
                                                            @foreach($photos as $photo)
                                                                <img src="/{{$photo}}" width="45%">
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                @endif
                                            </div>

                                        </div>


                                        <div id="myCarousel" class="carousel slide" data-ride="carousel">

                                            <div class="carousel-inner">
                                                <div class="item  active ">
                                                    <img src="" alt="" style="width:100%;">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    @if($shop)
                                        <div class="panel panel-default">
                                            <div style="font-size: 20px" class="panel-heading"> عنوان فروشگاه
                                                : {{$shop->title}}</div>
                                            <div class="list-group">
                                                <a class="list-group-item"> <label style="font-size: 17px" for="">نام
                                                        : </label>
                                                    {{$shop->name}}  </a>
                                                <a class="list-group-item"><label style="font-size: 17px" for=""> ایمیل
                                                        : </label> {{$shop->email}}</a>
                                                <a class="list-group-item"><label style="font-size: 17px" for=""> تاریخ
                                                        اعتبار : </label> {{$shop->credit}}  </a>
                                                <a class="list-group-item"><label style="font-size: 17px" for="">
                                                        توضیحات
                                                        : </label> {{$shop->desc}}  </a>
                                                <a class="list-group-item"><label style="font-size: 17px" for="">اینستاگرام
                                                        : </label> {{$shop->instagram}}</a>
                                                <a class="list-group-item"><label style="font-size: 17px" for="">تلگرام
                                                        : </label> {{$shop->telegram}}</a>
                                                <a class="list-group-item"><label style="font-size: 17px" for=""> واتس
                                                        آپ
                                                        : </label> {{$shop->whatsup}}</a>
                                                <a class="list-group-item"><label style="font-size: 17px" for=""> ساعت
                                                        کاری
                                                        :</label> {{$shop->working_hours}} </a>
                                                <a class="list-group-item"><label style="font-size: 17px" for=""> شماره
                                                        تماس
                                                        : </label>{{$shop->contact_phone}}  </a>
                                                <a class="list-group-item"><label style="font-size: 17px" for=""> دسته
                                                        بندی
                                                        : </label> {{optional($shop->group)->title}} </a>
                                                <a class="list-group-item"><label style="font-size: 17px" for=""> شاخه
                                                        : </label> {{optional($shop->subgroup)->title}}  </a>
                                                <a class="list-group-item"><label style="font-size: 17px" for=""> شهر
                                                        : </label> {{optional($shop->city)->title}}</a>
                                                <a class="list-group-item"><label style="font-size: 17px" for="">آدرس
                                                        : </label>{{$shop->address}} </a>

                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div style="font-size: 20px" class="panel-heading"> هزینه های ارسال
                                            </div>

                                            <div class="ibox-content table-responsive">
                                                <table class="table table-responsive">
                                                    <thead>
                                                    <tr>
                                                        <th class="font-bold">آدرس</th>
                                                        <th> قیمت</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($sendPrices as $sendPrice)

                                                        @php
                                                            $sendPrice=explode(',',$sendPrice);
                                                        @endphp
                                                        <tr>
                                                            <td>{{$sendPrice[0]}}</td>
                                                            <td>{{$sendPrice[1]}}</td>
                                                        </tr>

                                                    @endforeach


                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-offset-1">
                                                <a class="btn btn-info"
                                                   href="{{ route('shop.edit',$shop)}}"> ویرایش</a>

                                            </div>
                                        </div>
                                </div>

                            </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($shop->lat == null && $shop->lng == null) {

            $lat = "35.719856651629584";
            $lang = "51.41567146405578";
        } else {
            $lat = $shop->lat;
            $lang = $shop->lng;
        }
        ?>


        @endsection
        @section('footer')
            <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

            <script>

                var map = L.map('map').setView([{{$lat}}, {{$lang}}], 9);

                const markerIcon = L.icon({
                    iconSize: [25, 41],
                    iconAnchor: [10, 41],
                    popupAnchor: [2, -40],
                    // specify the path here
                    iconUrl: "https://unpkg.com/leaflet@1.5.1/dist/images/marker-icon.png",
                    shadowUrl: "https://unpkg.com/leaflet@1.5.1/dist/images/marker-shadow.png"
                });


                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([{{$lat}}, {{$lang}}],{
                    draggable: true,
                    title: "شما اینجا هستید",
                    opacity: 0.5,
                    icon: markerIcon
                }).addTo(map)





                map.setView([{{$lat}},{{$lang}}]);


            </script>

@endsection

