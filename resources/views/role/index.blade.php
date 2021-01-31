@extends('layouts.admin')

@section('title')
    لیست نقش ها
@endsection

@section('roles')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست نقش ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">خانه</a>
                </li>
                <li>
                    <a>نقش ها</a>
                </li>
                <li class="active">
                    <strong>لیست نقش ها</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div
                class="col-md-11 col-md-pull-1 col-lg-11 col-lg-pull-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> لیست نقش ها</h5>
                    </div>
                    <div class="searchListDiv">
                        <input onkeyup="Search()" class="form-control searchListInput" id="searchInput" type="text"
                               placeholder=" جستجو بر اساس   نام و توضخات نقش و دسترسی های آن  " name="data">

                    </div>
                    <div id="" class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->label}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info"
                                           href="{{ route('role.edit',$role) }}">ویرایش</a>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModalCenter{{$role->id}}">
                                            جزئیات
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{$role->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                        <a class="list-group-item">
                                                                            نام: {{$role->name}}</a>
                                                                        <a class="list-group-item">
                                                                            توضیحات: {{$role->label}}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">دسترسی ها</div>
                                                                    <div class="list-group">
                                                                        @foreach($role->permissions as $permission)
                                                                            <a class="list-group-item">
                                                                                <b>نام: </b>  {{$permission->name}}



                                                                                <b style="margin-right: 30px">توضیحات: </b> {{$permission->label}}
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">بستن
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <form class="deleteForm" method="post"
                                              action="{{route('role.destroy',$role)}}">
                                            {{method_field('DELETE')}}
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit">حذف
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $roles->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function Search() {
            var value = $('#searchInput').val();
            $.get(`role-search`, {data: value}, function (result) {
                $('#myTable').html(result)
            });
        }
    </script>
@endsection
