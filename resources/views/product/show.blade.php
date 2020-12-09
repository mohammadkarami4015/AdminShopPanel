@extends('layouts.admin')

@section('title')

@endsection

@section('admins')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>جزيیات محصول </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a href="{{route('products.index')}}">محصول ها</a>
                </li>

            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">جزییات محصول</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">


                                    <div class="panel panel-default">
                                        <div style="font-size: 20px" class="panel-heading"> تصاویر محصول</div>


                                        <div id="myCarousel">

                                            @if($product->photos)

                                                <div>

                                                    @php
                                                        $photos=explode(';',$product->photos);
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

                                    <div class="panel panel-default">
                                        <div style="font-size: 25px" class="panel-heading"> اطلاعات محصول</div>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> عنوان
                                                : </label> {{$product->title}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> توضیحات
                                                : </label> {{$product->desc}}  </a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> گروه
                                                : </label>{{$product->group->title}} </a>
                                        <a class="list-group-item"><label style="font-size: 17px" for="">زیرگروه
                                                : </label> {{$product->subgroup->title}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px"
                                                                          for="">زیرشاخه: </label> {{optional($product->shopCategory)->title}}
                                        </a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> موجودی
                                                : </label>{{$product->inventory}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> قیمت
                                                : </label> {{$product->price}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> تخفیف
                                                : </label> {{$product->prict_with_discount}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> شرایط قسطی
                                                : </label> {{$product->installment_flag}}</a>

                                        <a class="list-group-item"><label style="font-size: 17px" for=""> امتیاز
                                                : </label> {{$product->rate}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> وضعیت
                                                : </label> {{$product->status=='on'? 'فعال' : 'غیر فعال'}}</a>
                                        <a class="list-group-item"><label style="font-size: 17px" for=""> وضعیت تایید
                                                : </label> {{ $product->admin_verification != null ?'تایید شده' :'در انتظار تایید'}}
                                        </a>

                                    </div>
                                    <div class="panel panel-default">
                                        <div style="font-size: 20px" class="panel-heading">ویژگی ها
                                        </div>

                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th> عنوان</th>
                                                <th>مقدار</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($features as $feature)
                                                @php
                                                                    $feature =explode(',',$feature)
                                                @endphp

                                                @if($feature)
                                                    <tr>
                                                        <td>{{$feature[0]}}</td>
                                                        <td>{{$feature[1]}}</td>

                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-offset-1">

                                    <a href="{{route('products.index')}}" type="button"
                                       class="btn btn-danger">بستن</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


