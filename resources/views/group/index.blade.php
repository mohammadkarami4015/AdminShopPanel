@extends('layouts.admin')

@section('title')
    لیست  گروه ها
@endsection

@section('cities')
    active
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست گروه ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('city.index')}}">خانه</a>
                </li>
                <li>
                    <a> گروه ها</a>
                </li>
                <li class="active">
                    <strong>لیست گروه ها</strong>
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
                        <h5> لیست گروه ها</h5>
                    </div>
                    <div class="searchListDiv">
                        <input class="form-control searchListInput" id="searchInput" type="text"
                               placeholder="جستجو بر اساس نام گروه  یا کشور">
                        <button class="btn btn-primary btn-sm searchListBtn" id="search">جستجو</button>
                    </div>
                    <div id="myTable" class="ibox-content table-responsive">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{$group->id}}</td>
                                    <td>{{$group->title}}</td>
                                    <td>
                                        <div class="switch">
                                            <label>
                                                <input id="switchButton{{$group->id}}"
                                                       onchange="activate({{$group->id}})"
                                                       name="status" type="checkbox"
                                                       @if($group->status=='on')checked @endif >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>

                                    <td>
                                        <a class="btn btn-sm btn-info"
                                           href="{{ route('group.edit',$group) }}">ویرایش</a>
                                    </td>

                                    <td>
                                        <form class="deleteForm" method="post"
                                              action="{{route('group.destroy',$group)}}">
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
                            {{ $groups->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function activate(id) {
            var switchButton = '#switchButton' + id;
            var value = $(switchButton).is(":checked") ? 'on' : 'off';
            $.get(`/active/admin/${id}/${value}`, {id: id, value: value}, function (result) {
            });
        }

        $('#search').on('click', function () {
            var value = $('#searchInput').val();
            $.get(`/search/in/admins/{value}`, {value: value}, function (result) {
                $('#myTable').html(result)
            });
        })
    </script>
@endsection
