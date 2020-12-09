@extends('layouts.admin')

@section('title')

@endsection

@section('admins')
    active
@endsection

@section('content')
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">گزارش فروش </h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">

                                    <div class="panel panel-default">

                                        <div style="font-size: 25px" class="panel-heading">   میزان فروش ماه پیش</div>


                                        <a class="list-group-item"><label style="font-size: 17px" for="">{{$totalPrice}}

                                                 </label> </a>

                                    </div>


                                    <div class="panel panel-default">
                                        <div style="font-size: 20px" class="panel-heading">بیشترین فروش
                                        </div>

                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th>نام محصول</th>
                                                <th>تعداد فروش</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($counted_values as $id=>$count)


                                                @if($id)
                                                    <tr>
                                                        <td>{{optional(\App\Product::query()->find($id))->name}}</td>
                                                        <td>{{$count}}</td>

                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


