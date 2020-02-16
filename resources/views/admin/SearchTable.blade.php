@extends('layouts.admin')

@section('content')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>جستجو</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('admin.dashboard')}}">خانه</a>
                    </li>
                    <li>
                        <a>جستجو</a>
                    </li>
                    <li class="active">
                        <strong>کاربر و مشاور</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        @if(Gate::check('admin1') || Gate::check('admin2'))
            @if(count($users)>0)
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>کاربر</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#">گزینه 1</a>
                                            </li>
                                            <li><a href="#">گزینه 2</a>
                                            </li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content table-responsive">

                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نام</th>
                                            <th>نام خانوادگی</th>
                                            <th>تلفن </th>
                                            <th>وضعیت </th>
                                        </tr>
                                        </thead>
                                        <tbody id="myTable">
                                        @if($users != null)
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->last_name}}</td>
                                                    <td>{{$user->phone_number}}</td>
                                                    <td>
                                                        <div class="switch">
                                                            <label>
                                                                <input id="switchButton{{$user->id}}" onchange="activate({{$user->id}})" name="status" type="checkbox" @if($user->status=='on')checked @endif >
                                                                <span class="lever"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    @can('delete')
                                                        <td>
                                                            <form class="deleteForm" method="post" action="{{ route('user.destroy',['id'=>$user->id ]) }}">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                <button class="btn btn-sm btn-danger" type="submit">حذف
                                                                </button>
                                                            </form>
                                                        </td>
                                                    @endcan
                                                    @can('update')
                                                        <td>
                                                            <a id="pjax" class="btn btn-sm btn-info"  href="{{ route('user.edit',['id'=>$user->id ]) }}">ویرایش</a>
                                                        </td>
                                                    @endcan
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$user->id}}">
                                                            جزئیات
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalCenter{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">اطلاعات مشتری</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-10 col-md-offset-1">
                                                                                <div class="panel panel-default">
                                                                                    <div class="panel-heading"> اطلاعات مشتری</div>
                                                                                    <div class="list-group">
                                                                                        <a class="list-group-item">نام: {{$user->name}}</a>
                                                                                        <a class="list-group-item">نام خانوادگی: {{$user->last_name}}</a>
                                                                                        <a class="list-group-item">تلفن: {{$user->phone_number}}</a>
                                                                                        <a class="list-group-item">وضعیت: @if($user->status=='on'){{'فعال'}} @else {{'غیر فعال'}} @endif</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        @if(count($advisers)>0)
            @if(Gate::check('admin1')))
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5> مشاور</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#">گزینه 1</a>
                                            </li>
                                            <li><a href="#">گزینه 2</a>
                                            </li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content table-responsive">
                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>آدرس</th>
                                            <th>نام</th>
                                            <th>تلفن </th>
                                            <th>نوع </th>
                                            <th>وضعیت</th>
                                        </tr>
                                        </thead>
                                        <tbody id="myTable">
                                        @if($advisers != null)
                                            @foreach($advisers as $adviser)
                                                <tr>
                                                    <td>{{$adviser->id}}</td>
                                                    <td>@if($adviser->state_id!=null){{$adviser->city->title}}{{' , '}}{{$adviser->division->title}} @endif</td>
                                                    <td>{{$adviser->name}}{{' '}}{{$adviser->last_name}}</td>
                                                    <td>{{$adviser->phone_number}}</td>
                                                    <td>@if($adviser->type=='1'){{'بازدیدی'}} @else {{'تلفنی'}} @endif</td>
                                                    <td>
                                                        <div class="switch">
                                                            <label>
                                                                <input id="switchButton{{$adviser->id}}" onchange="activate({{$adviser->id}})" name="status" type="checkbox" @if($adviser->status=='on')checked @endif >
                                                                <span class="lever"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    </td>
                                                    @can('delete')
                                                        <td>
                                                            <form class="deleteForm" method="post" action="{{ route('adviser.destroy',['id'=>$adviser->id ]) }}">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                <button class="btn btn-sm btn-danger" type="submit">حذف
                                                                </button>
                                                            </form>
                                                        </td>
                                                    @endcan
                                                    @can('update')
                                                        <td>
                                                            <a id="pjax" class="btn btn-sm btn-info" href="{{ route('adviser.edit',['id'=>$adviser->id ]) }}">ویرایش</a>
                                                        </td>
                                                    @endcan
                                                    <td>
                                                        <a id="pjax" class="btn btn-sm btn-info" href="{{route('adviser.activities',['id'=>$adviser->id])}}" target="_blank">فعالیت ها</a>
                                                    </td>
                                                    <td>
                                                        <a id="pjax" class="btn btn-sm btn-info" href="{{route('adviser.suggestions',['id'=>$adviser->id])}}" target="_blank">املاک</a>
                                                    </td>
                                                    <td>
                                                        <a id="pjax" class="btn btn-sm btn-info" href="{{route('adviser.messages',['id'=>$adviser->id])}}" target="_blank">پیام ها</a>
                                                    </td>
                                                    @can('update')
                                                        <td>
                                                            <a class="btn btn-sm btn-info" href="{{ route('photos.addPhotosForm',['id'=>$adviser->id,'type'=>'adviser_photo' ]) }}" target="_blank">آپلود عکس</a>
                                                        </td>
                                                    @endcan
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$adviser->id}}">
                                                            جزئیات
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalCenter{{$adviser->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">اطلاعات مشاور</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-10 col-md-offset-1">
                                                                                <div class="panel panel-default">
                                                                                    <div class="panel-heading"> اطلاعات مشاور</div>
                                                                                    <div class="list-group">
                                                                                        <a class="list-group-item">نام: {{$adviser->name}}</a>
                                                                                        <a class="list-group-item">نام خانوادگی: {{$adviser->last_name}}</a>
                                                                                        <a class="list-group-item">تلفن: {{$adviser->phone_number}}</a>
                                                                                        <a class="list-group-item">شماره های دیگر: {{$adviser->other_phone_number}}</a>
                                                                                        <a class="list-group-item">ایمیل: {{$adviser->email}}</a>
                                                                                        <a class="list-group-item">سن: {{$adviser->old}}</a>
                                                                                        <a class="list-group-item">اینستاگرام: {{$adviser->instagram}}</a>
                                                                                        <a class="list-group-item">تلگرام: {{$adviser->telegram}}</a>
                                                                                        <a class="list-group-item">نوع: @if($adviser->type=='1'){{'مشاور بازدیدی'}} @else {{'مشاور تلفنی'}} @endif</a>
                                                                                        <a class="list-group-item">توضیحات: {{$adviser->description}}</a>
                                                                                        <a class="list-group-item">رزومه: {{$adviser->cv}}</a>
                                                                                        <a class="list-group-item">وضعیت: @if($adviser->status=='on'){{'فعال'}} @else {{'غیر فعال'}} @endif</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
@endsection
