@extends('layouts.admin')

@section('title')
    {{$site_title}}لیست ثبت نام کنندگان اولیه
@endsection

@section('present')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست ثبت نام کنندگان اولیه</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>ارائه دوره</a>
                </li>
                <li class="active">
                    <strong>لیست ثبت نام کنندگان اولیه</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> لیست ثبت نام کنندگان اولیه</h5>
                    </div>
                    {{--<div style="display: flex;justify-content: center;flex-direction: row;background-color: white;">
                        <input style="margin-top: 10px;margin-bottom: 15px;margin-right: 5px;" class="form-control" id="searchInput" type="text" placeholder="جستجو بر اساس عنوان">
                        <button class="btn btn-primary btn-sm" style="margin-right: 5px;height: 33px;margin-top: 10px;margin-left: 5px;" id="search" >جستجو</button>
                    </div>--}}
                    <div id="myTable"  class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>دانشجو</th>
                                <th>زمان انتخابی</th>
                                <th>تاریخ ثبت</th>
                                @can('super_admin')<th>وضعیت پرداخت</th>@endcan
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($c_ses as $c_s)
                                <tr>
                                    <td>{{$c_s->id}}</td>
                                    <td>@if($c_s->user){{$c_s->user->name}}@endif</td>
                                    <td>{{$c_s->time}}</td>
                                    <td>{{jalaliFormat($c_s->created_at)}}</td>
                                    @can('super_admin')
                                    <td>
                                        <div class="switch">
                                            <label>
                                                <input id="switchButton{{$c_s->id}}" onchange="activate({{$c_s->id}})" name="payment" type="checkbox" @if($c_s->payment=='success')checked @endif >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                    @endcan
                                    @can('delete')
                                        <td>
                                            <form class="deleteForm" method="post" action="{{ route('submit.destroy',['submit'=>$c_s->id ]) }}">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-sm btn-danger" type="submit">حذف
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                    @can('update')
                                        <td>
                                            <a  class="btn btn-sm btn-info" href="{{ route('submit.edit',['submit'=>$c_s->id ]) }}">ویرایش</a>
                                        </td>
                                    @endcan
                                    @if(Gate::check('teacher') || Gate::check('super_admin'))
                                    <td>
                                        <a @if(in_array($c_s->user_id, $c_stes)) disabled @endif class="btn btn-sm btn-info" href="{{ route('student.storeTow',['id'=>$c_s->id ]) }}">افزودن به کلاس</a>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(!$flag)
                            <div class="text-center">
                                {{ $c_ses->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function activate(id) {
            var switchButton = '#switchButton' + id;
            var value =$(switchButton).is(":checked")?'on':'off';
            $.get(`/active/submit/${id}/${value}`,{id: id,value:value}, function(result){
                console.log(result)
            });
        }
       /* $('#search').on('click',function () {
            var value =$('#searchInput').val();
            $.get(`/search/in/submits/{value}`,{value:value}, function(result){
                console.log(result)
                $('#myTable').html(result)
            });
        })*/
    </script>
@endsection
