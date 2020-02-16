@extends('layouts.admin')

@section('title')
      {{$site_title}}  | لیست مدیران
@endsection

@section('admins')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست مدیران</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>مدیران</a>
                </li>
                <li class="active">
                    <strong>لیست مدیران</strong>
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
                        <h5> لیست مدیران</h5>
                    </div>
                    <div class="searchListDiv">
                        <input class="form-control searchListInput" id="searchInput" type="text" placeholder="جستجو بر اساس شماره تلفن">
                        <button class="btn btn-primary btn-sm searchListBtn" id="search" >جستجو</button>
                    </div>
                    <div id="myTable" class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>ایمیل </th>
                                <th>تلفن </th>
                                <th>وضعیت </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{$admin->id}}</td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->phone_number}}</td>
                                    <td>
                                        <div class="switch">
                                            <label>
                                                <input id="switchButton{{$admin->id}}" onchange="activate({{$admin->id}})" name="status" type="checkbox" @if($admin->status=='on')checked @endif >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                    @can('update')
                                        <td>
                                            <a class="btn btn-sm btn-info"  href="{{ route('admin.editAdmins',['user'=>$admin->id ]) }}">ویرایش</a>
                                        </td>
                                    @endcan
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$admin->id}}">
                                            جزئیات
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">جزئیات</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">جزئیات</div>
                                                                    <div class="list-group">
                                                                        <a class="list-group-item">  نام: {{$admin->name}}</a>
                                                                        <a class="list-group-item">  کد ملی: {{$admin->national_id}}</a>
                                                                        <a class="list-group-item">  شماره کارت: {{$admin->card_number}}</a>
                                                                        <a class="list-group-item">  شبا: {{$admin->sheba}}</a>
                                                                        <a class="list-group-item">  کد معرفی: {{$admin->ref_code}}</a>
                                                                        <a class="list-group-item">  معرف: {{$admin->caller}}</a>
                                                                        <a class="list-group-item"> نوع: {{getTypeOfUser($admin->type)}}</a>
                                                                        <a class="list-group-item"> سطح: {{getLevelOfUser($admin->level)}}</a>
                                                                        <a class="list-group-item">  درباره ی من: {{$admin->about_me}}</a>
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
                            </tbody>
                        </table>
                        @if(!$flag)
                            <div class="text-center">
                                {{ $admins->links() }}
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
            $.get(`/active/admin/${id}/${value}`,{id: id,value:value}, function(result){
            });
        }
        $('#search').on('click',function () {
            var value =$('#searchInput').val();
            $.get(`/search/in/admins/{value}`,{value:value}, function(result){
                $('#myTable').html(result)
            });
        })
    </script>
@endsection
