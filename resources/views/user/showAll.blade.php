@extends('layouts.admin')

@section('title')
    {{$site_title}}   | لیست کاربران
@endsection

@section('users')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست کاربران</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin.dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>کاربران</a>
                </li>
                <li class="active">
                    <strong>لیست کاربران</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> لیست کاربران</h5>
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
                                <th>تلفن </th>
                                <th>ایمیل </th>
                                <th>وضعیت </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->phone_number}}</td>
                                    <td>{{$user->email}}</td>
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
                                            <form class="deleteForm" method="post" action="{{ route('user.destroy',['user'=>$user->id ]) }}">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-sm btn-danger" type="submit">حذف
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                    @can('update')
                                        <td>
                                            <a class="btn btn-sm btn-info"  href="{{ route('user.edit',['user'=>$user->id ]) }}">ویرایش</a>
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
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">اطلاعات کاربر</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading"> اطلاعات کاربر</div>
                                                                    <div class="list-group">
                                                                        <a class="list-group-item">  نام: {{$user->name}}</a>
                                                                        <a class="list-group-item">  کد ملی: {{$user->national_id}}</a>
                                                                        <a class="list-group-item">  شماره کارت: {{$user->card_number}}</a>
                                                                        <a class="list-group-item">  شبا: {{$user->sheba}}</a>
                                                                        <a class="list-group-item">  معرف: {{$user->caller}}</a>
                                                                        <a class="list-group-item"> سطح: {{getLevelOfUser($user->level)}}</a>
                                                                        <a class="list-group-item">  درباره ی من: {{$user->about_me}}</a>
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
                                {{ $users->links() }}
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
            $.get(`/active/user/${id}/${value}`,{id: id,value:value}, function(result){
                console.log(result)
            });
        }
        $('#search').on('click',function () {
            var value =$('#searchInput').val();
            $.get(`/search/in/users/{value}`,{value:value}, function(result){
                $('#myTable').html(result)
            });
        })
    </script>

@endsection
